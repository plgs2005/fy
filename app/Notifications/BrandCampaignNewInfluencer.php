<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

use \Roerjo\LaravelNotificationsSendGridDriver\Messages\SendGridMailMessage;

class BrandCampaignNewInfluencer extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($campaign)
    {
        $this->campaign = $campaign;
        $this->url = 'brand-campaigns';
        $this->message = 'We have selected influencers that are a match for your new <b>'.$this->campaign->name.'</b> campaign!<br><a href="'.url($this->url).'" >Click here</a> to choose from suggested influencers.';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['sendgrid', 'broadcast', 'database'];
        return ['sendgrid', 'database'];
    }

    public function toSendGrid($notifiable)
    {
        return (new SendGridMailMessage)
            ->from('system@influencify.io', 'Influencify')
            ->sendgrid(
                [
                'personalizations' => [
                    [
                        'dynamic_template_data' => [
                            'campaign_name' => $this->campaign->name,
                            'url' => url($this->url),
                        ],
                    ],
                ],
                'template_id' => 'd-01b25a19eafe4c30b6558073ed70a188',
                ]
            )
            ->error();
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'campaign_id' => $this->campaign->id,
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->message,
            'link' => $this->url,
        ]);
    }
}
