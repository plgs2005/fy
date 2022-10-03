<?php

namespace App\Listeners;

use App\Events\NewCampaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Influencer\Campaign\Campaign;
use App\Influencer\User\User;

use App\Influencer\Utils\Number;
use App\Notification;

class ChooseInfluencer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewCampaign  $event
     * @return void
     */
    public function handle(NewCampaign $event)
    {
        if ($event->campaign->audience->influencer_size == 'micro') {
            $followers = 50;
        } else {
            $followers = 5000;
        }

        $users = User::where('brand_name', null)->whereHas(
            'social_medias', function ($query) use ($followers) {
                $query->where('followers', '>=', $followers)->where('impressions', '>=', 100);
            }, 
        )->where('stripe_onboarding_complete', 1)->with('social_medias')->get();

        if ($users) {
            foreach ($users as $user) {
                foreach ($user->social_medias as $socialMedia) {
                    if ($socialMedia->social_media == 'instagram_business') {
                        $instagramUser = \App\Influencer\SocialMedia\InstagramBusiness\User::make($user);
                        $instagramUserApi = new \App\Infrastructure\API\SocialMedia\Facebook\Instagram($instagramUser);
                        $igAudienceData = $instagramUserApi->getInstagramAudience()->Json();
                        
                        $elegibleAudience = $this->processAudience($igAudienceData, $event->campaign->audience);
                        $score[$user->id] = $this->score($elegibleAudience, $socialMedia);
                        $score[$user->id] = round($score[$user->id], 2)*100;
                        $user->score = $score[$user->id];

                        $impressions[$user->id] = $socialMedia->avgImpressions;
                    }
                }
            }
            //sorts user by score
            $users = $users->sortByDesc(function ($user, $key) {
                return $user->score;
            });
            
            //$event->campaign->influencers()->save($users->random());
            foreach ($users as $user) {
                unset($user->score);
                $event->campaign->influencers()->save($user);

                if ($event->campaign->manual_select_influencers) {
                    $event->campaign->influencers()->updateExistingPivot($user->id, ['value' => $impressions[$user->id], 'score' => $score[$user->id], 'impressions' => $impressions[$user->id]]);
                } else {
                    $event->campaign->influencers()->updateExistingPivot($user->id, ['brand_accept' => 1, 'value' => $impressions[$user->id], 'score' => $score[$user->id], 'impressions' => $impressions[$user->id]]);
                    if (env('ADMIN_REVIEW_SELECTED_INFLUENCERS')) {
                        //notifica admin que novos influencers foram adicionados a uma campanha e aguardam revisao revisao
                    } else {
                        $user->notify(new \App\Notifications\InfluencerNewJob($user, $event->campaign));
                    }
                }
            }
            if ($event->campaign->manual_select_influencers) {
                $user->notify(new \App\Notifications\BrandCampaignNewInfluencer($event->campaign));
            }
        } else {
            //Notificacao que nenhum influencer compativel com os parametros da campanha foi encontrado
        }
        
    }

    //retorna a quantidade se seguidores que se encaixam nos parametros da campanha
    public function processAudience($igData, $audience)
    {
        $audStartAge = substr($audience->audience_age, 0, 2);
        $audEndAge = substr($audience->audience_age, 3, 2);
        
        foreach ($igData['data'] as $data) {
            
            if ($data['name'] == 'audience_gender_age') {
                $count = 0;
                foreach ($data['values'][0]['value'] as $key => $value) {
                    //filtra o genero masculino/feminino
                    if (stripos($key, $audience->audience_gender) === 0) {
                        $startAge = substr($key, 2, 2);
                        $endAge = substr($key, 5, 2);
                        if (Number::between($audStartAge, $startAge, $endAge) OR Number::between($audEndAge, $startAge, $endAge) OR Number::between($startAge, $audStartAge, $audEndAge)) {
                            $count = $count+$value;
                        }
                    }
                }
                $ret['gender_age'] = $count;
            }

            if ($data['name'] == 'audience_country') {
                $locations = json_decode($audience->audience_location);
                foreach ($data['values'][0]['value'] as $key => $value) {
                    if (in_array($key, $locations)) {
                        $ret['country'] = $value;
                    }
                }
            
            }

            if ($data['name'] == 'audience_locale') {
                $languages = json_decode($audience->audience_language);
                foreach ($data['values'][0]['value'] as $key => $value) {
                    if (in_array($key, $languages)) {
                        $ret['language'] = $value;
                    }
                }
            
            }
        }
        return $ret;
    }

    public function score($elegibleAudience, $socialMedia)
    {
        foreach ($elegibleAudience as $key => $value) {
            $elegibleAudience[$key] = $value/$socialMedia->followers;
        }
        $sum=0;
        $i=0;
        foreach ($elegibleAudience as $key => $value) {
            $sum = $sum+$value;
            $i++;
        }
        $score = $sum/$i;
        return $score;
    }

}
