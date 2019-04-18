<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReminderNotification;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendreminderemails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends reminders to specific users about certain important dates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $configs = \App\Config::all();
        foreach ($configs as $config) {
            if ($config->notifications == null) continue;
            $reminders = json_decode($config->notifications);            
            // dd($reminders->paye_due_date_notification);
            if ($reminders->vat_return_notification == "on") {
                $reminder_date = date('d-m-Y', $reminders->vat_return_date);
                foreach ($reminders->vat_return_date_timing as $timing) {
                    $date = date('Y-m-d', strtotime('-'.$timing.' days', $reminders->vat_return_date));
                    $today = date('Y-m-d');
                    if ($date == $today) {
                        foreach ($reminders->vat_return_date_receivers as $receiver) {
                            Notification::route('mail', $receiver)->notify(new ReminderNotification('VAT Return Reminder', $reminder_date, $receiver, 'VAT Return Date'));
                        }
                    }
                }
            }
            if ($reminders->tax_clearance_expiry_notification == "on") {
                $reminder_date = date('d-m-Y', $reminders->tax_clearance_expiry_date);
                foreach ($reminders->tax_clearance_expiry_date_timing as $timing) {
                    $date = date('Y-m-d', strtotime('-'.$timing.' days', $reminders->tax_clearance_expiry_date));
                    $today = date('Y-m-d');
                    if ($date == $today) {
                        foreach ($reminders->tax_clearance_expiry_date_receivers as $receiver) {
                            Notification::route('mail', $receiver)->notify(new ReminderNotification('Tax Clearance Expiry Date Reminder', $reminder_date, $receiver, 'Tax Clearance Expiry Date'));
                        }
                    }
                }
            }
            if ($reminders->paye_due_date_notification == 'on') {
                $reminder_date = date('d-m-Y', $reminders->paye_due_date);
                foreach ($reminders->paye_due_date_timing as $timing) {
                    $date = date('Y-m-d', strtotime('-'.$timing.' days', $reminders->paye_due_date));
                    $today = date('Y-m-d');
                    if ($date == $today) {
                        foreach ($reminders->paye_due_date_receivers as $receiver) {
                            Notification::route('mail', $receiver)->notify(new ReminderNotification('PAYE Due Date Reminder', $reminder_date, $receiver, 'PAYE Due Date'));
                        }
                    }
                }
            }
            if ($reminders->income_tax_notification == 'on') {
                $reminder_date = date('d-m-Y', $reminders->income_tax_date);
                foreach ($reminders->income_tax_date_timing as $timing) {
                    $date = date('Y-m-d', strtotime('-'.$timing.' days', $reminders->income_tax_date));
                    $today = date('Y-m-d');
                    if ($date == $today) {
                        foreach ($reminders->income_tax_date_receivers as $receiver) {
                            Notification::route('mail', $receiver)->notify(new ReminderNotification('Income Tax Reminder', $reminder_date, $receiver, 'Income Tax Date'));
                        }
                    }
                }
            }
            if ($reminders->board_meeting_reminder == 'on') {
                $reminder_date = date('d-m-Y', $reminders->board_meeting_date);
                foreach ($reminders->board_meeting_date_timing as $timing) {
                    $date = date('Y-m-d', strtotime('-'.$timing.' days', $reminders->board_meeting_date));
                    $today = date('Y-m-d');
                    if ($date == $today) {
                        foreach ($reminders->board_meeting_date_receivers as $receiver) {
                            Notification::route('mail', $receiver)->notify(new ReminderNotification('Board Meeting Reminder', $reminder_date, $receiver, 'Board Meeting Date'));
                        }
                    }
                }
            }
            if ($reminders->annual_returns_reminder == 'on') {
                $reminder_date = date('d-m-Y', $reminders->annual_returns_date);
                foreach ($reminders->annual_returns_date_timing as $timing) {
                    $date = date('Y-m-d', strtotime('-'.$timing.' days', $reminders->annual_returns_date));
                    $today = date('Y-m-d');
                    if ($date == $today) {
                        foreach ($reminders->annual_returns_date_receivers as $receiver) {
                            Notification::route('mail', $receiver)->notify(new ReminderNotification('Annual Returns Date Reminder', $reminder_date, $receiver, 'Annual Returns Date'));
                        }
                    }
                }
            }
            if ($reminders->payroll_processing_date_notification == 'on') {
                $reminder_date = date('d-m-Y', $reminders->payroll_processing_date);
                foreach ($reminders->payroll_processing_date_timing as $timing) {
                    $date = date('Y-m-d', strtotime('-'.$timing.' days', $reminders->payroll_processing_date));
                    $today = date('Y-m-d');
                    if ($date == $today) {
                        foreach ($reminders->payroll_processing_date_receivers as $receiver) {
                            Notification::route('mail', $receiver)->notify(new ReminderNotification('Payroll Processing Date Reminder', $reminder_date, $receiver, 'Payroll Processing Date'));
                        }
                    }
                }
            }
            if ($reminders->debt_repayment_reminder == 'on') {
                $reminder_date = date('d-m-Y', $reminders->debt_repayment_date);
                foreach ($reminders->debt_repayment_date_timing as $timing) {
                    $date = date('Y-m-d', strtotime('-'.$timing.' days', $reminders->debt_repayment_date));
                    $today = date('Y-m-d');
                    if ($date == $today) {
                        foreach ($reminders->debt_repayment_date_receivers as $receiver) {
                            Notification::route('mail', $receiver)->notify(new ReminderNotification('Debt Repayment Date Reminder', $reminder_date, $receiver, 'Debt Repayment Date'));
                        }
                    }
                }
            }
        }
    }
}
