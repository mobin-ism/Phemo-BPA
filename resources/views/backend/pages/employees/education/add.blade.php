<form method="post" id="modal-form" action="{{route('employees.store_education')}}">
    @csrf
    {{ Form::hidden('id', $employee_id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="institution-group">
                <label for="institution">
                    * {{__('web.institution')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="institution" name="institution"
                    value="">
            </div>
            <div class="form-group m-form__group" id="degree-group">
                <label for="degree">
                    * {{__('web.degree')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="degree" name="degree"
                    value="">
            </div>
            <div class="form-group m-form__group" id="major-group">
                <label for="major">
                    * {{__('web.major')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="major" name="major"
                    value="">
            </div>
            <div class="form-group m-form__group" id="gpa-group">
                <label for="gpa">
                    * {{__('web.gpa')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="gpa" name="gpa"
                    value="">
            </div>
            <div class="form-group m-form__group" id="start-group">
                <label for="start">
                    * {{__('web.start')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="start" 
                    id="start" readonly>
            </div>
            <div class="form-group m-form__group" id="end-group">
                <label for="end">
                    * {{__('web.end')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="end" 
                    id="end" readonly>
            </div>
        </div>
    </div>
</form>

@php
    $format = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            clearBtn: !0
        });
    });
</script>