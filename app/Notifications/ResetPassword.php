<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use \Roerjo\LaravelNotificationsSendGridDriver\Messages\SendGridMailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['sendgrid'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toSendGrid($notifiable)
    {    
        $url = url(
            route(
                'password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
                ], false
            )
        );
        return (new SendGridMailMessage)
            ->from('system@influencify.io', 'Influencify')
            ->sendgrid(
                [
                'personalizations' => [
                    [
                        'dynamic_template_data' => [
                            'resetPwdUrl' => $url,
                        ],
                    ],
                ],
                'template_id' => 'd-d8e42a4f007e49b5a81d40f558f180c2',
                ]
            )
            ->error()
            ->subject("Reset Password");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
