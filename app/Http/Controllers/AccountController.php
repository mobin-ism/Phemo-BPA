<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\Config;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewCompanyAccount;
use Illuminate\Support\Facades\Notification;
use Validator;

class AccountController extends Controller
{
    public function register(Request $request)
    {
		$validator = Validator::make($request->all(), 
			[
				'company_name' => 'required',
				'email' => 'required|email|max:255|unique:users,email',
				'company_name' => 'required',
				'name' => 'required',
				'password' => 'required|confirmed|min:6',
			]
		);

    	if ($validator->passes()) {
			$account = new Account;
			$account->name = $request->name;
			$account->trial_period = 14;
			$account->status = 'trial';
			$account->save();

			$config = new Config;
			$config->account_id = $account->id;
			$config->company_name = $request->company_name;
			$config->invoice_prefix = 'INV';
			$config->quotation_prefix = 'QT';
			$config->employee_prefix = 'EM';
			$config->quote_color_1 = '#fa526c';
			$config->quote_color_2 = '#6b55eb';
			$config->invoice_color_1 = '#fa526c';
			$config->invoice_color_2 = '#6b55eb';
			$config->bill_color_1 = '#fa526c';
			$config->bill_color_2 = '#6b55eb';
			$config->payslip_color_1 = '#119c38';
			$config->payslip_color_2 = '#eb4d4d';
			$config->payslip_color_3 = '#827ce6';
			$config->disk_space = '2000000';
			$config->date_format = 'd/m/Y';
			$config->notifications = '{"vat_return_notification":null,"vat_return_date":false,"vat_return_date_timing":null,"vat_return_date_receivers":null,"tax_clearance_expiry_notification":null,"tax_clearance_expiry_date":false,"tax_clearance_expiry_date_timing":null,"tax_clearance_expiry_date_receivers":null,"paye_due_date_notification":null,"paye_due_date":false,"paye_due_date_timing":null,"paye_due_date_receivers":null,"income_tax_notification":null,"income_tax_date":false,"income_tax_date_timing":null,"income_tax_date_receivers":null,"board_meeting_reminder":null,"board_meeting_date":false,"board_meeting_date_timing":null,"board_meeting_date_receivers":null,"annual_returns_reminder":null,"annual_returns_date":false,"annual_returns_date_timing":null,"annual_returns_date_receivers":null,"payroll_processing_date_notification":null,"payroll_processing_date":false,"payroll_processing_date_timing":null,"payroll_processing_date_receivers":null,"debt_repayment_reminder":null,"debt_repayment_date":false,"debt_repayment_date_timing":null,"debt_repayment_date_receivers":null}';
			$config->save();

			$user = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
				'role' => 'admin',
				'account_id' => $account->id
			]);
			Notification::route('mail', $request->email)->notify(new NewCompanyAccount($request));
			return redirect()->route('login')->with('success','Registration successfull. Please Login...');
		}
		return redirect()->back()->withErrors($validator)->withInput();
    }
}
