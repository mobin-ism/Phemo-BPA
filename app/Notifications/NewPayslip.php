<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;

class NewPayslip extends Notification
{
    use Queueable;
    protected $info;
    protected $code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $request, $code)
    {
        $this->info = $request;
        $this->code = $code;
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
        $month = date('F', mktime(0, 0, 0, $this->info->month, 10));
        return (new MailMessage)
                    ->subject('Payslip Created for '.$month.', '.$this->info->year)
                    ->greeting('Dear '. $employee_name.',')
                    ->line('Your payslip for the month '.$month.' is created')
                    ->line('You can print or see the payslip by logging in into your account')
                    ->line('Any queries, do not hesitate to contact us.')
                    ->action('Log in to see payslips', 'https://app.phemo.net/login')
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
