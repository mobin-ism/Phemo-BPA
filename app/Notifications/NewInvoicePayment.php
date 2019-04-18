<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;

class NewInvoicePayment extends Notification
{
    use Queueable;
    protected $info;
    protected $paid;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $request, $paid)
    {
        $this->info = $request;
        $this->paid = $paid;
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
        $invoice = \App\Invoice::where('id', $this->info->invoice_id)->first();
        $customer = \App\Customer::where('id', $invoice->customer_id)->first();
        $customer_name = \App\User::where('id', $customer->user_id)->first()->name;
        $account_id = $invoice->account_id;
        $invoice_prefix = \App\Config::where('account_id', $account_id)->first()->invoice_prefix;
        $currency = \App\Config::where('account_id', $account_id)->first()->currency;
        $due = $invoice->grand_total - $this->paid;
        $due_amount = $currency . ' ' . number_format($due, 2, '.', ',');
        $paid_amount = $currency . ' ' . number_format($this->paid, 2, '.', ',');
        $amount = $currency . ' ' . number_format($this->info->amount, 2, '.', ',');
        $invoice_amount = $currency . ' ' . number_format($invoice->grand_total, 2, '.', ',');
        $invoice_no = $invoice_prefix . '-' . $invoice->invoice_no;
        return (new MailMessage)
                    ->subject('Payment Received for invoice '.$invoice_no)
                    ->greeting('Dear '. $customer_name.',')
                    ->line('Thank you for your payment of amount '.$amount.' received on '.$this->info->date)
                    ->line('Total Invoice Amount: '.$invoice_amount)
                    ->line('Paid Amount: '.$paid_amount)
                    ->line('Outstanding: '.$due_amount)
                    ->action('Log in to see your receipts', 'https://app.phemo.net/invoices')
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
