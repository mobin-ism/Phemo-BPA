@extends('backend.layouts.master')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.statements')}}</h3>
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
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{__('web.statements')}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover" id="m_table_1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('web.code')}}</th>
                    <th>{{__('web.date')}}</th>
                    <th>{{__('web.type')}}</th>
                    <th>{{__('web.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($statements as  $key => $statement)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <a href="#" class="m-link"
                                onclick="presentModal('{{route('customer.show_statement', $statement->id)}}', '{{__('web.statement_details')}}')">
                                <span>{{$statement->code}}</span>
                            </a>
                        </td>
                        <td>{{get_formatted_date_from_timestamp($statement->start)}} - {{get_formatted_date_from_timestamp($statement->end)}}</td>
                        <td>{{ __('web.'.$statement->status) }} {{__('web.invoices')}}</td>
                        <td nowrap>
                            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push" 
                                m-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link m-dropdown__toggle btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="m-dropdown__wrapper" style="z-index: 101;">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust" style="right: auto; left: 29.5px;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">
                                                            {{ __('web.quick_actions') }}
                                                        </span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link"
                                                            onclick="presentModal('{{route('customer.show_statement', $statement->id)}}', '{{__('web.statement_details')}}')">
                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                            <span class="m-nav__link-text">
                                                                {{ __('web.details') }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection