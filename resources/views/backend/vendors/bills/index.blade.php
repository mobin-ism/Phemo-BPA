@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.bills')}}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head" style="border: none;">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text" onclick="toggleSection('bills-filter')" style="cursor: pointer;">
                            <span class="bills-filter"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.filter_options')}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body bills-filter m--hide">
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.vendor')}}
                            </label>
                            @php
                                $vendor_id = \App\Vendor::where('user_id', Auth::user()->id)->first()->id;
                                $vendor = \App\Vendor::where('id', $vendor_id)->first();
                            @endphp
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="vendor_id" id="vendor_id">
                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.status')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="status" id="status">
                                <option value="">{{__('web.all')}}</option>
                                <option value="0">{{__('web.unpaid')}}</option>
                                <option value="1">{{__('web.partially_paid')}}</option>
                                <option value="2">{{__('web.paid')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.bill_date')}}
                            </label>
                            <div class="input-group pull-right" id="bill_date_range">
                                <input type="text" class="form-control m-input m-input--pill" name="bill_date" id="bill_date"
                                readonly placeholder="{{__('web.select_bill_date_range')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.due_date')}}
                            </label>
                            <div class="input-group pull-right" id="due_date_range">
                                <input type="text" class="form-control m-input m-input--pill" name="due_date" id="due_date"
                                readonly placeholder="{{__('web.select_due_date_range')}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-4">
                        <button type="button" class="btn btn-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                            id="bill-filter-button">
                            <span>
                                <i class="la la-filter"></i>
                                <span>{{__('web.apply_filter')}}</span>
                            </span>
                        </button>
                        <button type="button" class="btn btn-primary m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                            id="reset-button" onclick="location.reload();">
                            <span>
                                <i class="la la-undo"></i>
                                <span>{{__('web.reset')}}</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile" id="bills-list">
            @include('backend.vendors.bills.list')
        </div>
    </div>

@endsection

@section('script')
    <script>
        var route = '{{route('vendor.filter_bill')}}';
        $(document).ready(function() {
            var a = moment().subtract(29, "days"),
                t = moment();
            $("#bill_date_range").daterangepicker({
                buttonClasses: "m-btn btn",
                applyClass: "btn-primary",
                cancelClass: "btn-secondary",
                startDate: a,
                endDate: t,
                ranges: {
                    "{{__('web.today')}}": [moment(), moment()],
                    "{{__('web.yesterday')}}": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "{{__('web.last_7_days')}}": [moment().subtract(6, "days"), moment()],
                    "{{__('web.last_30_days')}}": [moment().subtract(29, "days"), moment()],
                    "{{__('web.this_month')}}": [moment().startOf("month"), moment().endOf("month")],
                    "{{__('web.last_month')}}": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, function(a, t, n) {
                $("#bill_date_range .form-control").val(a.format("DD/MM/YYYY") + " - " + t.format("DD/MM/YYYY"))
            });
            $("#due_date_range").daterangepicker({
                buttonClasses: "m-btn btn",
                applyClass: "btn-primary",
                cancelClass: "btn-secondary",
                startDate: a,
                endDate: t,
                ranges: {
                    "{{__('web.today')}}": [moment(), moment()],
                    "{{__('web.yesterday')}}": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "{{__('web.last_7_days')}}": [moment().subtract(6, "days"), moment()],
                    "{{__('web.last_30_days')}}": [moment().subtract(29, "days"), moment()],
                    "{{__('web.this_month')}}": [moment().startOf("month"), moment().endOf("month")],
                    "{{__('web.last_month')}}": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, function(a, t, n) {
                $("#due_date_range .form-control").val(a.format("DD/MM/YYYY") + " - " + t.format("DD/MM/YYYY"))
            });
            $('#bill_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#bill_date').val('');
            });
            $('#due_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#due_date').val('');
            });
            $('#bill-filter-button').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'account_id': '{{Auth::user()->account_id}}',
                    'vendor_id': $('#vendor_id').val(),
                    'bill_date': $('#bill_date').val(),
                    'due_date': $('#due_date').val(),
                    'status': $('#status').val()
                };
                $.post(route, filterParams, function(response) {
                    $('#bills-list').html(response);
                    $('#bill-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#bill-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                });
            });
        });
        function toggleSection(section) {
            if ($('div.' + section).hasClass('m--hide')) {
                $('div.' + section).removeClass('m--hide');
                $('span.'+ section).html('<i class="la la-minus"></i>');
            } else {
                $('div.' + section).addClass('m--hide');
                $('span.'+ section).html('<i class="la la-plus"></i>');
            }            
        }
    </script>
@endsection