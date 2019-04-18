<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;

class NewLeaveRequest extends Notification
{
    use Queueable;
    protected $info;
    protected $days;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $request, $days)
    {
        $this->info = $request;
        $this->days = $days;
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
        $employee_name = \App\Employee::where('id', $this->info->employee_id)->first()->name;
        return (new MailMessage)
                    ->subject('Leave Request Received')
                    ->greeting('Dear '. $employee_name.',')
                    ->line('Your leave application for '.$this->days.' days from '.$this->info->start.' to '.$this->info->end.' has been received.')
                    ->line('You can keep track of your leave applications by loggin in into your account')
                    ->line('If you have any queries, kindly contact your HR manager for further discussion.')
                    ->action('Log In', 'https://app.phemo.net')
                    ->line('Thank you for using Phemo!');
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
