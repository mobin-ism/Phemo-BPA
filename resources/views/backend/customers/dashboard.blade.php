@php
    $customer_id = \App\Customer::where('user_id', Auth::user()->id)->first()->id;
@endphp
<div class="m-content">
<a href="{{route('customer.quotes')}}" style="text-decoration: none;">
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.active_quotations')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.currently_active')}}
                            </span>
                            <h3 class="m--font-primary" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ \App\Quote::where(['customer_id' => $customer_id, 'status' => 'active'])->count() }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.new_quotations')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.currently_pending')}}
                            </span>
                            <h3 class="m--font-warning" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ \App\Quote::where(['customer_id' => $customer_id, 'status' => 'pending'])->count() }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.approved_quotations')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.total_approved')}}
                            </span>
                            <h3 class="m--font-success" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ \App\Quote::where(['customer_id' => $customer_id, 'status' => 'invoiced'])->count() }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.quotation_amount')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.total_amount')}}
                            </span>
                            <h3 class="m--font-brand" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{get_config('currency')}} {{number_format(\App\Quote::where('customer_id', $customer_id)->sum('grand_total'), 2, '.', ',')}}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>
</a>
<a href="{{route('customer.invoices')}}" style="text-decoration: none;">
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.invoices')}}
                            </h4><br>
                            <h3 class="m--font-primary" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{-- @php
                                    $count = 0;
                                    $overdue_invoices = \App\Invoice::where(['account_id' => Auth::user()->account_id, ['due_date', '<', strtotime(date('d-m-Y'))]])->get();
                                    foreach ($overdue_invoices as $ov) {
                                        if ($ov->status == 'unpaid' || $ov->status == 'partially_paid') {
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                @endphp --}}
                                {{\App\Invoice::where('customer_id', $customer_id)->count()}}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.total_amount')}}
                            </h4><br>
                            <h3 class="m--font-brand" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                @php
                                    $total = \App\Invoice::where('customer_id', $customer_id)->sum('grand_total');
                                    $unpaid = unpaid_invoice_amount_of_customer($customer_id);
                                    $paid = $total - $unpaid;
                                @endphp
                                {{get_config('currency')}} {{number_format($total, 2, '.', ',')}}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.paid_amount')}}
                            </h4><br>
                            <h3 class="m--font-success" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{-- {{ \App\Invoice::where('account_id', Auth::user()->account_id)->where('status', 'unpaid')->orWhere('status', 'partially_paid')->count() }} --}}
                                {{get_config('currency')}} {{number_format($paid, 2, '.', ',')}}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.unpaid_amount')}}
                            </h4><br>
                            <h3 class="m--font-danger" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{get_config('currency')}} {{number_format(unpaid_invoice_amount_of_customer($customer_id), 2, '.', ',')}}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>
</a>
<a href="{{route('customer.tickets')}}" style="text-decoration: none;">
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.pending_tickets')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.currently_pending_tickets')}}
                            </span>
                            <h3 class="m--font-warning" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ \App\Ticket::where(['customer_id' => $customer_id, 'resolve_status' => 'pending'])->count() }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.high_priority')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.high_priority_tickets')}}
                            </span>
                            <h3 class="m--font-danger" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ \App\Ticket::where(['customer_id' => $customer_id, 'resolve_status' => 'pending', 'priority' => 'high'])->count() }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.resolved_tickets')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.total_solved_tickets')}}
                            </span>
                            <h3 class="m--font-success" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ \App\Ticket::where(['customer_id' => $customer_id, 'resolve_status' => 'resolved'])->count() }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.resolved_this_month')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.resolved_tickets_this_month')}}
                            </span>
                            <h3 class="m--font-brand" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ \App\Ticket::where(['customer_id' => $customer_id, 'resolve_status' => 'resolved'])->whereMonth('created_at', date('m'))->count() }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>
</a>
</div>