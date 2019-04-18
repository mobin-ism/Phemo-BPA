@if (is_permitted('vendor_create'))
<form method="post" id="modal-form" action="{{ route('vendors.store') }}">
    @csrf
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row mb-4">
        <div class="col-lg-6">
            <h4 class="text-muted">
                {{__('web.basic_information')}}
            </h4>
            <hr>
            <div class="form-group m-form__group" id="name-group">
                <label for="company-name">
                    * {{__('web.company_name')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="company-name" name="name"
                    value="{{old('name')}}">
                <div class="form-control-feedback text-danger"></div>
            </div>
            <div class="form-group m-form__group" id="company_phone-group">
                <label for="company-phone">
                    * {{__('web.company_phone')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="company-phone"
                       name="company_phone" value="{{old('company_phone')}}">
            </div>
            <div class="form-group m-form__group" id="contact_person-group">
                <label for="contact-person">
                    * {{__('web.contact_person')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="contact-person"
                    name="contact_person" value="{{ old('contact_person') }}">
            </div>
            <div class="form-group m-form__group" id="contact_email-group">
                <label for="contact-email">
                    * {{__('web.contact_email')}}
                </label>
                <input type="email" class="form-control m-input m-input--pill" id="contact-email"
                       name="contact_email" value="{{old('contact_email')}}">
            </div>
            <div class="form-group m-form__group">
                <label for="work-number">
                    {{__('web.work_number')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="work-number"
                       name="work_number">
            </div>
            <div class="form-group m-form__group" id="cell_phone-group">
                <label for="cell-phone">
                    {{__('web.cell_phone')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="cell-phone"
                       name="cell_phone">
            </div>
            <div class="form-group m-form__group">
                <label for="tax-number">
                    {{__('web.tax_number')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="tax-number"
                       name="tax_number">
            </div>
            <div class="form-group m-form__group">
                <label for="swift-code">
                    {{__('web.swift_code')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="swift-code"
                       name="swift_code">
            </div>
            <div class="form-group m-form__group">
                <label for="iban">
                    {{__('web.iban')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="iban"
                       name="iban">
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
                        name="address_line_1">
            </div>
            <div class="form-group m-form__group">
                <label for="address-line-2">
                    {{__('web.address_line_2')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="address-line-2"
                        name="address_line_2">
            </div>
            <div class="form-group m-form__group" id="city-group">
                <label for="city">
                    * {{__('web.city')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="city"
                       name="city">
            </div>
            <div class="form-group m-form__group">
                <label for="zip-code">
                    {{__('web.zip_code')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="zip-code"
                       name="zip_code">
            </div>
            <div class="form-group m-form__group">
                <label for="state">
                    {{__('web.state')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="state"
                       name="state">
            </div>
            <div class="form-group m-form__group" id="country_id-group">
                <label for="country">
                    * {{__('web.country')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="country_id">
                    @php
                        $countries = \App\Country::all();
                    @endphp
                    @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-form__group">
                <label for="skype-id">
                    {{__('web.skype_id')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="skype-id"
                       name="skype_id">
            </div>
            <div class="form-group m-form__group">
                <label for="website">
                    {{__('web.website')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="website"
                       name="website">
            </div>
        </div>
    </div>
</form>

<script>
    $('.modal-footer').show();
    $('.m_selectpicker').selectpicker();
</script>
@endif