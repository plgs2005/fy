<?php

namespace App\Influencer\Post;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = [
        'social_media_id', 'post_id', 'timestamp','permalink','type', 'media_type', 'media_url', 'caption', 'hashtags','like_count','comments_count', 'status', 'campaign_id',
    ];

    private $STATUS = ['update_1min', 'update_10min', 'update_1h', 'update_12h', 'update_24h', 'update_7d', 'no_update'];

    public function social_media()
    {
        return $this->belongsTo('App\Influencer\SocialMedia\SocialMedia');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Influencer\Campaign\Campaign');
    }

    public function metrics()
    {
        return $this->hasMany('App\Influencer\Dados\DadosPost\DadosPost', 'tabela_id');
    }

    public function time_to_update()
    {
        if (!in_array($this->status, $this->STATUS) || $this->status == 'no_update') {
            return false;
        }

        switch ($this->status) {
        case 'update_1min':
            return 1;
                break;
            
        case 'update_10min':
            return 10;
                break;
            
        case 'update_1h':
            return 1 * 60;
                break;
            
        case 'update_12h':
            return 12 * 60;
                break;
            
        case 'update_24h':
            return 24 * 60;
                break;
            
        case 'update_7d':
            return 7 * 24 * 60;
                break;
            
        default:
            return false;
                break;
        }
    }

    public function update_rules_to_update()
    {
        // Fazer regra que verifique o tempo do post
        $startTime = \Carbon\Carbon::parse($this->timestamp);
        $endTime = \Carbon\Carbon::parse(date('Y-m-d H:i:s'));
        $diff = $endTime->diffInMinutes($startTime);

        // Se o post estiver vinculado a uma campanha, mudar frequencia de atualização

        $newRule = 'update_7d';
        if ($diff <= 60 * 24 * 7) {
            $newRule = 'update_24h';
        }

        if ($this->campaign_id) {
            $newRule = 'update_10min';
        }
        if ($this->type == 'story') {
            $newRule = 'update_1min';
        }

        $this->status = $newRule;
        $this->save();
    }

    public static function updateStories()
    {
        $userStatus = \App\Influencer\User\UserStatus::get();
        $socialMediaRepository = new \App\Infrastructure\Repository\SocialMediaRepository();
    
        foreach ($userStatus as $userToFind) {
            $user = \App\Influencer\User\User::with('social_medias')->find($userToFind['user_id']);
            $instagramSocialMedia = $socialMediaRepository->getSocialMediaFromUser('instagram_business', $user->id)->first();
            if ($instagramSocialMedia->verifyToken()) {
                $instagram = \App\Influencer\SocialMedia\InstagramBusiness\User::make($user);
                $api = new \App\Infrastructure\API\SocialMedia\Facebook\Instagram($instagram);

                //Busca stories do usuario
                $data2 = $api->getInstagramStories()->Json();

                foreach ($data2['data'] as $storyId) {

                    $story = [
                        'social_media_id' => $instagramSocialMedia->id,
                        'post_id' => $storyId['id']
                    ];
                    $storyC = \App\Influencer\Post\Post::where($story)->count();
                    if ($storyC > 0) {
                        dump("Story já está no banco: {$storyId['id']}");
                    } else {
                        $storyMediaInfo = $api->getInstagramMediaInfo($storyId['id'])->Json();
                        
                        $story['timestamp'] = $storyMediaInfo['timestamp'];
                        $story['permalink'] = $storyMediaInfo['permalink'];
                        $story['type'] = 'story';
                        $story['media_type'] = $storyMediaInfo['media_type'];
                        $story['media_url'] = isset($storyMediaInfo['media_url']) ? $storyMediaInfo['media_url'] : 'unknown';
                        $story['status'] = '<>';

                        $storyT = \App\Influencer\Post\Post::create($story);
                        dump("Story inserido no banco: {$storyId['id']}");
                    }
                }

            }// end foreach ($userStatus as $userToFind)
        }
        
    }

    //only instagram
    public static function updateInsights($type = 'feed', $social_media_id = null)
    {
        Log::debug('Schedule ran - insights updated');
        if (is_null($social_media_id)) {
            $postStatus = \App\Influencer\Post\Post::with('social_media', 'social_media.user')->where('status', '<>', 'no_update')->where('type', $type)->get();
        } else {
            $postStatus = \App\Influencer\Post\Post::with('social_media', 'social_media.user')->where('status', '<>', 'no_update')->where('type', $type)->where('social_media_id', $social_media_id)->get();
        }
        
        $socialMediaRepository = new \App\Infrastructure\Repository\SocialMediaRepository();

        $users = [];
        foreach ($postStatus as $post) {
            if ($post->social_media->social_media == 'facebook_page') {
                continue;
            }
            $user = $post->social_media->user;
            $userId = $user->id;
            $instagramSocialMedia = $socialMediaRepository->getSocialMediaFromUser('instagram_business', $userId)->first();
            if ($instagramSocialMedia->verifyToken()) {

                $post->update_rules_to_update();

                if (!isset($users[$userId])) {
                    
                    $instagram = \App\Influencer\SocialMedia\InstagramBusiness\User::make($user);
                    $api = new \App\Infrastructure\API\SocialMedia\Facebook\Instagram($instagram);

                    $users[$userId]['user'] = $post->social_media->user;
                    $users[$userId]['ig_sm'] = $instagramSocialMedia;
                    $users[$userId]['api'] = $api;
                }

                $dadosPost = \App\Influencer\Dados\DadosPost\DadosPost::where('tabela_id', $post->id)->orderBy('valido_ate', 'desc')->first();
                if (!is_null($dadosPost) && !$dadosPost->estaVencido()) {
                    continue;
                }

                if($type=='feed') {
                    $data = $api->getInstagramMedia($post->post_id);
                }
                if($type=='story') {
                    $data = $api->getInstagramStory($post->post_id);
                }
                
                $insightPost = $data->json();
                //dd($insightPost);
                
                if(!isset($insightPost['data'])) {
                    if (isset($insightPost['error'])) {
                        dump($insightPost);
                        // "error_subcode" => 2108006
                        // Erro quando a mídia é postada antes da conta ser transformada em business account
                        if (isset($insightPost['error']['error_subcode']) AND $insightPost['error']['error_subcode'] == 2108006) {
                            // Atualizar post com status no_update
                            $post->status = 'no_update';
                            $post->save();
                        }
                        continue;
                    }
                }
                foreach($insightPost['data'] as $postIns) {
                    // "name": nome da métrica (tem "title" e "description" ainda)
                    // "period": período da métrica
                    // "values": array com os valores (se for lifetime, vai ter só 1)
                    //           ['values'][0]['value] = 465
                    // dump($postIns);
                    if (is_null($dadosPost)) {
                        $dadoPost = new \App\Influencer\Dados\DadosPost\DadosPost();
                        $dadoPost->traduzirDados($post->id, $postIns);
                        $dadoPost->setarValidade($post->time_to_update());
                        $dadoPost->save();
                    } else {
                        $dadoPost = \App\Influencer\Dados\DadosPost\DadosPost::where('tabela_id', $post->id)->where('tipo', $postIns['name'])->first();
                        $dadoPost->traduzirDados($post->id, $postIns);
                        $dadoPost->setarValidade($post->time_to_update());
                        $dadoPost->save();
                    }

                }
                // dump("*******************");
            
            }
        }
        dump('update insights done');
    }

    public function olderThanDefault()
    {
        return \App\Influencer\Utils\Time::olderThanDays($this->timestamp, config('app.max_post_age'));
    }

    public static function deleteOldPosts()
    {
        $posts = \App\Influencer\Post\Post::get();
        foreach ($posts as $post) {
            if ($post->olderThanDefault()) {
                if ($post->campaign_id == null AND $post->type == 'feed') {
                    $dadosPost = \App\Influencer\Dados\DadosPost\DadosPost::where('tabela', 'post')->where('tabela_id', $post->id)->get();
                    foreach ($dadosPost as $dado) {
                        $dado->delete();
                    }
                    $post->delete();
                    // dump("Post deleted id: {$post->id}");
                }
            }  
        }
    }

}
