@if (is_permitted('employee_create'))
@extends('backend.layouts.master')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.import_products')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('products.index')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.products')}}</span>
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
                    For bulk import of products, you need to download the sample excel file where the information to be filled are predefined. Once you download the
                    excel file, please fill in the informations and do not change the header names and the name of the file. Then upload the excel file in the form below
                    and all the products you have entered in the excel file will be imported to your product list. You will be needind to add <strong>Unit of measure ID</strong>
                    in the excel file which you can get from the list below. The headers in red are required fields.
                </p>
                <p>
                    <a href="{{route('products.download_sample_excel')}}" class="btn btn-accent btn-sm m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-download"></i>
                            <span>{{__('web.download_sample_excel')}}</span>
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
                    <form action="{{route('products.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
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
                                    <span>{{__('web.import_products')}}</span>
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
                                {{__('web.uom')}}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{__('web.id')}}</th>
                                    <th>{{__('web.uom')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\UnitOfMeasure::where('account_id', Auth::user()->account_id)->get() as $uom)
                                    <tr>
                                        <td>{{$uom->id}}</td>
                                        <td>{{$uom->name}}</td>
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