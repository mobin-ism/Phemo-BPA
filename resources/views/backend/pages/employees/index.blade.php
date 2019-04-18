@extends('backend.layouts.master')
@section('content')

    @php
        $format = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format;
    @endphp

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.employees')}}</h3>
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
        <div class="row mb-5">
            <div class="col">
                <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air pull-right"
                    onclick="presentModal('{{route('employees.create')}}', '{{__('web.new_employee')}}')">
                    <span>
                        <i class="la la-plus"></i>
                        <span>{{__('web.new_employee')}}</span>
                    </span>
                </a>
                {{-- <a href="{{route('employees.import_excel')}}" 
                    class="btn btn-primary m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air pull-right mr-2">
                    <span>
                        <i class="la la-arrow-down"></i>
                        <span>{{__('web.import')}}</span>
                    </span>
                </a> --}}
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <button type="button" class="btn m-btn--pill m-btn--air btn-outline-primary mb-3 department-search active" id="0">
                    {{__('web.all_departments')}}
                </button>
                @foreach (\App\Department::where('account_id', Auth::user()->account_id)->get() as $dept)
                <button type="button" class="btn m-btn--pill m-btn--air btn-outline-primary mb-3 department-search" id="{{$dept->id}}">
                    {{$dept->name}}
                </button>
                @endforeach
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group m-form__group">
                    <div class="input-group m-input-group m-input-group--pill">
                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="la la-search"></i></span></div>
                        <input type="text" class="form-control m-input" placeholder="{{__('web.employee_name')}}" aria-describedby="basic-addon1"
                            id="search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="employee-search-button">
                                {{__('web.search')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="employee-list">
            @include('backend.pages.employees.list')
        </div>

    </div>

@endsection

@section('script')
    <script>
        var employeeFilterDepartmentRoute = '{{route('employees.search_department')}}';
        var employeeSearchNameRoute = '{{route('employees.search')}}';
        $(document).ready(function() {
            $('.department-search').on('click', function(e) {
                $('#search').val('');
                var allButtons = document.querySelectorAll('.department-search');
                allButtons.forEach(function() {
                    var button = $('.department-search');
                    if (button.hasClass('active')) {
                        button.removeClass('active');
                    }
                });
                var id = e.target.id;
                $('#' + id).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'department_id': id
                };
                $.post(employeeFilterDepartmentRoute, filterParams, function(response) {
                    $('#employee-list').html(response);
                    $('#' + id).removeClass('m-loader m-loader--right').removeAttr('disabled');
                    $('#' + id).addClass('active');
                }).fail(function(response) {
                    console.log(response);
                    $('#' + id).removeClass('m-loader m-loader--right').removeAttr('disabled');
                });
                // $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                // var filterParams = {
                //     '_token': '{{ csrf_token() }}',
                //     'account_id': '{{Auth::user()->account_id}}',
                //     'needle': $('#needle').val(),
                //     'department_id': $('#department_id').val()
                // };
                // $.post(employeeFilterDepartmentRoute, filterParams, function(response) {
                //     $('#employee-list').html(response);
                //     $('#employee-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                // }).fail(function(response) {
                //     console.log(response);
                //     $('#employee-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                // });
            });
        });
        $('#employee-search-button').on('click', function() {
            var needle = $('#search').val();
            if (needle.length > 0) {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'needle': needle,
                };
                $.post(employeeSearchNameRoute, filterParams, function(response) {
                    $('#employee-list').html(response);
                    $('#employee-search-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#employee-search-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                });
            }
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