@if (is_permitted('customer_create'))
<form method="post" id="modal-form" action="{{ route('customers.store') }}">
    @csrf
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
                    <option value="company">{{__('web.company')}}</option>
                    <option value="individual">{{__('web.individual')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group">
                <label for="category">
                    {{__('web.category')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="customer_category_id"
                    id="category" title="{{__('web.select_one')}}" onchange="handleDynamicAdd('customer_category_id')">
                    @foreach(\App\CustomerCategory::where('account_id', Auth::user()->account_id)->get() as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    <option value="-1" data-icon="la la-plus"> {{__('web.new_customer_category')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group">
                <label for="customer-no">
                    {{__('web.customer_no')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="customer-no"
                        name="customer_no">
            </div>
            <div id="company-selector">
                <div class="form-group m-form__group" id="company_name-group">
                    <label for="company-name">
                        * {{__('web.company_name')}}
                    </label>
                    <input type="text" class="form-control m-input m-input--pill" id="company-name" name="company_name"
                        value="{{old('company_name')}}">
                </div>
                <div class="form-group m-form__group" id="primary_contact-group">
                    <label for="primary-contact">
                        * {{__('web.primary_contact')}}
                    </label>
                    <input type="text" class="form-control m-input m-input--pill" id="primary-contact" name="primary_contact"
                        value="{{old('primary_contact')}}">
                </div>
            </div>
            <div id="individual-selector">
                <div class="form-group m-form__group" id="customer_name-group">
                    <label for="customer-name">
                        * {{__('web.customer_name')}}
                    </label>
                    <input type="text" class="form-control m-input m-input--pill" id="customer-name" name="customer_name"
                        value="{{old('customer_name')}}">
                </div>
                <div class="form-group m-form__group" id="surname-group">
                    <label for="surname">
                        * {{__('web.surname')}}
                    </label>
                    <input type="text" class="form-control m-input m-input--pill" id="surname" name="surname"
                        value="{{old('surname')}}">
                </div>
            </div>
            <div class="form-group m-form__group" id="email-group">
                <label for="email">
                    * {{__('web.email')}}
                </label>
                <input type="email" class="form-control m-input m-input--pill" id="email"
                        name="email" value="{{old('email')}}">
            </div>
            <div class="form-group m-form__group">
                <label for="telephone">
                    {{__('web.telephone')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="telephone"
                        name="telephone">
            </div>
            <div class="form-group m-form__group">
                <label for="fax">
                    {{__('web.fax')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="fax"
                        name="fax">
            </div>
            <div class="form-group m-form__group" id="vat">
                <label for="vat-no">
                    {{__('web.vat_no')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="vat-no"
                        name="vat_no">
            </div>
            <div class="form-group m-form__group" id="id-number">
                <label for="id-no">
                    {{__('web.id_no')}} / {{__('web.passport_no')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="id-no"
                        name="id_number">
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
            <div class="form-group m-form__group" id="web">
                <label for="website">
                    {{__('web.website')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="website"
                        name="website">
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
                        name="facebook">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group">
                <label for="twitter">
                    {{__('web.twitter')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="twitter"
                    name="twitter">
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
                        name="linkedin">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group">
                <label for="skype">
                    {{__('web.skype')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="skype"
                        name="skype">
            </div>
        </div>
    </div>
</form>

<div class="form-group m-form__group row" id="dynamic-add">
    <label class="col-lg-2 col-form-label">{{__('web.name')}}</label>
    <div class="col-lg-5">
        <input type="text" class="form-control m-input" name="dynamic_add_name" placeholder="">
        <input type="hidden" name="dynamic_add_type" value="">
    </div>
    <div class="col-lg-4">
        <a href="#" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill"
            onclick="saveDynamicAdd()">
            <i class="la la-check"></i>
        </a>
        <a href="#" class="btn btn-outline-metal m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill"
            onclick="removeDynamicAdd()">
            <i class="la la-close"></i>
        </a>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('.m_selectpicker').selectpicker();
        $('#individual-selector').hide();
        $('#id-number').hide();
        $('#dynamic-add').hide();
        $('#customer-type').on('change', function() {
            var value = $(this).val();
            if (value === 'company') {
                $('#individual-selector').hide();
                $('#company-selector').fadeIn();
                $('#id-number').hide();
                $('#web').fadeIn();
                $('#vat').fadeIn();
            } else {
                $('#company-selector').hide();
                $('#individual-selector').fadeIn();
                $('#id-number').fadeIn();
                $('#web').hide();
                $('#vat').hide();
            }
        });
    });
    function handleDynamicAdd(type) {
        if ($('select[name='+type+']').val() == -1) {
            $('.modal-footer').hide();
            $('#modal-form').hide();
            $('#dynamic-add').fadeIn();
            $('input[name=dynamic_add_type]').val(type);
            $('input[name=dynamic_add_name]').val('');
            if (type == 'customer_category_id')
                $('input[name=dynamic_add_name]').attr('placeholder', '{{__('web.customer_category')}}');
        }
    }

    function saveDynamicAdd() {
        var url = '{{route('customers.dynamic_add')}}';
        var data = {
            "_token": "{{ csrf_token() }}",
            "add_type": $('input[name=dynamic_add_type]').val(),
            "add_name": $('input[name=dynamic_add_name]').val()
        };
        $.post(url, data, function(response) {
            if (response.errors) {
                console.log(response.errors);
                $('#dynamic-add').addClass('has-danger');
            } else {
                $('#dynamic-add').removeClass('has-danger');
                handleSuccess(response);
            }
        }).fail(function(response) {
            console.log(response);
        });
    }

    function handleSuccess(response) {
        removeDynamicAdd();
        $('.modal-footer').fadeIn();
        switch (response.type) {
            case 'category':
                $('#category').prepend('<option value="'+ response.customer_category_id+'" selected>'+ response.name +'</option>');
                $('#category').selectpicker('refresh');
                break;
        }
    }

    function removeDynamicAdd() {
        $('#dynamic-add').hide();
        $('#modal-form').fadeIn();
        $('.modal-footer').fadeIn();
        if ($('#category').val() == -1) {
            $('#category').val('');
            $('#category').selectpicker('refresh');
        }
    }
</script>
@endif