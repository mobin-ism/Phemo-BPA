<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerInvoice extends Notification
{
    use Queueable;
    protected $invoice_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;
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
        $invoice = \App\Invoice::where('id', $this->invoice_id)->first();
        $customer = \App\Customer::where('id', $invoice->customer_id)->first();
        $customer_name = \App\User::where('id', $customer->user_id)->first()->name;
        $account_id = $invoice->account_id;
        $invoice_prefix = \App\Config::where('account_id', $account_id)->first()->invoice_prefix;
        $currency = \App\Config::where('account_id', $account_id)->first()->currency;
        $invoice_no = $invoice_prefix . '-' . $invoice->invoice_no;
        $amount = $currency . ' ' . number_format($invoice->grand_total, 2, '.', ',');
        return (new MailMessage)
                    ->subject('You have a new invoice '.$invoice_no)
                    ->greeting('Dear '. $customer_name.',')
                    ->line('Invoice No. '.$invoice_no)
                    ->line('Total Invoice Amount: '.$amount)
                    ->action('Log in to see your invoice', 'https://app.phemo.net/invoices')
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
