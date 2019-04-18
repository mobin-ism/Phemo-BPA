@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.system_preferences')}}</h3>
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
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                @include('backend.partials.settings')
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.system_preferences')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <form action="{{route('configs.system_preferences')}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            {{ Form::hidden('account_id', Auth::user()->account_id) }}
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group m-form__group" id="">
                                        <label for="company-name">
                                            {{__('web.company_name')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="company-name" name="company_name"
                                            value="{{ $config->company_name }}">
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="address-line-1">
                                            {{__('web.address_line_1')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="address-line-1" name="address_line_1"
                                            value="{{ $config->address_line_1 }}">
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="address-line-2">
                                            {{__('web.address_line_2')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="address-line-2" name="address_line_2"
                                            value="{{ $config->address_line_2 }}">
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="city">
                                            {{__('web.city')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="city" name="city"
                                            value="{{ $config->city }}">
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="zip-code">
                                            {{__('web.zip_code')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="zip-code" name="zip_code"
                                            value="{{ $config->zip_code }}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="country">
                                            {{__('web.country')}}
                                        </label>
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="country_id"
                                            id="country" data-live-search="true" title="{{__('web.select_one')}}">
                                            @foreach(\App\Country::all() as $country)
                                            <option value="{{$country->id}}" <?php if ($country->id == $config->country_id) echo 'selected'; ?>>
                                                {{$country->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="mobile">
                                            {{__('web.mobile')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="mobile" name="mobile"
                                            value="{{ $config->mobile }}">
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="landline">
                                            {{__('web.landline')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="landline" name="landline"
                                            value="{{ $config->landline }}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="currency">
                                            {{__('web.currency')}}
                                        </label>
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="currency"
                                            id="currency" data-live-search="true">
                                            @foreach(\App\Currency::all() as $currency)
                                            <option value="{{$currency->code}}" <?php if ($currency->code == $config->currency) echo 'selected'; ?>>
                                                {{$currency->currency}} ({{$currency->code}}) - {{$currency->country}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="date-format">
                                            {{__('web.date_format')}}
                                        </label>
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="date_format"
                                            id="date-format">
                                            <option value="d/m/Y" <?php if ($config->date_format == 'd/m/Y') echo 'selected'; ?>>d/m/Y</option>
                                            <option value="m/d/Y" <?php if ($config->date_format == 'm/d/Y') echo 'selected'; ?>>m/d/Y</option>
                                            <option value="d-m-Y" <?php if ($config->date_format == 'd-m-Y') echo 'selected'; ?>>d-m-Y</option>
                                            <option value="m-d-Y" <?php if ($config->date_format == 'm-d-Y') echo 'selected'; ?>>m-d-Y</option>
                                        </select>
                                    </div>
                                    {{-- <div class="form-group m-form__group" id="">
                                        <label for="voucher-prefix">
                                            {{__('web.voucher_prefix')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="voucher-prefix" name="voucher_prefix"
                                            value="{{ $config->voucher_prefix }}">
                                    </div> --}}
                                    <div class="form-group m-form__group">
                                        <label for="logo">
                                            {{__('web.logo')}}
                                        </label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="logo" name="logo"
                                                accept="image/*" onchange="previewFile()">
                                            <label class="custom-file-label" for="logo">
                                                {{__('web.choose_logo')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <img src="{{url('public/storage/'.$config->logo)}}" width="180" id="logo-image">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group m-form__group" id="">
                                        <label for="employee-prefix">
                                            {{__('web.employee_prefix')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="employee-prefix" name="employee_prefix"
                                            value="{{ $config->employee_prefix }}">
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="invoice-prefix">
                                            {{__('web.invoice_prefix')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="invoice-prefix" name="invoice_prefix"
                                            value="{{ $config->invoice_prefix }}">
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="quotation-prefix">
                                            {{__('web.quotation_prefix')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="quotation-prefix" name="quotation_prefix"
                                            value="{{ $config->quotation_prefix }}">
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="tax-no">
                                            {{__('web.tax_no')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="tax-no" name="tax_no"
                                            value="{{ $config->tax_no }}">
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="website">
                                            {{__('web.website')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="website" name="website"
                                            value="{{ $config->website }}">
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="tc-invoice">
                                            {{__('web.terms_and_conditions')}} ({{__('web.invoice')}})
                                        </label>
                                        <textarea class="form-control m-input m-input--pill" id="tc-invoice" name="tc_invoice" rows="5">{{$config->tc_invoice}}</textarea>
                                    </div>
                                    <div class="form-group m-form__group" id="">
                                        <label for="tc-quotation">
                                            {{__('web.terms_and_conditions')}} ({{__('web.quotation')}})
                                        </label>
                                        <textarea class="form-control m-input m-input--pill" id="tc-quotation" name="tc_quotation" rows="5">{{$config->tc_quote}}</textarea>
                                    </div>
                                    {{-- <div class="form-group m-form__group" id="">
                                        <label for="tc-po">
                                            {{__('web.terms_and_conditions')}} ({{__('web.purchase_order')}})
                                        </label>
                                        <textarea class="form-control m-input m-input--pill" id="tc-po" name="tc_po" rows="5">{{$config->tc_po}}</textarea>
                                    </div> --}}
                                    {{-- <div class="form-group m-form__group" id="">
                                        <label for="tc-bill">
                                            {{__('web.terms_and_conditions')}} ({{__('web.bill')}})
                                        </label>
                                        <textarea class="form-control m-input m-input--pill" id="tc-bill" name="tc_bill" rows="5">{{$config->tc_bill}}</textarea>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                        <span>
                                            <i class="la la-save"></i>
                                            <span>{{__('web.save')}}</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function previewFile() {
            var preview = document.querySelector('#logo-image');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
@endsection