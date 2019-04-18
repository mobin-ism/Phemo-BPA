@if(is_permitted('ticket_view'))
@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.tickets')}}</h3>
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
        @if(is_permitted('ticket_create'))
        <div class="row mb-3">
            <div class="col">
                <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air pull-right"
                    onclick="presentModal('{{route('tickets.create')}}', '{{__('web.new_ticket')}}')">
                    <span>
                        <i class="la la-plus"></i>
                        <span>{{__('web.new_ticket')}}</span>
                    </span>
                </a>
            </div>
        </div>
        @endif
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
                                    {{ \App\Ticket::where(['account_id' => Auth::user()->account_id, 'resolve_status' => 'pending'])->count() }}
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
                                    {{ \App\Ticket::where(['account_id' => Auth::user()->account_id, 'resolve_status' => 'pending', 'priority' => 'high'])->count() }}
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
                                    {{ \App\Ticket::where(['account_id' => Auth::user()->account_id, 'resolve_status' => 'resolved'])->count() }}
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
                                    {{ \App\Ticket::where(['account_id' => Auth::user()->account_id, 'resolve_status' => 'resolved'])->whereMonth('created_at', date('m'))->count() }}
                                </h3>
                                <div class="m--space-30"></div>
                            </div>
                        </div>

                        <!--end::New Users-->
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head" style="border: none;">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text" onclick="toggleSection('tickets-filter')" style="cursor: pointer;">
                            <span class="tickets-filter"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.filter_options')}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body tickets-filter m--hide">
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.customer')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="customer_id" id="customer_id"
                                data-live-search="true">
                                <option value="">{{__('web.all')}}</option>
                                @foreach (\App\Customer::where('account_id', Auth::user()->account_id)->get() as $customer)
                                <option value="{{$customer->id}}">
                                    {{$customer->customer_type == 'company' ? $customer->company_name : $customer->customer_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.priority')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="priority" id="priority">
                                <option value="">{{__('web.all')}}</option>
                                <option value="normal">{{__('web.normal')}}</option>
                                <option value="medium">{{__('web.medium')}}</option>
                                <option value="high">{{__('web.high')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.status')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="resolve_status" id="resolve_status">
                                <option value="">{{__('web.all')}}</option>
                                <option value="pending">{{__('web.pending')}}</option>
                                <option value="resolved">{{__('web.resolved')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.assigned_employee')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="employee_id" id="employee_id"
                                data-live-search="true">
                                <option value="">{{__('web.all')}}</option>
                                @foreach (\App\Employee::where('account_id', Auth::user()->account_id)->get() as $employee)
                                <option value="{{$employee->id}}">
                                    {{$employee->user->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                            id="ticket-filter-button">
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
        <div class="m-portlet m-portlet--mobile" id="ticket-list">
            @include('backend.pages.tickets.list')
        </div>
    </div>

@endsection

@section('script')
    <script>
        var ticketFilterRoute = '{{route('tickets.filter')}}';
        $(document).ready(function() {
            $('#ticket-filter-button').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'account_id': '{{Auth::user()->account_id}}',
                    'customer_id': $('#customer_id').val(),
                    'employee_id': $('#employee_id').val(),
                    'priority': $('#priority').val(),
                    'resolve_status': $('#resolve_status').val()
                };
                $.post(ticketFilterRoute, filterParams, function(response) {
                    $('#ticket-list').html(response);
                    $('#ticket-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#ticket-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
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

@endif