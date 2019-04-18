<form method="post" id="modal-form" action="{{route('employees.update_personal')}}">
    @csrf
    {{ Form::hidden('id', $employee->id) }}
    <div class="row mb-4">
        <div class="col-lg-6">
            <h4 class="text-muted">
                {{__('web.basic_information')}}
            </h4>
            <hr>
            <div class="form-group m-form__group" id="employee_no-group">
                <label for="employee-no">
                    * {{__('web.employee_no')}}
                </label>
                <div class="input-group m-input-group m-input-group--pill">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            {{\App\Config::where('account_id', Auth::user()->account_id)->first()->employee_prefix}}
                        </span>
                    </div>
                    <input type="text" class="form-control m-input" id="employee-no" name="employee_no"
                        value="{{$employee->employee_no}}">
                </div>
            </div>
            <div class="form-group m-form__group" id="name-group">
                <label for="name">
                    * {{__('web.name')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="name" name="name"
                    value="{{$employee->user->name}}">
            </div>
            <div class="form-group m-form__group" id="surname-group">
                <label for="surname">
                    * {{__('web.surname')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="surname" name="surname"
                    value="{{$employee->surname}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="nationality">
                    {{__('web.nationality')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="nationality" name="nationality"
                    value="{{$employee->nationality}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="gender">
                    {{__('web.gender')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="gender" id="gender">
                    <option value="male" <?php if ($employee->gender == 'male') echo 'selected'; ?>>{{__('web.male')}}</option>
                    <option value="female <?php if ($employee->gender == 'female') echo 'selected'; ?>">{{__('web.female')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="birth-date">
                    {{__('web.birth_date')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="bday" 
                    id="birth-date" value="{{get_formatted_date_from_timestamp($employee->bday)}}" readonly>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="marital-status">
                    {{__('web.marital_status')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="marital_status" id="marital-status" title="{{__('web.select_one')}}">
                    <option value="married" <?php if ($employee->marital_status == 'married') echo 'selected'; ?>>{{__('web.married')}}</option>
                    <option value="single" <?php if ($employee->marital_status == 'single') echo 'selected'; ?>>{{__('web.single')}}</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <h4 class="text-muted">
                {{__('web.additional_information')}}
            </h4>
            <hr>
            <div class="form-group m-form__group" id="">
                <label for="ethnicity">
                    {{__('web.ethnicity')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="ethnicity" name="ethnicity"
                    value="{{$employee->ethnicity}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="religion">
                    {{__('web.religion')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="religion" name="religion"
                    value="{{$employee->religion}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="national-id">
                    {{__('web.national_id')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="national-id" name="nid"
                    value="{{$employee->nid}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="passport-no">
                    {{__('web.passport_no')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="passport-no" name="passport"
                    value="{{$employee->passport}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="tax-no">
                    {{__('web.tax_no')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="tax-no" name="tax_no"
                    value="{{$employee->tax_no}}">
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-6">
            <h4 class="text-muted">
                {{__('web.contact_information')}}
            </h4>
            <hr>
            <div class="form-group m-form__group" id="email-group">
                <label for="email">
                    * {{__('web.email')}}
                </label>
                <input type="email" class="form-control m-input m-input--pill" id="email" name="email"
                    value="{{$employee->user->email}}">
            </div>
            <div class="form-group m-form__group" id="personal_phone-group">
                <label for="personal-phone">
                    * {{__('web.phone')}} ({{__('web.personal')}})
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="personal-phone" name="personal_phone"
                    value="{{$employee->personal_phone}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="office-phone">
                    {{__('web.phone')}} ({{__('web.office')}})
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="office-phone" name="office_phone"
                    value="{{$employee->office_phone}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="house-phone">
                    {{__('web.phone')}} ({{__('web.house')}})
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="house-phone" name="house_phone"
                    value="{{$employee->house_phone}}">
            </div>
        </div>
        <div class="col-lg-6">
            <h4 class="text-muted">
                {{__('web.emergency_contact')}}
            </h4>
            <hr>
            <div class="form-group m-form__group" id="emergency_name-group">
                <label for="emergency-name">
                    * {{__('web.name')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="emergency-name" name="emergency_name"
                    value="{{$employee->emergency_name}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="emergency-email">
                    {{__('web.email')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="emergency-email" name="emergency_email"
                    value="{{$employee->emergency_email}}">
            </div>
            <div class="form-group m-form__group" id="emergency_phone-group">
                <label for="emergency-phone">
                    * {{__('web.phone')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="emergency-phone" name="emergency_phone"
                    value="{{$employee->emergency_phone}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="emergency-address">
                    {{__('web.address')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="emergency-address" name="emergency_address"
                    value="{{$employee->emergency_address}}">
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
                        name="facebook" value="{{$employee->facebook}}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group">
                <label for="twitter">
                    {{__('web.twitter')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="twitter"
                    name="twitter" value="{{$employee->twitter}}">
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
                        name="linkedin" value="{{$employee->linkedin}}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group">
                <label for="skype">
                    {{__('web.skype')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="skype"
                        name="skype" value="{{$employee->skype}}">
            </div>
        </div>
    </div>
</form>

@php
    $jvformat = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('.m_selectpicker').selectpicker();
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$jvformat}}',
            clearBtn: !0
        });
    });
</script>