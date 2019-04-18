<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;

class NewTicket extends Notification
{
    use Queueable;
    protected $info;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->info = $request;
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
        $customer = \App\Customer::where('id', $this->info->customer_id)->first();
        $customer_name = \App\User::where('id', $customer->user_id)->first()->name;
        return (new MailMessage)
                    ->subject('Ticket Received')
                    ->greeting('Dear '. $customer_name.',')
                    ->line('We have received your query and it will be assigned to one of our employees who will be in touch with you soon.')
                    ->line('You can see your tickets by logging in into your account')
                    ->action('View my tickets', 'https://app.phemo.net/tickets')
                    ->line('Thank you for your business!');
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
