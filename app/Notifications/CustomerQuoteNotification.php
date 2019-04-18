<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerQuoteNotification extends Notification
{
    use Queueable;
    protected $quote_id, $to_customer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($quote_id, $to_customer)
    {
        $this->quote_id = $quote_id;
        $this->to_customer = $to_customer;
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
        if ($this->to_customer) {
            $quote = \App\Quote::where('id', $this->quote_id)->first();
            $customer = \App\Customer::where('id', $quote->customer_id)->first();
            $customer_name = \App\User::where('id', $customer->user_id)->first()->name;
            $account_id = $quote->account_id;
            $quote_prefix = \App\Config::where('account_id', $account_id)->first()->quotation_prefix;
            $currency = \App\Config::where('account_id', $account_id)->first()->currency;
            $quote_no = $quote_prefix . '-' . $quote->quote_no;
            $amount = $currency . ' ' . number_format($quote->grand_total, 2, '.', ',');
            return (new MailMessage)
                    ->subject('You have a new quotation '.$quote_no)
                    ->greeting('Dear '. $customer_name.',')
                    ->line('You have received a quotation.')
                    ->line('You can see and edit the quotation as per your requirement and either you can approve or reject this quotation.')
                    ->line('Total Quotation Amount: '.$amount)
                    ->line('Status: '. __('web.'.$quote->status))
                    ->action('Log in to see this quotation', route('customer.show_quote', $this->quote_id))
                    ->line('Thank you for using our Phemo!');
        } else {
            $quote = \App\Quote::where('id', $this->quote_id)->first();
            $customer = \App\Customer::where('id', $quote->customer_id)->first();
            $customer_name = \App\User::where('id', $customer->user_id)->first()->name;
            $account_id = $quote->account_id;
            $quote_prefix = \App\Config::where('account_id', $account_id)->first()->quotation_prefix;
            $currency = \App\Config::where('account_id', $account_id)->first()->currency;
            $quote_no = $quote_prefix . '-' . $quote->quote_no;
            $amount = $currency . ' ' . number_format($quote->grand_total, 2, '.', ',');
            return (new MailMessage)
                    ->subject('Quotation Changed by Customer '.$quote_no)
                    ->line('Quotation status was changed by customer '.$customer_name)
                    ->line('You can see the quotation from your account')
                    ->line('Total Quotation Amount: '.$amount)
                    ->line('Status: '. __('web.'.$quote->status))
                    ->action('Log In', 'https://app.phemo.net')
                    ->line('Thank you for using our Phemo!');
        }
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
