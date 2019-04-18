@if (is_permitted('customer_edit'))
<form method="post" id="modal-form" action="{{ route('customers.update', $customer) }}">
    @csrf
    {{method_field('PATCH')}}
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row mb-4">
        <div class="col-lg-6">
            <h4 class="text-muted">
                {{__('web.basic_information')}}
            </h4>
            <hr>
            <div class="form-group m-form__group">
                <label for="customer-type">
                    {{__('web.customer_type')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="customer_type"
                    id="customer-type">
                    <option value="company" <?php if ($customer->customer_type == 'company') echo 'selected'; ?>>{{__('web.company')}}</option>
                    <option value="individual" <?php if ($customer->customer_type == 'individual') echo 'selected'; ?>>{{__('web.individual')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group">
                <label for="category">
                    {{__('web.category')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="customer_category_id"
                    id="category" title="{{__('web.select_one')}}">
                    @foreach(\App\CustomerCategory::where('account_id', Auth::user()->account_id)->get() as $category)
                    <option value="{{$category->id}}" <?php if($customer->customer_category_id == $category->id) echo 'selected'; ?>>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-form__group">
                <label for="customer-no">
                    {{__('web.customer_no')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="customer-no"
                        name="customer_no" value="{{$customer->customer_no}}">
            </div>
            <div id="company-selector">
                <div class="form-group m-form__group" id="company_name-group">
                    <label for="company-name">
                        * {{__('web.company_name')}}
                    </label>
                    <input type="text" class="form-control m-input m-input--pill" id="company-name" name="company_name"
                        value="{{$customer->company_name}}">
                </div>
                <div class="form-group m-form__group" id="primary_contact-group">
                    <label for="primary-contact">
                        * {{__('web.primary_contact')}}
                    </label>
                    <input type="text" class="form-control m-input m-input--pill" id="primary-contact" name="primary_contact"
                        value="{{$customer->primary_contact}}">
                </div>
            </div>
            <div id="individual-selector">
                <div class="form-group m-form__group" id="customer_name-group">
                    <label for="customer-name">
                        * {{__('web.customer_name')}}
                    </label>
                    <input type="text" class="form-control m-input m-input--pill" id="customer-name" name="customer_name"
                        value="{{$customer->customer_name}}">
                </div>
                <div class="form-group m-form__group" id="surname-group">
                    <label for="surname">
                        * {{__('web.surname')}}
                    </label>
                    <input type="text" class="form-control m-input m-input--pill" id="surname" name="surname"
                        value="{{$customer->surname}}">
                </div>
            </div>
            <div class="form-group m-form__group" id="email-group">
                <label for="email">
                    * {{__('web.email')}}
                </label>
                <input type="email" class="form-control m-input m-input--pill" id="email"
                        name="email" value="{{$customer->email}}">
            </div>
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
            <div class="form-group m-form__group" id="vat">
                <label for="vat-no">
                    {{__('web.vat_no')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="vat-no"
                        name="vat_no" value="{{$customer->vat_no}}">
            </div>
            <div class="form-group m-form__group" id="id-number">
                <label for="id-no">
                    {{__('web.id_no')}} / {{__('web.passport_no')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="id-no"
                        name="id_number" value="{{$customer->id_number}}">
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
                        name="address_line_1" value="{{$customer->address_line_1}}">
            </div>
            <div class="form-group m-form__group">
                <label for="address-line-2">
                    {{__('web.address_line_2')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="address-line-2"
                        name="address_line_2" value="{{$customer->address_line_2}}">
            </div>
            <div class="form-group m-form__group" id="city-group">
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
                    <option value="{{$country->id}}" <?php if ($country->id == $customer->country_id) echo 'selected'; ?>>{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-form__group" id="web">
                <label for="website">
                    {{__('web.website')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="website"
                        name="website" value="{{$customer->website}}">
            </div>
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
    <div class="row">
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
</form>

<script>
    $(document).ready(function() {
        $('.m_selectpicker').selectpicker();
        handleCustomerTypeSelector($('#customer-type').val());
        $('#customer-type').on('change', function() {
            var value = $(this).val();
            handleCustomerTypeSelector(value);
        });
    });
    function handleCustomerTypeSelector(value) {
        if (value === 'company') {
            $('#individual-selector').hide();
            $('#company-selector').fadeIn();
            $('#id-number').hide();
        } else {
            $('#company-selector').hide();
            $('#individual-selector').fadeIn();
            $('#id-number').fadeIn();
            $('#web').hide();
            $('#vat').hide();
        }
    }
</script>
@endif