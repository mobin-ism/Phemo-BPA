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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__body">
                        <form method="post" action="{{ route('vendor.update_profile') }}">
                            @csrf
                            {{ Form::hidden('account_id',  Auth::user()->account_id) }}
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <h4 class="text-muted">
                                        {{__('web.basic_information')}}
                                    </h4>
                                    <hr>
                                    <div class="form-group m-form__group @if($errors->has('name')) has-danger @endif" id="">
                                        <label for="company-name">
                                            * {{__('web.company_name')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="company-name" name="name"
                                            value="{{$vendor->name}}">
                                    </div>
                                    <div class="form-group m-form__group @if($errors->has('company_phone')) has-danger @endif" id="">
                                        <label for="company-phone">
                                            * {{__('web.company_phone')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="company-phone"
                                                name="company_phone" value="{{$vendor->company_phone}}">
                                    </div>
                                    <div class="form-group m-form__group @if($errors->has('contact_person')) has-danger @endif" id="">
                                        <label for="contact-person">
                                            * {{__('web.contact_person')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="contact-person"
                                            name="contact_person" value="{{$vendor->contact_person}}">
                                    </div>
                                    <input type="hidden" name="contact_email" value="{{$vendor->contact_email}}">
                                    <div class="form-group m-form__group">
                                        <label for="work-number">
                                            {{__('web.work_number')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="work-number"
                                                name="work_number" value="{{$vendor->work_number}}">
                                    </div>
                                    <div class="form-group m-form__group" id="cell_phone-group">
                                        <label for="cell-phone">
                                            {{__('web.cell_phone')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="company-email"
                                                name="cell_phone" value="{{$vendor->cell_phone}}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="tax-number">
                                            {{__('web.tax_number')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="tax-number"
                                                name="tax_number" value="{{$vendor->tax_number}}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="swift-code">
                                            {{__('web.swift_code')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="swift-code"
                                                name="swift_code" value="{{$vendor->swift_code}}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="iban">
                                            {{__('web.iban')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="iban"
                                                name="iban" value="{{$vendor->iban}}">
                                    </div>
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
                                            name="address_line_1" value="{{$vendor->address_line_1}}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="address-line-2">
                                            {{__('web.address_line_2')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="address-line-2"
                                                name="address_line_2" value="{{$vendor->address_line_2}}">
                                    </div>
                                    <div class="form-group m-form__group @if($errors->has('city')) has-danger @endif" id="">
                                        <label for="city">
                                            * {{__('web.city')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="city"
                                                name="city" value="{{$vendor->city}}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="zip-code">
                                            {{__('web.zip_code')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="zip-code"
                                                name="zip_code" value="{{$vendor->zip_code}}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="state">
                                            {{__('web.state')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="state"
                                                name="state" value="{{$vendor->state}}">
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
                                            <option value="{{$country->id}}" <?php if ($country->id == $vendor->country_id) echo 'selected'; ?>>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="skype-id">
                                            {{__('web.skype_id')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="skype-id"
                                                name="skype_id" value="{{$vendor->skype_id}}">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="website">
                                            {{__('web.website')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill" id="website"
                                                name="website" value="{{$vendor->website}}">
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