<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;

class NewEmployeeAccount extends Notification
{
    use Queueable;
    protected $info;
    protected $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $request, $password)
    {
        $this->info = $request;
        $this->password = $password;
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
        $company_name = \App\Config::where('account_id', $this->info->account_id)->first()->company_name;
        return (new MailMessage)
                    ->subject('New Accounnt Created on '.$company_name)
                    ->greeting('Hello '. $this->info->name.',')
                    ->line('We would like to welcome you to '.$company_name.', for you to enjoy using the platform, kindly set a secure password and update your profile fully.')
                    ->line('Now you can log in into your account using this temporary password')
                    ->line($this->password)
                    ->line('We wish you are a pleasant stay.')
                    ->action('Log in to '.$company_name, 'https://app.phemo.net/login')
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
