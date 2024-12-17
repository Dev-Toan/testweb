<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'get.verifyemail',
            now()->addMinutes(3),
            ['id' => $notifiable->id]
        );
        return (new MailMessage)->from(config('mail.MAIL_FROM_ADDRESS'), config('app.name'))
            ->subject('Verify Email')
            ->line('Click verify email !')
            ->action('Click Success', $url)
            ->line('Link có thời hạn 30p !')
            ->line('Muốn lấy lại link đăng nhập vào hệ thống !')
            ->line('Vào cập nhật thông tin để lấy link !');
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
            //
        ];
    }
}
