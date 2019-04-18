@php
    $vendor_id = \App\Vendor::where('user_id', Auth::user()->id)->first()->id;
@endphp
<div class="m-content">
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.unpaid_bills')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.currently_unpaid_bills')}}
                            </span>
                            <h3 class="m--font-danger" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ \App\Bill::where(['vendor_id' => $vendor_id, 'status' => 0])->count() }}
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
                                {{__('web.partially_paid_bills')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.currently_partially_paid')}}
                            </span>
                            <h3 class="m--font-warning" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ \App\Bill::where(['vendor_id' => $vendor_id, 'status' => 1])->count() }}
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
                            <span class="m-widget24__desc">
                                {{__('web.total_paid_amount')}}
                            </span>
                            <h3 class="m--font-success" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                @php
                                    $result = calculate_paid_bills_for_vendor($vendor_id);
                                @endphp
                                {{get_config('currency')}} {{number_format($result, 2, '.', ',')}}
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
                            <span class="m-widget24__desc">
                                {{__('web.total_unpaid_amount')}}
                            </span>
                            <h3 class="m--font-danger" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                @php
                                    $result = calculate_unpaid_bills_for_vendor($vendor_id);
                                @endphp
                                {{get_config('currency')}} {{number_format($result, 2, '.', ',')}}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>
</div>