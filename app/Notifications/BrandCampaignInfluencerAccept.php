<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

use \Roerjo\LaravelNotificationsSendGridDriver\Messages\SendGridMailMessage;

class BrandCampaignInfluencerAccept extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $campaign)
    {
        $this->user = $user;
        $this->campaign = $campaign;
        $this->url = 'brand-campaigns';
        $this->message = 'Influencer <b>'.$this->user->name.'</b> accepted to participate in your campaign <b>'.$this->campaign->name.'</b> campaign!<br><a href="'.url($this->url).'" >Click here</a> to go to active campaigns.';
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
                            'influencer_name' => $this->user->name,
                            'url' => url($this->url),
                        ],
                    ],
                ],
                'template_id' => 'd-1c4756da2ddb4568a713ccaaf264e4bc',
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
            'user_id' => $this->user->id,
            'campaign_id' => $this->campaign->id,
            'image_path' => $this->user->avatarImg,
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
            'img_path' => $this->user->avatarImg,
        ]);
    }
}
