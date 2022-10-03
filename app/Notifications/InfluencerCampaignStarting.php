<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

use \Roerjo\LaravelNotificationsSendGridDriver\Messages\SendGridMailMessage;

class InfluencerCampaignStarting extends Notification implements ShouldBroadcast
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
        $this->url = 'home';
        $this->message = 'Hey <b>'.$this->user->name.'!</b><br>This is it, your moment to shine has arrived and you should be getting ready to post for the '.$this->campaign->name.' campaign in 10 minutes!<br>Oh, and don`t forget to add your post link in Active Campaigns right after posting.';
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
                            'influencer_name' => $this->user->name,
                            'campaign_name' => $this->campaign->name,
                        ],
                    ],
                ],
                'template_id' => 'd-06dbfc69b8ba42d0b45d6395eb83cb12',
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
        ]);
    }
}
