<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Influencer\Post\Post;

class UpdatePostInsights implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Post::updateInsights();
        $this->facebookPagePostsInsights();

    }

    public function facebookPagePostsInsights($type = 'feed', $social_media_id = null)
    {
        $socialMediaRepository = new \App\Infrastructure\Repository\SocialMediaRepository();
        if (is_null($social_media_id)) {
            $social_medias = $socialMediaRepository->getFacebookPageSocialMedias();
        } else {
            $social_medias = $socialMediaRepository->getSocialMediaById($social_media_id);
        }

        foreach ($social_medias as $social_media) {
            if ($social_media->verifyToken())
            {
                $posts = \App\Influencer\Post\Post::with('social_media', 'social_media.user')->where('type', $type)->where('social_media_id', $social_media->id)->get();

                foreach ($posts as $post) {
                    $post->update_rules_to_update();
                    $dadosPost = \App\Influencer\Dados\DadosPost\DadosPost::where('tabela_id', $post->id)->orderBy('valido_ate', 'desc')->first();
                    if (!is_null($dadosPost) && !$dadosPost->estaVencido()) {
                        continue;
                    }
                    $user = $post->social_media->user;
                    $facebookPageUser = \App\Influencer\SocialMedia\FacebookPage\User::make($user);
                    $api = new \App\Infrastructure\API\SocialMedia\Facebook\FacebookPage($facebookPageUser);

                    $insightsPost = $api->getFacebookPagePostInsights($post->post_id)->Json();

                    if(!isset($insightsPost['data'])) {
                        if (isset($insightsPost['error'])) {
                            continue;
                        }
                    }

                    foreach ($insightsPost['data'] as $postIns) {                        
                        switch ($postIns['name']) {
                            case 'post_impressions':
                                if (is_null($dadosPost)) {
                                    $dadoPost = new \App\Influencer\Dados\DadosPost\DadosPost();
                                    $dadoPost->tabela_id = $post->id;
                                    $dadoPost->tipo = 'impressions';
                                    $dadoPost->valor = $postIns['values'][0]['value'];
                                    $dadoPost->setarValidade($post->time_to_update());
                                    $dadoPost->save();
                                } else {
                                    $dadoPost = \App\Influencer\Dados\DadosPost\DadosPost::where('tabela_id', $post->id)->where('tipo', 'impressions')->first();
                                    $dadoPost->valor = $postIns['values'][0]['value'];
                                    $dadoPost->setarValidade($post->time_to_update());
                                    $dadoPost->save();
                                }
                                break;
                            case 'post_engaged_users':
                                if (is_null($dadosPost)) {
                                    $dadoPost = new \App\Influencer\Dados\DadosPost\DadosPost();
                                    $dadoPost->tabela_id = $post->id;
                                    $dadoPost->tipo = 'engagement';
                                    $dadoPost->valor = $postIns['values'][0]['value'];
                                    $dadoPost->setarValidade($post->time_to_update());
                                    $dadoPost->save();
                                } else {
                                    $dadoPost = \App\Influencer\Dados\DadosPost\DadosPost::where('tabela_id', $post->id)->where('tipo', 'engagement')->first();
                                    $dadoPost->valor = $postIns['values'][0]['value'];
                                    $dadoPost->setarValidade($post->time_to_update());
                                    $dadoPost->save();
                                }
                                break;
                            case 'post_impressions_unique':
                                if (is_null($dadosPost)) {
                                    $dadoPost = new \App\Influencer\Dados\DadosPost\DadosPost();
                                    $dadoPost->tabela_id = $post->id;
                                    $dadoPost->tipo = 'reach';
                                    $dadoPost->valor = $postIns['values'][0]['value'];
                                    $dadoPost->setarValidade($post->time_to_update());
                                    $dadoPost->save();
                                } else {
                                    $dadoPost = \App\Influencer\Dados\DadosPost\DadosPost::where('tabela_id', $post->id)->where('tipo', 'reach')->first();
                                    $dadoPost->valor = $postIns['values'][0]['value'];
                                    $dadoPost->setarValidade($post->time_to_update());
                                    $dadoPost->save();
                                }
                                break;
                            default:
                                # code...
                                break;
                        }
                    }//endforeach
                }//endforeach
            }// endif verifyToken
        }//endforeach

    }
}
