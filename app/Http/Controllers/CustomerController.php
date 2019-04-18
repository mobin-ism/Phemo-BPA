<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;
use App\Statement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomersCompanyImport;
use App\Imports\CustomersIndividualImport;
use App\Imports\UsersImport;
use Notification;
use App\Notifications\NewCustomerAccount;
use App\Notifications\NewCustomerStatement;
use App\CustomerCategory;

class CustomerController extends Controller
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
        return view('backend.pages.customers.index');
    }

    public function company_list()
    {
        $customers = Customer::where([
            ['account_id', Auth::user()->account_id],
            ['customer_type', 'company']])->get();
        $customer_type =  'company';
            return view('backend.pages.customers.list.company',compact(['customers', 'customer_type']));
    }

    public function individual_list()
    {
        $customers = Customer::where([
            ['account_id', Auth::user()->account_id],
            ['customer_type', 'individual']])->get();
        $customer_type =  'individual';
        return view('backend.pages.customers.list.individual',compact(['customers', 'customer_type']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.pages.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->customer_type == 'company') {
            $name = $request->primary_contact;
            $validate = [
                'company_name' => 'required',
                'primary_contact' => 'required',
                'email' => 'required|email|max:255|unique:customers,email|unique:users,email',
                'city' => 'required',
                'country_id' => 'required'
            ];
        } else {
            $name = $request->customer_name;
            $validate = [
                'customer_name' => 'required',
                'surname' => 'required',
                'email' => 'required|email|max:255|unique:customers,email|unique:users,email',
                'city' => 'required',
                'country_id' => 'required'
            ];
        }

        $validator = Validator::make($request->all(), $validate);

        if ($validator->passes()) {
            $password = random_code(9);
            $user = User::create([
                'name' => $name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'role' => 'customer',
                'account_id' => $request->account_id
            ]);
            Customer::create(array_merge($request->all(), ['user_id' => $user->id]));
            Notification::route('mail', $request->email)->notify(new NewCustomerAccount($request->account_id, $password, $name));
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
    public function show(Customer $customer)
    {
        return view('backend.pages.customers.show',compact('customer'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('backend.pages.customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        if ($request->customer_type == 'company') {
            $name = $request->primary_contact;
            $validate = [
                'company_name' => 'required',
                'primary_contact' => 'required',
                'email' => 'required|email',
                'city' => 'required',
                'country_id' => 'required'
            ];
        } else {
            $name = $request->customer_name;
            $validate = [
                'customer_name' => 'required',
                'surname' => 'required',
                'email' => 'required|email',
                'city' => 'required',
                'country_id' => 'required'
            ];
        }

        $validator = Validator::make($request->all(), $validate);

        if ($validator->passes()) {
            User::find($customer->user_id)->update([
                'name' => $name,
                'email' => $request->email
            ]);
            $customer->update($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
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
        $customer = Customer::find($id);
        $customer_type = $customer->customer_type;
        User::destroy($customer->user_id);
        Customer::destroy($id);
        return back()->with('success','delete_msg');

    }

    public function getCustomerInfo(Request $request){
        $customer = Customer::find($request->customer_id);
        
        $name = $customer->customer_type == 'company' ? $customer->primary_contact : $customer->customer_name;
        $val = array( 'customer_id' => $customer->id, 'name' => $name, 'customer_type' => $customer->customer_type, 'company_name' => $customer->company_name,
                        'email' => $customer->email, 'address' => $customer->address);

        return response()->json($val);
    }

    public function filter_quotes(Request $request)
    {
        $match_cases = [
            'customer_id' => $request->customer_id
        ];
        if ($request->status != null)
            $match_cases = array_merge($match_cases, ['status' => $request->status]);
        if ($request->issue_date != null) {
            $issue_date = explode(' - ', $request->issue_date);
            $issue_start = timestamp($issue_date[0]);
            $issue_end = timestamp($issue_date[1]);
            $match_cases = array_merge($match_cases, [['issue_date', '>=', $issue_start], ['issue_date', '<=', $issue_end]]);
        }
        if ($request->expiry_date != null) {
            $expiry_date = explode(' - ', $request->expiry_date);
            $expiry_start = timestamp($expiry_date[0]);
            $expiry_end = timestamp($expiry_date[1]);
            $match_cases = array_merge($match_cases, [['expiry_date', '>=', $expiry_start], ['expiry_date', '<=', $expiry_end]]);
        }
        $filtered_quotes = \App\Quote::where($match_cases)->get();
        return view('backend.pages.customers.quotes', compact('filtered_quotes'));
    }

    public function import_excel($type)
    {
        return view('backend.pages.customers.import', ['type' => $type]);
    }

    public function download_sample_excel($type)
    {
        return response()->download(storage_path('app/samples/customers-' . $type . '.xlsx'));
    }

    public function import(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'attachment' => 'required'
        ]);

        if ($validator->passes()) {
            $attachment = $request->file('attachment');
            $extension = $attachment->getClientOriginalExtension();
            if ($extension == 'xlsx') {
                $attachment_name ='customers-' . $request->type . random_code(7) . '.' . $extension;
                $path = $attachment->storeAs('/', $attachment_name);
                Excel::import(new UsersImport($request->type), $attachment_name);
                if ($request->type == 'individual') {
                    Excel::import(new CustomersIndividualImport($request->type), $attachment_name);
                } else {
                    Excel::import(new CustomersCompanyImport($request->type), $attachment_name);
                }
                // insert user id in  customer table
                $customers = Customer::where(['account_id' => Auth::user()->account_id, 'user_id' => null])->get();
                foreach ($customers as $customer) {
                    $password = random_code(9);
                    $email = $customer->email;
                    $user = User::where(['account_id' => Auth::user()->account_id, 'role' => 'customer', 'email' => $email])->first();
                    $user_id = $user->id;
                    $customer->user_id = $user_id;
                    $customer->save();
                    $user->password = Hash::make($password);
                    $user->save();
                    Notification::route('mail', $email)->notify(new NewCustomerAccount($customer->account_id, $password, $user->name));
                }
                unlink(storage_path('app/' . $path));
                if ($request->type == 'company')
                    return redirect()->route('customers.company_list')->with('success','success_msg');
                return redirect()->route('customers.individual_list')->with('success','success_msg');
            }
            return back();
        }
        return back();
    }

    public function photo($id)
    {
        return view('backend.pages.customers.photo', ['id' => $id]);
    }

    public function upload_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attachment' => 'mimes:png|max:2000|nullable'
        ]);

        if ($validator->passes()) {
            $customer = Customer::find($request->id);
            $account_id = Auth::user()->account_id;
            if ($request->attachment != null) {
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                $attachment_name = $request->id . '.' . $extension;
                $path = $attachment->storeAs('public/customer-photos/' . $account_id, $attachment_name);
                $customer->photo = 'customer-photos/' . $account_id . '/' .$attachment_name;
            }
            $customer->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function filter_invoices(Request $request)
    {
        $match_cases = [
            'customer_id' => $request->customer_id
        ];
        if ($request->status != null)
            $match_cases = array_merge($match_cases, ['status' => $request->status]);
        if ($request->issue_date != null) {
            $issue_date = explode(' - ', $request->issue_date);
            $issue_start = timestamp($issue_date[0]);
            $issue_end = timestamp($issue_date[1]);
            $match_cases = array_merge($match_cases, [['issue_date', '>=', $issue_start], ['issue_date', '<=', $issue_end]]);
        }
        if ($request->due_date != null) {
            $due_date = explode(' - ', $request->due_date);
            $due_start = timestamp($due_date[0]);
            $due_end = timestamp($due_date[1]);
            $match_cases = array_merge($match_cases, [['due_date', '>=', $due_start], ['due_date', '<=', $due_end]]);
        }
        $filtered_invoices = \App\Invoice::where($match_cases)->get();
        return view('backend.pages.customers.invoices', compact('filtered_invoices'));
    }

    public function change_status(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->status = $request->status;
        $customer->save();
    }

    public function generate_statement(Request $request)
    {
        if ($request->has('statement_date_range')) {
            $account_id = Auth::user()->account_id;
            $customer_id = $request->customer_id;
            $status = $request->status;
            $date = explode(' - ', $request->statement_date_range);
            $start = timestamp($date[0]);
            $end = timestamp($date[1]);
            
            $match_cases = [
                'account_id' => $account_id,
                'customer_id' => $customer_id
            ];
            $match_cases = array_merge($match_cases, [['due_date', '>=', $start], ['due_date', '<=', $end]]);
            
            if ($status == 'paid') {
                $invoices = \App\Invoice::where([
                    ['account_id', $account_id],
                    ['customer_id', $customer_id],
                    ['due_date', '>=', $start],
                    ['due_date', '<=', $end],
                    ['status', 'paid']
                ])->get();
            } else if ($status == 'unpaid') {
                $invoices = \App\Invoice::where([
                    ['account_id', $account_id],
                    ['customer_id', $customer_id],
                    ['due_date', '>=', $start],
                    ['due_date', '<=', $end],
                    ['status', 'unpaid']
                ])->orWhere('status', 'partially_paid')->get();
            } else {
                $invoices = \App\Invoice::where($match_cases)->get();
            }
            $customer_info = Customer::where('id', $customer_id)->first();
            $customer_name = \App\User::where('id', $customer_info->user_id)->first()->name;
            // save the statement if not present already
            $statement = Statement::updateOrCreate(
                [
                    'customer_id' => $customer_id,
                    'start' => $start,
                    'end' => $end,
                    'status' => $status
                ],
                ['account_id' => Auth::user()->account_id, 'code' => random_code(8)]
            );
            return view('backend.pages.customers.statement', compact('invoices', 'customer_info', 'statement'));
        }
    }

    public function statements()
    {
        if (Auth::user()->role == 'customer') {
            $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
            $customer_info = Customer::where('id', $customer_id)->first();
            $statements = Statement::where('customer_id', $customer_id)->orderBy('created_at', 'desc')->get();
            return view('backend.pages.customers.statements', compact('customer_info', 'statements'));
        }
    }

    public function statement_view($id)
    {
        $statement = Statement::where('id', $id)->first();
        $customer_info = Customer::where('id', $statement->customer_id)->first();
        $match_cases = [
            'customer_id' => $statement->customer_id
        ];
        $match_cases = array_merge($match_cases, [['due_date', '>=', $statement->start], ['due_date', '<=', $statement->end]]);
        if ($statement->status == 'paid') {
            $invoices = \App\Invoice::where([
                ['customer_id', $statement->customer_id],
                ['due_date', '>=', $statement->start],
                ['due_date', '<=', $statement->end],
                ['status', 'paid']
            ])->get();
        }  else if ($statement->status == 'unpaid') {
            $invoices = \App\Invoice::where([
                ['customer_id', $statement->customer_id],
                ['due_date', '>=', $statement->start],
                ['due_date', '<=', $statement->end],
                ['status', 'unpaid']
            ])->orWhere('status', 'partially_paid')->get();
        } else {
            $invoices = \App\Invoice::where($match_cases)->get();
        }
        return view('backend.pages.customers.statement_view', compact('statement', 'invoices', 'customer_info'));
    }

    public function email_statement($id)
    {
        $statement = Statement::where('id', $id)->first();
        $customer = Customer::where('id', $statement->customer_id)->first();
        $customer_name = User::where('id', $customer->user_id)->first()->name;
        Notification::route('mail', $customer->email)->notify(new NewCustomerStatement($customer_name, $statement->code));
        return 'successfully sent email';
    }

    public function dynamic_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'add_name' => 'required'
        ]);
        if ($validator->passes()) {
            if ($request->add_type == 'customer_category_id') {
                $category = new CustomerCategory;
                $category->name = $request->add_name;
                $category->account_id = Auth::user()->account_id;
                $category->save();
                return response()->json(['success' => '1', 'customer_category_id' => $category->id, 'name' => $category->name, 'type' => 'category']);
            }
        }
        return response()->json(['errors'=>$validator->errors()]);
    }
}
