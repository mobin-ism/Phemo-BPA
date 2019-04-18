<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCustomerStatement extends Notification
{
    use Queueable;
    protected $customer_name;
    protected $statement_code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($customer_name, $statement_code)
    {
        $this->customer_name = $customer_name;
        $this->statement_code = $statement_code;
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
                    ->subject('Customer Statement')
                    ->greeting('Hello '. $this->customer_name.',')
                    ->line('Kindly find your latest statement with us.')
                    ->line('It has been a please doing business with you and we look forward to serving you more.')
                    ->line('Statement Code: '.$this->statement_code)
                    ->line('If you have any queries, do not hesitate to email or call us. We will be at your service.')
                    ->action('View my statements', 'https://app.phemo.net/customers/statements/list')
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
