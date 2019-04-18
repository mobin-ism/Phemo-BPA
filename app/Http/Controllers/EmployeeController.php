<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Employee;
use App\User;
use App\Department;
use App\JobType;
use App\JobStatus;
use App\PayStatus;
use App\TrainingType;
use App\Note;
use App\EmployeeDocument;
use Illuminate\Support\Facades\Hash;
use PDF;
use Validator;
use Notification;
use App\Notifications\NewEmployeeAccount;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.employees.index', compact('employees'));
    }


    public function list()
    {

        $employees = Employee::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.employees.list', compact('employees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_no' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|max:255|unique:users,email',
            'personal_phone' => 'required|numeric',
            'office_phone' => 'nullable|numeric',
            'house_phone' => 'nullable|numeric',
            'emergency_phone' => 'required|numeric',
            'emergency_name' => 'required'
        ]);

        if ($validator->passes()) {
            $password = random_code(9);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'role' => 'employee',
                'account_id' => $request->account_id
            ]);
            $employee = new Employee;
            $employee->user_id = $user->id;
            $employee->account_id = $request->account_id;
            $employee->employee_no = $request->employee_no;
            $employee->surname = $request->surname;
            $employee->name = $request->name;
            $employee->nationality = $request->nationality;
            $employee->gender = $request->gender;
            $employee->ethnicity = $request->ethnicity;
            $employee->religion = $request->religion;
            $employee->nid = $request->nid;
            $employee->passport = $request->passport;
            $employee->tax_no = $request->tax_no;
            $employee->marital_status = $request->marital_status;
            $employee->bday = timestamp($request->bday);
            $employee->joined_date = timestamp($request->joined_date);
            $employee->probation_date = timestamp($request->probation_date);
            $employee->effective_date = timestamp($request->effective_date);
            $employee->job_type_id = $request->job_type_id;
            $employee->job_status_id = $request->job_status_id;
            $employee->department_id = $request->department_id;
            $employee->position = $request->position;
            $employee->line_manager = $request->line_manager;
            $employee->branch = $request->branch;
            $employee->personal_phone = $request->personal_phone;
            $employee->office_phone = $request->office_phone;
            $employee->house_phone = $request->house_phone;
            $employee->emergency_name = $request->emergency_name;
            $employee->emergency_email = $request->emergency_email;
            $employee->emergency_phone = $request->emergency_phone;
            $employee->emergency_address = $request->emergency_address;
            $employee->save();

            Notification::route('mail', $request->email)->notify(new NewEmployeeAccount($request, $password));

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('backend.pages.employees.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('backend.pages.employees.edit', compact('employee'));
    }

    public function edit_personal($id)
    {
        $employee = Employee::where('id', $id)->first();
        return view('backend.pages.employees.edit_personal', compact('employee'));
    }

    public function edit_job($id)
    {
        $employee = Employee::where('id', $id)->first();
        return view('backend.pages.employees.edit_job', compact('employee'));
    }

    public function update_personal(Request $request)
    {
        $employee = Employee::find($request->id);

        $validator = Validator::make($request->all(), [
            'employee_no' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'personal_phone' => 'required|numeric',
            'office_phone' => 'nullable|numeric',
            'house_phone' => 'nullable|numeric',
            'emergency_phone' => 'required|numeric',
            'emergency_name' => 'required'
        ]);

        if ($validator->passes()) {
            User::find($employee->user_id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            $employee->employee_no = $request->employee_no;
            $employee->surname = $request->surname;
            $employee->name = $request->name;
            $employee->nationality = $request->nationality;
            $employee->gender = $request->gender;
            $employee->ethnicity = $request->ethnicity;
            $employee->religion = $request->religion;
            $employee->nid = $request->nid;
            $employee->passport = $request->passport;
            $employee->tax_no = $request->tax_no;
            $employee->marital_status = $request->marital_status;
            $employee->bday = timestamp($request->bday);
            $employee->personal_phone = $request->personal_phone;
            $employee->office_phone = $request->office_phone;
            $employee->house_phone = $request->house_phone;
            $employee->emergency_name = $request->emergency_name;
            $employee->emergency_email = $request->emergency_email;
            $employee->emergency_phone = $request->emergency_phone;
            $employee->emergency_address = $request->emergency_address;
            $employee->facebook = $request->facebook;
            $employee->twitter = $request->twitter;
            $employee->linkedin = $request->linkedin;
            $employee->skype = $request->skype;
            $employee->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function update_job(Request $request)
    {
        $employee = Employee::find($request->id);

        $employee->department_id = $request->department_id;
        $employee->joined_date = timestamp($request->joined_date);
        $employee->probation_date = timestamp($request->probation_date);
        $employee->job_type_id = $request->job_type_id;
        $employee->job_status_id = $request->job_status_id;
        $employee->pay_status_id = $request->pay_status_id;
        $employee->pay_in_figures = $request->pay_in_figures;
        $employee->position = $request->position;
        $employee->line_manager = $request->line_manager;
        $employee->branch = $request->branch;
        $employee->effective_date = timestamp($request->effective_date);
        $employee->exit_date = timestamp($request->exit_date);
        $employee->save();

        $request->session()->flash('success', 'success_msg');
        return response()->json(['success' => '1']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        Employee::destroy($id);
        return redirect()->route('employees.list')
            ->with('success','Employee deleted successfully');
    }

    public function payment_slip(Request $request)
    {
        return view('backend.pages.employees.create_payment_slip');
    }

    public function download_payment_slip(Request $request)
    {   
        $data = $request->all();
        $pdf = PDF::loadView('pdf.pay_slip', compact('data'));
        return $pdf->download('pay_slip-'.$request->employee_id.'.pdf');
    }

    public function get_employee_salary(Request $request)
    {
        return Employee::where('id', $request->id)->first()->salary;
    }

    public function dynamic_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'add_name' => 'required'
        ]);
        if ($validator->passes()) {
            if ($request->add_type == 'department_id') {
                $department = new Department;
                $department->name = $request->add_name;
                $department->account_id = Auth::user()->account_id;
                $department->save();
                return response()->json(['success' => '1', 'department_id' => $department->id, 'name' => $department->name, 'type' => 'department']);
            } else if ($request->add_type == 'job_type_id') {
                $jobType = new JobType;
                $jobType->name = $request->add_name;
                $jobType->account_id = Auth::user()->account_id;
                $jobType->save();
                return response()->json(['success' => '1', 'job_type_id' => $jobType->id, 'name' => $jobType->name, 'type' => 'jobType']);
            } else if ($request->add_type == 'job_status_id') {
                $jobStatus = new JobStatus;
                $jobStatus->name = $request->add_name;
                $jobStatus->account_id = Auth::user()->account_id;
                $jobStatus->save();
                return response()->json(['success' => '1', 'job_status_id' => $jobStatus->id, 'name' => $jobStatus->name, 'type' => 'jobStatus']);
            } else if ($request->add_type == 'pay_status_id') {
                $payStatus = new PayStatus;
                $payStatus->name = $request->add_name;
                $payStatus->account_id = Auth::user()->account_id;
                $payStatus->save();
                return response()->json(['success' => '1', 'pay_status_id' => $payStatus->id, 'name' => $payStatus->name, 'type' => 'payStatus']);
            } else if ($request->add_type == 'training_type_id') {
                $trainingType = new TrainingType;
                $trainingType->name = $request->add_name;
                $trainingType->account_id = Auth::user()->account_id;
                $trainingType->save();
                return response()->json(['success' => '1', 'training_type_id' => $trainingType->id, 'name' => $trainingType->name, 'type' => 'trainingType']);
            }
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',
            'file.*' => 'mimes:pdf,jpg|max:5000'
        ]);

        if ($validator->passes()) {
            if ($request->hasFile('file')) {
                $docs = $request->file('file');
                foreach ($docs as $doc) {
                    $docName = $request->employee_id . '-' . time() . '.' . $doc->getClientOriginalName();
                    $docExtension = $doc->getClientOriginalExtension();
                    $docSize = $doc->getSize();
                    $path = $doc->storeAs('employee-documents/'.$request->employee_id, $docName);
        
                    $empDoc = new EmployeeDocument;
                    $empDoc->employee_id = $request->employee_id;
                    $empDoc->file = $docName;
                    $empDoc->type = $docExtension;
                    $empDoc->size = $docSize;
                    $empDoc->path = $path;
                    $empDoc->save();
                } 
                $employee_id = $request->employee_id;
                return view('backend.pages.employees.doc_list', compact('employee_id'));
            }
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function download($fileName)
    {
        $filePath = EmployeeDocument::where('file', $fileName)->first()->path;
        return response()->download(storage_path('app/'.$filePath));
    }

    public function trash($fileName)
    {
        $docRow = EmployeeDocument::where('file', $fileName)->first();
        $filePath = $docRow->path;
        if (file_exists(storage_path('app/'.$filePath))) {
            unlink(storage_path('app/'.$filePath));
        }
        EmployeeDocument::destroy($docRow->id);
        return back()->with('success','delete_msg');
    }

    public function edit_label($id)
    {
        $doc = EmployeeDocument::where('id', $id)->first();
        return view('backend.pages.employees.edit_label', compact('doc'));
    }

    public function label(Request $request)
    {
        $doc = EmployeeDocument::find($request->id);

        $validator = Validator::make($request->all(), [
            'label' => 'required'
        ]);

        if ($validator->passes()) {
            $doc->label = $request->label;
            $doc->save();
            $employee_id = $request->employee_id;
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function edit_salary_heads($id)
    {
        $employee = Employee::find($id);
        return view('backend.pages.employees.heads', compact('employee'));
    }

    public function update_salary_heads(Request $request)
    {
        $employee = Employee::find($request->id);
        $employee->benefits = json_encode($request->benefits);
        $employee->deductions = json_encode($request->deductions);
        $employee->save();
        $request->session()->flash('success', 'success_msg');
        return response()->json(['success' => '1']);
    }

    public function filter_payroll(Request $request)
    {   
        $match_cases = [
            'account_id' => $request->account_id,
            'employee_id' => $request->employee_id,
            'year' => $request->year
        ];
        if ($request->month != null)
            $match_cases = array_merge($match_cases, ['month' => $request->month]);
        $filtered_payrolls = \App\Payroll::where($match_cases)->get();
        return view('backend.pages.employees.payrolls', compact('filtered_payrolls'));
    }

    public function filter(Request $request)
    {
        $match_cases = [
            'account_id' => $request->account_id
        ];
        if ($request->department_id != null)
            $match_cases = array_merge($match_cases, ['department_id' => $request->department_id]);
        if ($request->needle != null)
            $match_cases = array_merge($match_cases, ['employee_no' => $request->needle]);
        $filtered_employees = Employee::where($match_cases)->get();
        return view('backend.pages.employees.list', compact('filtered_employees'));
    }

    public function change_status(Request $request) {
        $employee = Employee::find($request->employee_id);
        $employee->status = $request->status;
        $employee->save();
    }

    public function leave_entitlement($employee_id)
    {
        $employee = Employee::find($employee_id);
        return view('backend.pages.employees.leave_entitlements', compact('employee'));
    }

    public function save_leave_entitlements(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        $values = [];
        if ($request->has('id')) {
            foreach ($request->id as $key => $entry) {
                $data['id'] = $request->id[$key];
                $data['name'] = $request->name[$key];
                $data['days'] = $request->days[$key];
                array_push($values, $data);
            }
            $employee->leave_allocation = json_encode($values);
            $employee->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
    }

    public function photo($id)
    {
        return view('backend.pages.employees.photo', ['id' => $id]);
    }

    public function upload_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attachment' => 'required|mimes:png|max:2000'
        ]);

        if ($validator->passes()) {
            $employee = Employee::find($request->id);
            $account_id = Auth::user()->account_id;
            if ($request->has('attachment')) {
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                $attachment_name = $request->id . '.' . $extension;
                $path = $attachment->storeAs('public/employee-photos/' . $account_id, $attachment_name);
                $employee->photo = 'employee-photos/' . $account_id . '/' .$attachment_name;
            }
            $employee->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function search(Request $request)
    {
        $account_id = Auth::user()->account_id;
        $needle = $request->needle;
        $filtered_employees = Employee::where('account_id', $account_id)->where('name', 'LIKE', "%$needle%")->get();
        return view('backend.pages.employees.list', compact('filtered_employees'));
    }

    public function search_department(Request $request)
    {
        $account_id = Auth::user()->account_id;
        $department_id = $request->department_id;
        $match_cases = [
            'account_id' => $account_id
        ];
        if ($request->department_id != 0)
            $match_cases = array_merge($match_cases, ['department_id' => $department_id]);
        $filtered_employees = Employee::where($match_cases)->get();
        return view('backend.pages.employees.list', compact('filtered_employees'));
    }

    public function import_excel()
    {
        return view('backend.pages.employees.import');
    }
}
