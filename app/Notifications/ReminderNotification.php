<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReminderNotification extends Notification
{
    use Queueable;
    protected $subject, $date, $email, $title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, $date, $email, $title)
    {
        $this->subject = $subject;
        $this->date = $date;
        $this->email = $email;
        $this->title = $title;
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
        $name = \App\User::where('email', $this->email)->first()->name;
        return (new MailMessage)
                    ->subject($this->subject)
                    ->greeting('Dear '. $name.',')
                    ->line('You received this reminder becasue you were opted in for this notification')
                    ->line($this->title.': '. $this->date)
                    ->line('Thank you for using our Phemo!');
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
