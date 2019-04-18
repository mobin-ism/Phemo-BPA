@extends('backend.layouts.master')
@section('content')
@php
    $total_invoiced_amount = \App\Invoice::where('customer_id', $customer->id)->sum('grand_total');
    $customer_invoices = \App\Invoice::where('customer_id', $customer->id)->get();
    $paid = 0.0;
    foreach ($customer_invoices as $invoice) {
        $payment = \App\Payment::where('invoice_id', $invoice->id)->sum('amount');
        $paid += $payment;
    }
    $unpaid = $total_invoiced_amount - $paid;
@endphp
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.customer_profile')}}</h3>
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
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="m-portlet m-portlet--full-height  ">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <img src="{{profile_photo('customer', $customer->id)}}" />
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#" class="m-link" data-container="body" data-toggle="m-tooltip" data-placement="top"
                                    data-original-title="{{__('web.change_profile_picture')}}"
                                        onclick="presentModal('{{route('customer.edit_photo')}}', '{{__('web.change_profile_picture')}}')">
                                    <i class="la la-edit"></i>
                                </a>
                            </div>
                            @php
                                $name = $customer->customer_type == 'company' ? $customer->primary_contact : $customer->customer_name;    
                            @endphp
                            <div class="m-card-profile__details">
                                <span class="m-card-profile__name">{{$name}}</span>
                                @if ($customer->customer_type == 'company')
                                    <span class="m-card-profile__email">
                                        {{$customer->company_name}}
                                    </span>
                                @endif
                                <div class="row mt-4">
                                    <div class="col">
                                        <a href="{{$customer->facebook}}" class="m-link">
                                            <i class="socicon-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{$customer->twitter}}" class="m-link">
                                            <i class="socicon-twitter"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{$customer->linkedin}}" class="m-link">
                                            <i class="socicon-linkedin"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{$customer->skype}}" class="m-link">
                                            <i class="socicon-skype"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body-separator"></div>
                        <div class="m-widget1 m-widget1--paddingless">
                            <div id="customer_invoice_payment_profile_morris" style="height:200px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs">
                    <div class="m-portlet__body">
                        <form method="post" action="{{ route('customer.update_profile') }}">
                            @csrf
                            {{-- {{method_field('PATCH')}} --}}
                            {{ Form::hidden('account_id',  Auth::user()->account_id) }}
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <h4 class="text-muted">
                                        {{__('web.basic_information')}}
                                    </h4>
                                    <hr>
                                    <input type="hidden" name="customer_type" value="{{$customer->customer_type}}">
                                    @if ($customer->customer_type == 'company')
                                    <div id="company-selector">
                                        <div class="form-group m-form__group @if($errors->has('company_name')) has-danger @endif" id="">
                                            <label for="company-name">
                                                * {{__('web.company_name')}}
                                            </label>
                                            <input type="text" class="form-control m-input m-input--pill" id="company-name" name="company_name"
                                                value="{{$customer->company_name}}">
                                        </div>
                                        <div class="form-group m-form__group @if($errors->has('primary_contact')) has-danger @endif" id="">
                                            <label for="primary-contact">
                                                * {{__('web.primary_contact')}}
                                            </label>
                                            <input type="text" class="form-control m-input m-input--pill" id="primary-contact" name="primary_contact"
                                                value="{{$customer->primary_contact}}">
                                        </div>
                                    </div>
                                    @endif
                                    @if ($customer->customer_type == 'individual')
                                    <div id="individual-selector">
                                        <div class="form-group m-form__group @if($errors->has('customer_name')) has-danger @endif" id="">
                                            <label for="customer-name">
                                                * {{__('web.customer_name')}}
                                            </label>
                                            <input type="text" class="form-control m-input m-input--pill" id="customer-name" name="customer_name"
                                                value="{{$customer->customer_name}}">
                                        </div>
                                        <div class="form-group m-form__group @if($errors->has('surname')) has-danger @endif" id="">
                                            <label for="surname">
                                                * {{__('web.surname')}}
                                            </label>
                                            <input type="text" class="form-control m-input m-input--pill" id="surname" name="surname"
                                                value="{{$customer->surname}}">
                                        </div>
                                    </div>
                                    @endif
                                    <input type="hidden" name="email" value="{{$customer->email}}">
                                    <div class="form-group m-form__group">
                                        <label for="telephone">
                                            {{__('web.telephone')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="telephone"
                                                name="telephone" value="{{$customer->telephone}}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="fax">
                                            {{__('web.fax')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="fax"
                                                name="fax" value="{{$customer->fax}}">
                                    </div>
                                    @if ($customer->customer_type == 'company')
                                    <div class="form-group m-form__group" id="vat">
                                        <label for="vat-no">
                                            {{__('web.vat_no')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="vat-no"
                                                name="vat_no" value="{{$customer->vat_no}}">
                                    </div>
                                    @endif
                                    @if ($customer->customer_type == 'individual')
                                    <div class="form-group m-form__group" id="id-number">
                                        <label for="id-no">
                                            {{__('web.id_no')}} / {{__('web.passport_no')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="id-no"
                                                name="id_number" value="{{$customer->id_number}}">
                                    </div>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="text-muted">
                                        {{__('web.address')}}
                                    </h4>
                                    <hr>
                                    <div class="form-group m-form__group">
                                        <label for="address-line-1">
                                            {{__('web.address_line_1')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="address-line-1"
                                                name="address_line_1" value="{{$customer->address_line_1}}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="address-line-2">
                                            {{__('web.address_line_2')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="address-line-2"
                                                name="address_line_2" value="{{$customer->address_line_2}}">
                                    </div>
                                    <div class="form-group m-form__group @if($errors->has('city')) has-danger @endif" id="">
                                        <label for="city">
                                            * {{__('web.city')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="city"
                                                name="city" value="{{$customer->city}}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="zip-code">
                                            {{__('web.zip_code')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="zip-code"
                                                name="zip_code" value="{{$customer->zip_code}}">
                                    </div>
                                    <div class="form-group m-form__group @if($errors->has('country_id')) has-danger @endif" id="">
                                        <label for="country">
                                            * {{__('web.country')}}
                                        </label>
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                                            data-live-search="true" title="{{__('web.select_one')}}" name="country_id">
                                            @php
                                                $countries = \App\Country::all();
                                            @endphp
                                            @foreach ($countries as $country)
                                            <option value="{{$country->id}}" <?php if ($country->id == $customer->country_id) echo 'selected'; ?>>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($customer->customer_type == 'company')
                                    <div class="form-group m-form__group" id="web">
                                        <label for="website">
                                            {{__('web.website')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="website"
                                                name="website" value="{{$customer->website}}">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <h4 class="text-muted">
                                        {{__('web.social')}}
                                    </h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="facebook">
                                            {{__('web.facebook')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="facebook"
                                                name="facebook" value="{{$customer->facebook}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="twitter">
                                            {{__('web.twitter')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="twitter"
                                            name="twitter" value="{{$customer->twitter}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="linkedin">
                                            {{__('web.linkedin')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="linkedin"
                                                name="linkedin" value="{{$customer->linkedin}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="skype">
                                            {{__('web.skype')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="skype"
                                                name="skype" value="{{$customer->skype}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
        var MorrisChartsCustomerProfileInvoicePayments = {
            init: function() {
                new Morris.Donut({
                    element: "customer_invoice_payment_profile_morris",
                    data: [{
                        label: "{{__('web.invoiced')}}",
                        value: "{{$total_invoiced_amount}}"
                    }, {
                        label: "{{__('web.paid')}}",
                        value: "{{$paid}}"
                    }, {
                        label: "{{__('web.due')}}",
                        value: "{{$unpaid}}"
                    }]
                })
            }
        };
        $(document).ready(function() {
            MorrisChartsCustomerProfileInvoicePayments.init();
        });
    </script>
@endsection