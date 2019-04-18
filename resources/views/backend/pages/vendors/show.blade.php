@if(is_permitted('vendor_view'))
@extends('backend.layouts.master')
@section('content')
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.vendor_profile')}}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="{{route('vendors.index')}}" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('web.all_vendors')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="m-portlet m-portlet--full-height  ">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            {{-- <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <img src="{{asset('backend/assets/images/user_placeholder.png')}}" alt="" />
                                </div>
                            </div> --}}
                            <div class="m-card-profile__details">
                                <span class="m-card-profile__name">{{$vendor->name}}</span>
                            </div>
                        </div>
                        <div class="m-portlet__body-separator"></div>
                        <div class="m-widget1 m-widget1--paddingless">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">{{__('web.total_bill')}}</h3>
                                        <span class="m-widget1__desc">{{__('web.total_billed_amount')}}</span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand">
                                            {{number_format(\App\Bill::where('vendor_id', $vendor->id)->sum('grand_total'), 2, '.', ',')}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">{{__('web.unpaid')}}</h3>
                                        <span class="m-widget1__desc">{{__('web.amount_unpaid')}}</span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-danger">
                                            {{number_format(unpaid_bills_by_vendor($vendor->id), 2, '.', ',')}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">{{__('web.paid')}}</h3>
                                        <span class="m-widget1__desc">{{__('web.total_amount_paid')}}</span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-success">
                                            {{number_format(paid_bills_by_vendor($vendor->id), 2, '.', ',')}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if (is_permitted('vendor_edit') || is_permitted('vendor_delete'))
                            <div class="m-portlet__body-separator"></div>
                            <div class="m-widget1 m-widget1--paddingless">
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">{{__('web.active')}}</h3>
                                            <span class="m-widget1__desc">{{__('web.vendor_status')}}</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-brand">
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" name="status" value="1" id="status"
                                                        @if ($vendor->status == 1) checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                        <i class="flaticon-user" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.basic_information')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                        <i class="flaticon-placeholder-2" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.address')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                        <i class="flaticon-file-1" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.bills')}}"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_user_profile_tab_1">
                            <div class="m-portlet__body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-4">
                                            <span>{{__('web.company_name')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->name}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.contact_person')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->contact_person}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.contact_email')}}</span><br>
                                            <a href="mailto:{{$vendor->contact_email}}" class="m-link">
                                                <span class="m--font-bolder">{{$vendor->contact_email}}</span>
                                            </a>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.company_phone')}}</span><br>
                                            <a href="tel:{{$vendor->company_phone}}" class="m-link">
                                                <span class="m--font-bolder">{{$vendor->company_phone}}</span>
                                            </a>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.work_number')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->work_number}}</span>
                                        </div>
                                        <div>
                                            <span>{{__('web.cell_phone')}}</span><br>
                                            <a href="tel:{{$vendor->cell_phone}}" class="m-link">
                                                <span class="m--font-bolder">{{$vendor->cell_phone}}</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-4">
                                            <span>{{__('web.tax_number')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->tax_number}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.swift_code')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->swift_code}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.iban')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->iban}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.skype_id')}}</span><br>
                                            <a href="skype:{{$vendor->skype_id}}call" class="m-link">
                                                <span class="m--font-bolder">{{$vendor->skype_id}}</span>
                                            </a>
                                        </div>
                                        <div>
                                            <span>{{__('web.website')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->website}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_2">
                            <div class="m-portlet__body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-4">
                                            <span>{{__('web.address_line_1')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->address_line_1}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.address_line_2')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->address_line_2}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.city')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->city}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.state')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->state}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.zip_code')}}</span><br>
                                            <span class="m--font-bolder">{{$vendor->zip_code}}</span>
                                        </div>
                                        <div>
                                            <span>{{__('web.country')}}</span><br>
                                            <span class="m--font-bolder">
                                                @if ($vendor->country_id != null) {{$vendor->country->name}} @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_3">
                            <div class="m-portlet__body">
                                <div class="m-portlet m-portlet--mobile">
                                    <div class="m-portlet__body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>{{__('web.bill_no')}}</th>
                                                                <th>{{__('web.po_no')}}</th>
                                                                <th>{{__('web.bill_date')}}</th>
                                                                <th>{{__('web.due_date')}}</th>
                                                                <th>{{__('web.amount')}}</th>
                                                                <th>{{__('web.status')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach(\App\Bill::where('vendor_id', $vendor->id)->orderBy('created_at', 'desc')->get() as $key => $bill)
                                                            <tr>
                                                                <td>{{$key + 1}}</td>
                                                                <td>
                                                                    <a href="{{route('bills.show', $bill->id)}}" class="m-link">
                                                                        {{$bill->bill_no}}
                                                                    </a>
                                                                </td>
                                                                <td>{{$bill->po_no}}</td>
                                                                <td>{{get_formatted_date_from_timestamp($bill->bill_date)}}</td>
                                                                <td>{{get_formatted_date_from_timestamp($bill->due_date)}}</td>
                                                                <td>{{get_config('currency')}} {{number_format($bill->grand_total, 2, '.', ',')}}</td>
                                                                <td>
                                                                    @php
                                                                        if ($bill->status == 0) {
                                                                            $status = 'unpaid';
                                                                            $label = 'danger';
                                                                        } else if ($bill->status == 1) {
                                                                            $status = 'partially_paid';
                                                                            $label = 'warning';
                                                                        } else {
                                                                            $status = 'paid';
                                                                            $label = 'success';
                                                                        } 
                                                                    @endphp
                                                                    <span class="m-badge m-badge--{{$label}}"data-container="body" data-toggle="m-tooltip" data-placement="top" title="" 
                                                                        data-original-title="{{__('web.'.$status)}}"></span>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    var vendorStatusChangeRoute = '{{route('vendors.change_status')}}';
    $('input[type=checkbox]').change(function() {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
        var postParams = {
            '_token': '{{ csrf_token() }}',
            'id': '{{$vendor->id}}',
            'status': $('#status').val()
        };
        $.post(vendorStatusChangeRoute, postParams, function(response) {
            notify('Vendor status was changed successfully', 'success');
        }).fail(function(response) {
            console.log(response);
        });
    });
</script>
@endsection
@endif