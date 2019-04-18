<?php

use App\BillItem;

if (! function_exists('format_price')) {
    function format_price($price) {
        // ...
        return number_format((float)$price, 2, '.', '');
    }
}


if (! function_exists('isActiveRoute')) {
    function isActiveRoute($route, $output = "m-menu__item--active")
    {
        if (Route::currentRouteName() == $route) return $output;
    }
}

if (! function_exists('areActiveRoutes')) {
    function areActiveRoutes(Array $routes, $output = "m-menu__item--active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }

    }
}

if (! function_exists('isConfigActive')) {
    function isConfigActive($route, $output = 'm--font-info')
    {
        if (Route::currentRouteName() == $route) return $output;
    }
}

if (! function_exists('open_for_submenu')) {
    function open_for_submenu(Array $routes, $output = "m-menu__item--open")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

if (! function_exists('to_javascript_date_format')) {
    function to_javascript_date_format($format)
    {
        $replaceable = ['m' => 'mm', 'd' => 'dd', 'Y' => 'yyyy'];
        return strtr($format, $replaceable);
    }
}

if (! function_exists('random_code')) {
    function random_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}

if (! function_exists('get_formatted_date_from_timestamp')) {
    function get_formatted_date_from_timestamp($timestamp)
    {
        if ($timestamp == 0 || $timestamp == null || $timestamp == false)
            return '';
        return date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format, $timestamp);
    }
}

if (! function_exists('get_config')) {
    function get_config($column)
    {
        return \App\Config::where('account_id', Auth::user()->account_id)->first()->$column;
    }
}

if (! function_exists('contains')) {
    function contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }
}

if (! function_exists('timestamp')) {
    function timestamp($date)
    {
        if (contains($date, '/')) $date = str_replace('/', '-', $date);
        return strtotime($date);
    }
}

if (! function_exists('has_this_timing')) {
    function has_this_timing($needle, $array)
    {
        if ($array != null) {
            return in_array($needle, $array);
        }
        return false;
    }
}

if (! function_exists('has_this_receiver')) {
    function has_this_receiver($needle, $array)
    {
        if ($array != null) {
            return in_array($needle, $array);
        }
        return false;
    }
}

if (! function_exists('get_tax_amounts_for_bill')) {
    function get_tax_amounts_for_bill($bill_id)
    {
        $taxes = BillItem::select(DB::raw('tax_id, Sum(price * qty * tax / 100) AS amount'))
                            ->where('bill_id', $bill_id)
                            ->where('tax', '>', '0')
                            ->groupBy('tax_id')
                            ->get();
        return $taxes;
    }
}

if (! function_exists('benefits_deductions_sum')) {
    function benefits_deductions_sum($object)
    {
        $sum = 0;
        $array = json_decode($object);
        foreach ($array as $val) {
            $sum += $val->amount;
        }
        return $sum;
    }
}

if (! function_exists('has_salary_head')) {
    function has_salary_head($id, $object)
    {
        if ($object == null || $object == 'null') return false;
        $array = json_decode($object);
        return in_array($id, $array) ? true : false;
    }
}

if (! function_exists('get_employee_salary_heads')) {
    function get_employee_salary_heads($employee_id, $type)
    {
        $heads = \App\Employee::find($employee_id)->$type;
        if ($heads != null) {
            $heads = json_decode($heads);
            return $heads;
        }
        return [];
    }
}

if (! function_exists('get_salary_head_value')) {
    function get_salary_head_value($heads, $salary_head_id)
    {
        $amount = 0;
        $heads = json_decode($heads);
        foreach ($heads as $head) {
            if ($head->id == $salary_head_id) {
                $amount = $head->amount;
            }
        }
        return $amount;
    }
}

if (! function_exists('calculate_unpaid_bills')) {
    function calculate_unpaid_bills()
    {
        $total_billed_amount = \App\Bill::where('account_id', Auth::user()->account_id)->sum('grand_total');
        $total_paid_amount = \App\Payment::where(['account_id' => Auth::user()->account_id, 'type' => 'bill'])->sum('amount');
        return ($total_billed_amount - $total_paid_amount);
    }
}

if (! function_exists('calculate_unpaid_bills_for_vendor')) {
    function calculate_unpaid_bills_for_vendor($vendor_id)
    {
        $total_billed_amount = \App\Bill::where('vendor_id', $vendor_id)->sum('grand_total');
        $bills = \App\Bill::where('vendor_id', $vendor_id)->get();
        $total_paid_amount = 0.0;
        foreach ($bills as $bill) {
            $paid = \App\Payment::where('bill_id', $bill->id)->sum('amount');
            $total_paid_amount += $paid;
        }
        return ($total_billed_amount - $total_paid_amount);
    }
}

if (! function_exists('calculate_paid_bills_for_vendor')) {
    function calculate_paid_bills_for_vendor($vendor_id)
    {
        $bills = \App\Bill::where('vendor_id', $vendor_id)->get();
        $total_paid_amount = 0.0;
        foreach ($bills as $bill) {
            $paid = \App\Payment::where('bill_id', $bill->id)->sum('amount');
            $total_paid_amount += $paid;
        }
        return $total_paid_amount;
    }
}

if (! function_exists('get_expense')) {
    function get_expense($period)
    {
        $expenses = \App\Expense::where('account_id', Auth::user()->account_id)->get();
        $sum = 0.0;
        switch ($period) {
            case 'month':
                foreach ($expenses as $expense) {
                    if (date('m') == date('m', $expense->date))
                        $sum += $expense->total;
                }
                return $sum;
                break;

            case '-1month':
                foreach ($expenses as $expense) {
                    if (date('m', strtotime('-1 Months')) == date('m', $expense->date))
                        $sum += $expense->total;
                }
                return $sum;
                break;

            case 'year':
                foreach ($expenses as $expense) {
                    if (date('Y') == date('Y', $expense->date))
                        $sum += $expense->total;
                }
                return $sum;
                break;
            
            default:
                break;
        }
    }
}

if (! function_exists('get_leaves_taken')) {
    function get_leaves_taken($employee_id)
    {
        $year = date('Y');
        // find the accepted leaves on running year
        $result = \App\Leave::where(['account_id' => Auth::user()->account_id, 'status' => 1, 'employee_id' => $employee_id]);
    }
}

if (! function_exists('get_leaves_remaining')) {
    function get_leaves_remaining($employee_id)
    {

    }
}

if (! function_exists('paid_bills_by_vendor')) {
    function paid_bills_by_vendor($vendor_id)
    {
        $result = 0.0;
        $bills = \App\Bill::where('vendor_id', $vendor_id)->get();
        foreach ($bills as $bill) {
            $payment = \App\Payment::where('bill_id', $bill->id)->sum('amount');
            $result += $payment;
        }
        return $result;
    }
}

if (! function_exists('unpaid_bills_by_vendor')) {
    function unpaid_bills_by_vendor($vendor_id)
    {
        $paid_bills = paid_bills_by_vendor($vendor_id);
        $total_bills = \App\Bill::where('vendor_id', $vendor_id)->sum('grand_total');
        $result = $total_bills - $paid_bills;
        return $result;
    }
}

if (! function_exists('is_permitted')) {
    function is_permitted($needle, $user_id = '')
    {
        if ($user_id == '') {
            $user_id = Auth::user()->id;
            if (Auth::user()->role == 'admin')
                return true;
        }
        $permissions = \App\UserPermission::where('user_id', $user_id)->get();
        if (count($permissions) > 0) {
            foreach ($permissions as $permission) {
                $perm = json_decode($permission->permissions);
            }
            return in_array($needle, $perm);
        }
        return false;
    }
}

if (! function_exists('profile_photo')) {
    function profile_photo($type, $id)
    {
        switch ($type) {
            case 'employee':
                $photo = \App\Employee::where('id', $id)->first()->photo;
                if ($photo != null)
                    return url('public/storage/'.$photo);
                else 
                    return asset('public/backend/assets/images/placeholder.png');
                break;
            case 'customer':
                $photo = \App\Customer::where('id', $id)->first()->photo;
                if ($photo != null)
                    return url('public/storage/'.$photo);
                else 
                    return asset('public/backend/assets/images/placeholder.png');
                break;
            default:
                return asset('public/backend/assets/images/placeholder.png');
                break;

        }
    }
}

if (! function_exists('format_bytes')) {
    function format_bytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
}

if (! function_exists('overdue_invoice_amount')) {
    function overdue_invoice_amount()
    {
        $total = 0.0;
        $paid = 0.0;
        $invoices = \App\Invoice::where(['account_id' => Auth::user()->account_id, ['due_date', '<', strtotime(date('d-m-Y'))]])->get();
        foreach ($invoices as $invoice) {
            if ($invoice->status == 'unpaid' || $invoice->status == 'partially_paid') {
                $total += $invoice->grand_total;
                $payment = \App\Payment::where('invoice_id', $invoice->id)->sum('amount');
                $paid += $payment;
            }
        }
        return ($total - $paid);
    }
}

if (! function_exists('unpaid_invoice_amount')) {
    function unpaid_invoice_amount()
    {
        $total = 0.0;
        $paid = 0.0;
        $invoices = \App\Invoice::where('account_id', Auth::user()->account_id)->get();
        foreach ($invoices as $invoice) {
            if ($invoice->status == 'unpaid' || $invoice->status == 'partially_paid') {
                $total += $invoice->grand_total;
                $payment = \App\Payment::where('invoice_id', $invoice->id)->sum('amount');
                $paid += $payment;
            }
        }
        return ($total - $paid);
    }
}

if (! function_exists('unpaid_invoice_amount_of_customer')) {
    function unpaid_invoice_amount_of_customer($customer_id)
    {
        $total = 0.0;
        $paid = 0.0;
        $invoices = \App\Invoice::where('customer_id', $customer_id)->get();
        foreach ($invoices as $invoice) {
            if ($invoice->status == 'unpaid' || $invoice->status == 'partially_paid') {
                $total += $invoice->grand_total;
                $payment = \App\Payment::where('invoice_id', $invoice->id)->sum('amount');
                $paid += $payment;
            }
        }
        return ($total - $paid);
    }
}

if (! function_exists('get_tax_amounts_for_invoice')) {
    function get_tax_amounts_for_invoice($invoice_id)
    {
        $taxes = [];
        $result = [];
        $temp_id = 0;
        $invoice = \App\Invoice::find($invoice_id);
        $items = json_decode($invoice->items);
        foreach ($items as $item) {
            if ($item->tax == 0) continue;
            $data['tax_id'] = $item->tax_id;
            $data['amount'] = ($item->price * $item->qty) * ($item->tax / 100);
            array_push($taxes, $data);
        }
        foreach ($taxes as $tax) {
            $key = $tax['tax_id'];
            if (!isset($result[$key])) {
                $result[$key] = [
                    'tax_id' => $key,
                    'amount' => $tax['amount']
                ];
            } else {
                $result[$key]['amount'] = $result[$key]['amount'] + $tax['amount'];
            }
        }
        return json_encode($result);
    }
}

if (! function_exists('serialized_code')) {
    function serialized_code($type)
    {
        $serial = '';
        $count = 0;
        if ($type == 'invoice')
            $count = \App\Invoice::where('account_id', Auth::user()->account_id)->count();
        else if ($type == 'quote')
            $count = \App\Quote::where('account_id', Auth::user()->account_id)->count();
        else if ($type == 'bill')
            $count = \App\Bill::where('account_id', Auth::user()->account_id)->count();
        else if ($type == 'employee')
            $count = \App\Employee::where('account_id', Auth::user()->account_id)->count();
        else 
            $count = 0;

        $count = $count + 1;
        $length = strlen((string)$count);
        $trim = 5 - $length;
        for ($i = 0; $i < $trim; $i++) {
            $serial .= '0'; 
        }
        return $serial . $count;
    }
}

if (! function_exists('get_tax_amounts_for_quotation')) {
    function get_tax_amounts_for_quotation($quote_id)
    {
        $taxes = [];
        $result = [];
        $temp_id = 0;
        $quote = \App\Quote::find($quote_id);
        $items = json_decode($quote->items);
        foreach ($items as $item) {
            if ($item->tax == 0) continue;
            $data['tax_id'] = $item->tax_id;
            $data['amount'] = ($item->price * $item->qty) * ($item->tax / 100);
            array_push($taxes, $data);
        }
        foreach ($taxes as $tax) {
            $key = $tax['tax_id'];
            if (!isset($result[$key])) {
                $result[$key] = [
                    'tax_id' => $key,
                    'amount' => $tax['amount']
                ];
            } else {
                $result[$key]['amount'] = $result[$key]['amount'] + $tax['amount'];
            }
        }
        return json_encode($result);
    }
}

if (! function_exists('get_expense_of_month')) {
    function get_expense_of_month($month)
    {
        $expenses = \App\Expense::where('account_id', Auth::user()->account_id)->get();
        $sum = 0.0;
        foreach ($expenses as $expense) {
            if ($month == date('m', $expense->date) && date('Y') == date('Y', $expense->date))
                $sum += $expense->total;
        }
        return $sum;
    }
}

if (! function_exists('payments_of_year')) {
    function payments_of_year($type)
    {
        $payments = \App\Payment::where(['account_id' => Auth::user()->account_id, 'type' => $type])->get();
        $sum = 0.0;
        foreach ($payments as $payment) {
            if (date('Y') == date('Y', $payment->date)) {
                $sum += $payment->amount;
            }
        }
        return $sum;
    }
}

if (! function_exists('payments_of_month')) {
    function payments_of_month($type, $month)
    {
        $payments = \App\Payment::where(['account_id' => Auth::user()->account_id, 'type' => $type])->get();
        $sum = 0.0;
        foreach ($payments as $payment) {
            if (date('Y') == date('Y', $payment->date) && $month == date('m', $payment->date)) {
                $sum += $payment->amount;
            }
        }
        return $sum;
    }
}

if (! function_exists('on_leave_today')) {
    function on_leave_today()
    {
        $today = strtotime(date('d-m-Y'));
        $match_cases = ['account_id' => Auth::user()->account_id];
        $match_cases = array_merge($match_cases, [['start', '<=', $today], ['end', '>=', $today]]);
        $result = \App\Leave::where($match_cases)->count();
        return $result;
    }
}


