<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;
use Auth;
use Image;
use App\EmailTemplate;
use Validator;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $config = Config::where('account_id', Auth::user()->account_id)->first();
        return view('backend.pages.configs.index', compact('config'));
    }

    public function system_preferences(Request $request)
    {
        $config = Config::find($request->account_id);
        $config->company_name = $request->company_name;
        $config->address_line_1 = $request->address_line_1;
        $config->address_line_2 = $request->address_line_2;
        $config->city = $request->city;
        $config->country_id = $request->country_id;
        $config->invoice_prefix = $request->invoice_prefix;
        $config->quotation_prefix = $request->quotation_prefix;
        $config->employee_prefix = $request->employee_prefix;
        $config->po_prefix = $request->po_prefix;
        // $config->voucher_prefix = $request->voucher_prefix;
        $config->date_format = $request->date_format;
        $config->currency = $request->currency;
        $config->tc_invoice = $request->tc_invoice;
        // $config->tc_po = $request->tc_po;
        $config->tc_quote = $request->tc_quotation;
        $config->zip_code = $request->zip_code;
        $config->mobile = $request->mobile;
        $config->landline = $request->landline;
        $config->tax_no = $request->tax_no;
        $config->website = $request->website;
        // $config->tc_bill = $request->tc_bill;
        if ($request->has('logo')) {
            $attachment = $request->file('logo');
            $extension = $attachment->getClientOriginalExtension();
            $attachment_name = $request->account_id . '.' . $extension;
            $path = $attachment->storeAs('public/logos', $attachment_name);
            $config->logo = 'logos/'.$attachment_name;
        }
        $config->save();
        return redirect()->route('configs.index')->with('success','success_msg');
    }

    public function notifications()
    {
        $config = Config::where('account_id', Auth::user()->account_id)->first();
        return view('backend.pages.configs.notifications', compact('config'));
    }

    public function update_notifications(Request $request)
    {
        $config = Config::find($request->account_id);
        $notificaton = [
            'vat_return_notification' => $request->vat_return_notification,
            'vat_return_date' => timestamp($request->vat_return_date),
            'vat_return_date_timing' => $request->vat_return_date_timing,
            'vat_return_date_receivers' => $request->vat_return_date_receivers,
            'tax_clearance_expiry_notification' => $request->tax_clearance_expiry_notification,
            'tax_clearance_expiry_date' => timestamp($request->tax_clearance_expiry_date),
            'tax_clearance_expiry_date_timing' => $request->tax_clearance_expiry_date_timing,
            'tax_clearance_expiry_date_receivers' => $request->tax_clearance_expiry_date_receivers,
            'paye_due_date_notification' => $request->paye_due_date_notification,
            'paye_due_date' => timestamp($request->paye_due_date),
            'paye_due_date_timing' => $request->paye_due_date_timing,
            'paye_due_date_receivers' => $request->paye_due_date_receivers,
            'income_tax_notification' => $request->income_tax_notification,
            'income_tax_date' => timestamp($request->income_tax_date),
            'income_tax_date_timing' => $request->income_tax_date_timing,
            'income_tax_date_receivers' => $request->income_tax_date_receivers,
            'board_meeting_reminder' => $request->board_meeting_reminder,
            'board_meeting_date' => timestamp($request->board_meeting_date),
            'board_meeting_date_timing' => $request->board_meeting_date_timing,
            'board_meeting_date_receivers' => $request->board_meeting_date_receivers,
            'annual_returns_reminder' => $request->annual_returns_reminder,
            'annual_returns_date' => timestamp($request->annual_returns_date),
            'annual_returns_date_timing' => $request->annual_returns_date_timing,
            'annual_returns_date_receivers' => $request->annual_returns_date_receivers,
            'payroll_processing_date_notification' => $request->payroll_processing_date_notification,
            'payroll_processing_date' => timestamp($request->payroll_processing_date),
            'payroll_processing_date_timing' => $request->payroll_processing_date_timing,
            'payroll_processing_date_receivers' => $request->payroll_processing_date_receivers,
            'debt_repayment_reminder' => $request->debt_repayment_reminder,
            'debt_repayment_date' => timestamp($request->debt_repayment_date),
            'debt_repayment_date_timing' => $request->debt_repayment_date_timing,
            'debt_repayment_date_receivers' => $request->debt_repayment_date_receivers
        ];
        $config->notifications = json_encode($notificaton);
        $config->save();
        return redirect()->route('configs.notifications')->with('success','success_msg');
    }

    public function email_templates()
    {
        $templates = EmailTemplate::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.configs.email', compact('templates'));
    }

    public function bill_color(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bill_color_1' => 'required',
            'bill_color_2' => 'required'
        ]);
        
        if ($validator->passes()) {
            $config = Config::find(Auth::user()->account_id);
            $config->bill_color_1 = $request->bill_color_1;
            $config->bill_color_2 = $request->bill_color_2;
            $config->save();
            return redirect()->back()->with('success','success_msg');
        }
    }

    public function quote_color(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote_color_1' => 'required',
            'quote_color_2' => 'required'
        ]);
        
        if ($validator->passes()) {
            $config = Config::find(Auth::user()->account_id);
            $config->quote_color_1 = $request->quote_color_1;
            $config->quote_color_2 = $request->quote_color_2;
            $config->save();
            return redirect()->back()->with('success','success_msg');
        }
    }

    public function invoice_color(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invoice_color_1' => 'required',
            'invoice_color_2' => 'required'
        ]);
        
        if ($validator->passes()) {
            $config = Config::find(Auth::user()->account_id);
            $config->invoice_color_1 = $request->invoice_color_1;
            $config->invoice_color_2 = $request->invoice_color_2;
            $config->save();
            return redirect()->back()->with('success','success_msg');
        }
    }

    public function payslip_color(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payslip_color_1' => 'required',
            'payslip_color_2' => 'required',
            'payslip_color_3' => 'required'
        ]);
        
        if ($validator->passes()) {
            $config = Config::find(Auth::user()->account_id);
            $config->payslip_color_1 = $request->payslip_color_1;
            $config->payslip_color_2 = $request->payslip_color_2;
            $config->payslip_color_3 = $request->payslip_color_3;
            $config->save();
            return redirect()->back()->with('success','success_msg');
        }
    }
}
