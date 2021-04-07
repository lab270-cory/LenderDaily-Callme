<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserRegistration extends Notification
{
    use Queueable;

    public $registeredUser;

    /**
     * Create a new notification instance.
     *
     * @param $registeredUser
     */
    public function __construct($registeredUser)
    {
        $this->registeredUser = $registeredUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //        return ['mail', 'database'];
        return ['database'];
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
                    ->line($this->registeredUser->name." has registered as a user in the system. Click the below button to check his profile")
                    ->action('View User', route('users.show', $this->registeredUser->id))
                    ->line('Thank you for using our application!');
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
            'message'=> 'A new user <b>'.$this->registeredUser->name."</b> has been registered in the system",
            'href'=> route('users.edit', $this->registeredUser->id),
            'icon'=> 'fas fa-user-plus'
        ];
    }
}
