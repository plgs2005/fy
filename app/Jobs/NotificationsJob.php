<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Carbon\Carbon;
use App\Influencer\Campaign\Campaign;
use App\Notifications\InfluencerCampaignStarting;
use App\Notifications\InfluencerCampaignStarted;
use App\Notifications\BrandCampaignEnded;

class NotificationsJob implements ShouldQueue
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
        $now = Carbon::now();

        $campaigns = Campaign::where('paid', 1)->with('influencers')->get();

        foreach ($campaigns as $campaign) {
            $tenMinutesBeforeCampaign = Carbon::parse($campaign->datetime)->subMinutes(10);
            $campaign_datetime = Carbon::parse($campaign->datetime);
            $tenMinutesAfterCampaign = Carbon::parse($campaign->datetime)->addMinutes(10);

            $days = ($this->format_type_feed) ? 7 : 1;
            $campaign_end = Carbon::parse($campaign->datetime)->addDays($days);

            if ($now->isAfter($tenMinutesBeforeCampaign) AND $now->isBefore($tenMinutesAfterCampaign)) {
                foreach ($campaign->influencers as $influencer) {
                    if($influencer->pivot->startingNotification == 0 AND $now->isBefore($campaign_datetime)) {
                        $influencer->notify(new InfluencerCampaignStarting($influencer, $campaign));
                        $campaign->influencers()->updateExistingPivot($influencer->id, ['startingNotification'=> 1]);
                        
                    } elseif($influencer->pivot->startedNotification == 0 AND $now->isAfter($campaign_datetime)) {
                        $influencer->notify(new InfluencerCampaignStarted($influencer, $campaign));
                        $campaign->influencers()->updateExistingPivot($influencer->id, ['startedNotification'=> 1]);
                    } 
                }
            }

            if ($campaign->endedNotification == 0 AND $now->isAfter($campaign_end)) {
                $brand = $campaign->brand;
                $brand->notify(new BrandCampaignEnded($campaign));
                $campaign->endedNotification = 1;
                $campaign->save();
            }
        }
    }
}
