<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;
    protected $token;

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
        return (new MailMessage)
            ->from('klever@klever.pp.ua', 'ALGARIA')
            ->subject('Сброс пароля')
            ->greeting('Здравствуйте!')
            ->line('Вы запросили сброс пароля от своего аккаунта. Если вы этого не делали, то проигнорируйте данное сообщение, измените пароль в аккаунте и сообщите администрации об этом письме.')
            ->action('Сбросить пароль', url('password/reset' . '?email=' . $notifiable->email, $this->token))
            ->salutation("С уважением администрация");
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
