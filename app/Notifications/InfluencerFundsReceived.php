<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

use \Roerjo\LaravelNotificationsSendGridDriver\Messages\SendGridMailMessage;

class InfluencerFundsReceived extends Notification implements ShouldBroadcast
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
        $this->message = 'Katching!<br> The brand you worked with on the <b>'.$this->campaign->name.'</b> campaign just released you payment.<br> <a href="'.url($this->url).'" >Click here</a> to go to Payments.';
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
                            'url' => url($this->url),
                            'campaign_name' => $this->campaign->name,
                        ],
                    ],
                ],
                'template_id' => 'd-4d52d00d33124a31ac900e9d45c0d12d',
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
            'link' => $this->url,
        ]);
    }
}
