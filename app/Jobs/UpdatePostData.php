<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Log;


use App\Influencer\User\User;
use App\Influencer\SocialMedia\InstagramBusiness\User as InstagramUser;
use App\Influencer\SocialMedia\FacebookPage\User as FacebookPageUser;
use App\Infrastructure\API\SocialMedia\Facebook\Instagram as InstagramApi;
use App\Infrastructure\API\SocialMedia\Facebook\FacebookPage as FacebookPageApi;
use App\Influencer\Post\Post;
use App\Influencer\User\UserStatus;
use App\Infrastructure\Repository\SocialMediaRepository;
use App\Influencer\Utils\Text;
use App\Influencer\Utils\Time;


class UpdatePostData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $STATUS = ['update_1min', 'update_10min', 'update_1h', 'update_12h', 'update_24h', 'update_7d', 'no_update'];
    private $user_id;
    private $max_post_age;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id = null)
    {
        $this->user_id = $user_id;
        $this->max_post_age = config('app.max_post_age');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('Schedule ran - posts updated');
        Post::deleteOldPosts();

        if (is_null($this->user_id)) {
            $userStatus = UserStatus::get();
        } else {
            $userStatus = UserStatus::where('user_id', $this->user_id)->get();
        }

        $socialMediaRepository = new SocialMediaRepository();
    
        foreach ($userStatus as $userToFind) {
            $user = User::with('social_medias')->find($userToFind['user_id']);
            $instagramSocialMedia = $socialMediaRepository->getSocialMediaFromUser('instagram_business', $user->id)->first();
            $this->instagramPosts($user, $instagramSocialMedia);
            $facebookPageSocialMedia = $socialMediaRepository->getSocialMediaFromUser('facebook_page', $user->id)->first();
            $this->facebookPagePosts($user, $facebookPageSocialMedia);
            
        }// end foreach ($userStatus as $userToFind)
    
        
    }

    public function instagramPosts($user, $instagramSocialMedia)
    {
        $continue = true;
        if ($instagramSocialMedia->active AND $instagramSocialMedia->verifyToken()) {
            $instagram = InstagramUser::make($user);
            $api = new InstagramApi($instagram);
            
            // Pegou os IDs dos posts do Instagram
            $data = $api->getInstagramMedias()->Json();
            if (!isset($data['data'])) {
                Log::debug("{$data['error']['message']} - Social media id - $instagramSocialMedia->id - User id  - $instagramSocialMedia->user_id");                    
            }
            while ($continue) {
                foreach ($data['data'] as $postId) {
                    $post = [
                        'social_media_id' => $instagramSocialMedia->id,
                        'post_id' => $postId['id']
                    ];
                    $postC = Post::where($post)->count();
                    if ($postC > 0) {
                        // dump("Post já está no banco: {$postId['id']}");
                    } else {
                        $postM = $api->getInstagramMediaInfo($postId['id'])->Json();

                        if (Time::olderThanDays($postM['timestamp'], $this->max_post_age)) {
                            $continue = false;
                            // dump('period break');
                            break;
                        }
    
                        $post['timestamp'] = $postM['timestamp'];
                        $post['permalink'] = $postM['permalink'];
                        $post['type'] = 'feed';
                        $post['media_type'] = $postM['media_type'];
                        $post['like_count'] = $postM['like_count'];
                        $post['comments_count'] = $postM['comments_count'];
                        $post['media_url'] = isset($postM['media_url']) ? $postM['media_url'] : 'unknown';
                        if (isset($postM['caption'])) {
                            $post['caption'] = Text::removeAcentoSimbolo($postM['caption']);
                            $post['hashtags'] = Text::captionHashtags($post['caption']);
                        }
                        
                        $post['status'] = '<>';
    
                        $postT = Post::create($post);
                        // dump("Post inserido no banco: {$postId['id']}");
                    }
                }//endforeach
    
                if (isset($data['paging']['next'])) {
                    $data = $api->getInstagramMedias($data['paging']['next'])->Json();
                } else {
                    $continue = false;
                }
            } //endwhile

            // $userToFind->status = 'media_imported';
            // $userToFind->save();
        }
    }

    public function facebookPagePosts($user, $facebookPageSocialMedia)
    {
        $continue = true;
        // if ($facebookPageSocialMedia->active AND $facebookPageSocialMedia->verifyToken()) {
            $facebook_page = FacebookPageUser::make($user);
            $api = new FacebookPageApi($facebook_page);

            $data = $api->getFacebookPagePosts()->Json();
            if (!isset($data['data'])) {
                Log::debug("{$data['error']['message']} - Social media id - $facebookPageSocialMedia->id - User id  - $facebookPageSocialMedia->user_id");                    
            }
            while ($continue) {
                foreach ($data['data'] as $postId) {
                   
                    $post = [
                        'social_media_id' => $facebookPageSocialMedia->id,
                        'post_id' => $postId['id']
                    ];
                    $postC = Post::where($post)->count();
                    if ($postC > 0) {
                        // dump("Post já está no banco: {$postId['id']}");
                    } else {
                        $postM = $api->getFacebookPagePostInfo($postId['id'])->Json();
                        // dump($post);
                        if (Time::olderThanDays($postM['created_time'], $this->max_post_age)) {
                            $continue = false;
                            // dump('period break');
                            break;
                        }

                        $postInsight = $api->getFacebookPagePostInsights($postId['id'])->Json();
                        // dump($postInsight);
                        $postComments = $api->getFacebookPagePostComments($postId['id'])->Json();
                        // dump($postComments['summary']);

                        $post['timestamp'] = $postM['created_time'];
                        $post['permalink'] = $postM['permalink_url'];
                        $post['type'] = 'feed';
                        if (isset($postM['full_picture'])) {
                            if (isset($postM['properties'])) {
                                $post['media_type'] = 'VIDEO';
                            } else {
                                $post['media_type'] = 'IMAGE';
                                $post['media_url'] = $postM['full_picture'];
                            }
                        }
                        $post['comments_count'] = $postComments['summary']['total_count'];

                        if (isset($postM['message'])) {
                            $post['caption'] = Text::removeAcentoSimbolo($postM['message']);
                            $post['hashtags'] = Text::captionHashtags($post['caption']);
                        }
                        $post['status'] = '<>';

                        foreach ($postInsight['data'] as $insight) {
                            
                            if ($insight['name'] == 'post_reactions_by_type_total') {
                                if (isset($insight['values'][0]['value']['like'])) {
                                $post['like_count'] = $insight['values'][0]['value']['like'];
                                }
                            }
                        }
                        Post::create($post);

                       
                    }


                }//endforeach
                if (isset($data['paging']['next'])) {
                    //implementar para pegar next
                    $data = $api->getFacebookPagePosts($data['paging']['next'])->Json();
                } else {
                    $continue = false;
                }
            }//endwhile
        // }//endif
        
    }
}
