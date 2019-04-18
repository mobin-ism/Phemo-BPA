<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leave;
use App\LeaveType;
use Illuminate\Support\Facades\Auth;
use Validator;
use DateTime;
use DateInterval;
use DatePeriod;
use Notification;
use App\Notifications\NewLeaveRequest;

class LeaveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $leaves = Leave::where('account_id', Auth::user()->account_id)->orderBy('created_at', 'desc')->get();
        return view('backend.pages.leaves.index', compact('leaves'));
    }

    public function create()
    {
        return view('backend.pages.leaves.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'leave_type_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'reason' => 'required',
            'attachment' => 'mimes:pdf,jpg|max:3000|nullable'
        ]);

        if ($validator->passes()) {
            $leave = new Leave;
            $leave->account_id = $request->account_id;
            $leave->employee_id = $request->employee_id;
            $leave->leave_type_id = $request->leave_type_id;
            $leave->start = timestamp($request->start);
            $leave->end = timestamp($request->end);
            $leave->reason = $request->reason;
            $end_date = contains($request->end, '/') ? str_replace('/', '-', $request->end) : $request->end;
            $start_date = contains($request->start, '/') ? str_replace('/', '-', $request->start) : $request->start;
            $end = new DateTime($end_date);
            $start = new DateTime($start_date);
            $diff = $end->diff($start);
            // check if there is weekends
            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($start, $interval ,$end);
            $weekends = 0;
            for ($date = $start; $date <= $end; $date->modify('+1 day')) {
                $day = $date->format('l');
                if ($day == 'Saturday' || $day == 'Sunday') {
                    $weekends++;
                }
            }
            $leave_days = ($diff->d + 1) - $weekends;
            $leave->days = $leave_days;
            $leave->status = $request->status;
            if ($request->attachment != null) {
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                $attachment_name = $request->employee_id . '-' . time() . '.' . $extension;
                $path = $attachment->storeAs('leave-requests/'.$request->account_id, $attachment_name);
                $leave->attachment = $path;
            }
            $employee = \App\Employee::where('id', $request->employee_id)->first();
            $employee_email = \App\User::where('id', $employee->user_id)->first()->email;
            $leave->save();
            Notification::route('mail', $employee_email)->notify(new NewLeaveRequest($request, $leave_days));

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors' => $validator->errors()]);
    }

    public function show($id)
    {
        $leave = Leave::find($id);
        return view('backend.pages.leaves.show', compact('leave'));
    }

    public function edit($id)
    {
        $leave = Leave::find($id);
        return view('backend.pages.leaves.edit', compact('leave'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'leave_type_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'reason' => 'required',
            'attachment' => 'mimes:pdf,jpg|max:3000|nullable'
        ]);

        if ($validator->passes()) {
            $leave = Leave::find($id);
            $leave->account_id = $request->account_id;
            $leave->employee_id = $request->employee_id;
            $leave->leave_type_id = $request->leave_type_id;
            $leave->start = timestamp($request->start);
            $leave->end = timestamp($request->end);
            $leave->reason = $request->reason;

            $end_date = contains($request->end, '/') ? str_replace('/', '-', $request->end) : $request->end;
            $start_date = contains($request->start, '/') ? str_replace('/', '-', $request->start) : $request->start;
            $end = new DateTime($end_date);
            $start = new DateTime($start_date);
            $diff = $end->diff($start);
            // check if there is weekends
            $weekends = 0;
            for ($date = $start; $date <= $end; $date->modify('+1 day')) {
                $day = $date->format('l');
                if ($day == 'Saturday' || $day == 'Sunday') {
                    $weekends++;
                }
            }
            $leave->days = ($diff->d + 1) - $weekends;
            $leave->status = $request->status;
            if ($request->attachment != null) {
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                $attachment_name = $request->employee_id . '-' . time() . '.' . $extension;
                $path = $attachment->storeAs('leave-requests/'.$request->account_id, $attachment_name);
                $leave->attachment = $path;
            }
            $leave->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors' => $validator->errors()]);
    }

    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        Leave::destroy($id);
        return redirect()->route('leaves.index')->with('success','delete_msg');
    }

    public function filter(Request $request)
    {
        $match_cases = [
            'account_id' => $request->account_id
        ];
        if ($request->employee_id != null)
            $match_cases = array_merge($match_cases, ['employee_id' => $request->employee_id]);
        if ($request->leave_type_id != null)
            $match_cases = array_merge($match_cases, ['leave_type_id' => $request->leave_type_id]);
        if ($request->status != null)
            $match_cases = array_merge($match_cases, ['status' => $request->status]);
        if ($request->date != null) {
            $date = timestamp($request->date);
            $match_cases = array_merge($match_cases, [['start', '<=', $date], ['end', '>=', $date]]);
        }
        $filtered_leaves = Leave::where($match_cases)->get();
        return view('backend.pages.leaves.list', compact('filtered_leaves'));
    }

    public function dynamic_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'add_name' => 'required'
        ]);
        if ($validator->passes()) {
            if ($request->add_type == 'leave_type_id') {
                $leave_type = new LeaveType;
                $leave_type->name = $request->add_name;
                $leave_type->account_id = Auth::user()->account_id;
                $leave_type->save();
                return response()->json(['success' => '1', 'leave_type_id' => $leave_type->id, 'name' => $leave_type->name, 'type' => 'leave_type']);
            }
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function download($id)
    {
        $filePath = Leave::where('id', $id)->first()->attachment;
        return response()->download(storage_path('app/'.$filePath));
    }
}
