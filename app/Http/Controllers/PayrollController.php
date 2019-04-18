<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payroll;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewPayslip;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $current_year = date('Y');
        $current_month = date('m');
        $match_cases = [
            'account_id' => Auth::user()->account_id,
            'month' => $current_month,
            'year' => $current_year
        ];
        $payrolls = Payroll::where($match_cases)->get();
        return view('backend.pages.payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        return view('backend.pages.payrolls.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'month' => 'required',
            'year' => 'required',
            'employee_id' => 'required',
            'status' => 'required',
            'salary' => 'required'
        ]);

        if ($validator->passes()) {
            $employee = \App\Employee::where('id', $request->employee_id)->first();
            $employee_email = \App\User::where('id', $employee->user_id)->first()->email;
            $payroll = new Payroll;
            $code = random_code(8);
            $payroll->code = $code;
            $payroll->account_id = $request->account_id;
            $payroll->employee_id = $request->employee_id;
            if ($request->department_id != null) {
                $payroll->department_id = $request->department_id;
            } else {
                $payroll->department_id = \App\Employee::find($request->employee_id)->department_id;
            }
            $payroll->month = $request->month;
            $payroll->year = $request->year;
            $payroll->salary = $request->salary;
            $payroll->net_salary = $request->net_salary;
            if ($request->has('benefit_id')) {
                $benefits = [];
                $benefit = $request->benefit_id;
                for ($i = 0; $i < count($benefit); $i++) {
                    $b_data['id'] = $request->benefit_id[$i];
                    $b_data['name'] = $request->benefit_name[$i];
                    $b_data['amount'] = $request->benefits[$i];
                    array_push($benefits, $b_data);
                }
                $payroll->benefits = json_encode($benefits);
            }
            if ($request->has('deduction_id')) {
                $deductions = [];
                $deduction = $request->deduction_id;
                for ($i = 0; $i < count($deduction); $i++) {
                    $d_data['id'] = $request->deduction_id[$i];
                    $d_data['name'] = $request->deduction_name[$i];
                    $d_data['amount'] = $request->deductions[$i];
                    array_push($deductions, $d_data);
                }
                $payroll->deductions = json_encode($deductions);
            }
            $payroll->status = $request->status;
            $payroll->save();
            Notification::route('mail', $employee_email)->notify(new NewPayslip($request, $code));
            return redirect()->route('payrolls.index')->with('success','success_msg');
        }
        return redirect()->back()->withErrors($validator);
    }

    public function show(Payroll $payroll)
    {
        return view('backend.pages.payrolls.show', compact('payroll'));
    }

    public function edit(Payroll $payroll)
    {
        return view('backend.pages.payrolls.edit', compact('payroll'));
    }

    public function update(Request $request, Payroll $payroll)
    {
        $payroll->month = $request->month;
        $payroll->year = $request->year;
        $payroll->net_salary = $request->net_salary;
        if ($request->has('benefit_id')) {
            $benefits = [];
            $benefit = $request->benefit_id;
            for ($i = 0; $i < count($benefit); $i++) {
                $b_data['id'] = $request->benefit_id[$i];
                $b_data['name'] = $request->benefit_name[$i];
                $b_data['amount'] = $request->benefits[$i];
                array_push($benefits, $b_data);
            }
            $payroll->benefits = json_encode($benefits);
        }
        if ($request->has('deduction_id')) {
            $deductions = [];
            $deduction = $request->deduction_id;
            for ($i = 0; $i < count($deduction); $i++) {
                $d_data['id'] = $request->deduction_id[$i];
                $d_data['name'] = $request->deduction_name[$i];
                $d_data['amount'] = $request->deductions[$i];
                array_push($deductions, $d_data);
            }
            $payroll->deductions = json_encode($deductions);
        }
        $payroll->status = $request->status;
        $payroll->save();
        return redirect()->route('payrolls.index')->with('success','success_msg');
    }

    public function delete($id)
    {
        Payroll::destroy($id);
        return redirect()->back()->with('success','delete_msg');
    }

    public function filter(Request $request)
    {
        $match_cases = [
            'account_id' => $request->account_id,
            'month' => $request->month,
            'year' => $request->year,
            'status' => $request->status
        ];
        if ($request->department_id != null)
            $match_cases = array_merge($match_cases, ['department_id' => $request->department_id]);
        if ($request->employee_id != null)
            $match_cases = array_merge($match_cases, ['employee_id' => $request->employee_id]);
        $filtered_payrolls = Payroll::where($match_cases)->get();
        return view('backend.pages.payrolls.list', compact('filtered_payrolls'));
    }

    public function filter_employee(Request $request)
    {
        $account_id = $request->account_id;
        $department_id = $request->department_id == null ? 'NULL' : $request->department_id;
        $employees = DB::select(DB::raw(
            "SELECT * FROM employees
            WHERE `account_id` = '$account_id' AND
            `department_id` = COALESCE($department_id, department_id)"
        ));
        $response = [];
        foreach ($employees as $employee) {
            $data['id'] = $employee->id;
            $data['name'] = \App\User::where('id', $employee->user_id)->first()->name;
            array_push($response, $data);
        }
        return json_encode($response);
    }

    public function get_salary_heads(Request $request)
    {
        $employee_id = $request->employee_id;
        $employee_info = \App\Employee::find($employee_id);
        return view('backend.pages.payrolls.heads', compact('employee_info'));
    }
}
