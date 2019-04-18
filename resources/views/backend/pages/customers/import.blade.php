@if (is_permitted('customer_create'))
@extends('backend.layouts.master')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.import_customers')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('customers.company_list')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.company')}}</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('customers.individual_list')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.individual')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="m-content">
    <div class="row">
        <div class="col">
            <div class="alert m-alert--primary" role="alert">
                <h5>Instructions</h5>
                <p style="margin-bottom: 30px;">
                    For bulk import of customers, you need to download the sample excel file where the information to be filled are predefined. Once you download the
                    excel file, please fill in the informations and do not change the header names and the name of the file. Then upload the excel file in the form below
                    and all the customers you have entered in the excel file will be imported to your product list. You will be needind to add <strong>Country ID</strong>
                    in the excel file which you can get from the list below. The headers in red are required fields.
                </p>
                <p>
                    <a href="{{route('customers.download_sample_excel', $type)}}" class="btn btn-accent btn-sm m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-download"></i>
                            <span>{{__('web.download_sample_excel')}} ({{__('web.'.$type)}})</span>
                        </span>
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{__('web.upload_excel')}}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <form action="{{route('customers.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ Form::hidden('type', $type) }}
                        <div class="form-group m-form__group">
                            <label>{{__('web.file')}}</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="attachment" accept=".xlsx" name="attachment">
                                <label class="custom-file-label" for="attachment">{{__('web.choose')}}</label>
                            </div>
                        </div>
                        <div class="form-group m-form__group mt-5">
                            <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                <span>
                                    <i class="la la-save"></i>
                                    <span>{{__('web.import_customers')}}</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{__('web.countries')}}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="m_table_1">
                            <thead>
                                <tr>
                                    <th>{{__('web.id')}}</th>
                                    <th>{{__('web.country')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Country::all() as $country)
                                    <tr>
                                        <td>{{$country->id}}</td>
                                        <td>{{$country->name}}</td>
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

@endsection
@endif