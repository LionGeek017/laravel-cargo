<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountLogin extends Notification
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
        return [
            'mail',
            'database'
        ];
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
            ->subject('Выполнен вход в аккаунт ID: ' . auth()->id())
            ->greeting('Здравствуйте!')
            ->line('В ваш аккаунт выполнен вход ' . auth()->user()->last_active)
            ->action('На сайт', url('/'))
            ->salutation("С уважением администрация");
    }

    /**
     *
     */
    public function toDatabase() {
        return [
            'user_id' => auth()->id(),
            'action' => 'Вход в кабинет в ' . auth()->user()->last_active
        ];
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
