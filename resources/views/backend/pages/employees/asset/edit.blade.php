<form method="post" id="modal-form" action="{{route('employees.update_asset')}}">
    @csrf
    {{ Form::hidden('id', $asset->id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="name-group">
                <label for="name">
                    * {{__('web.name')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="name" name="name"
                    value="{{$asset->name}}">
            </div>
            <div class="form-group m-form__group" id="serial-group">
                <label for="serial">
                    * {{__('web.serial')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="serial" name="serial"
                    value="{{$asset->serial}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="make">
                    {{__('web.make')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="make" name="make"
                    value="{{$asset->make}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="value">
                    {{__('web.value')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="value" name="value"
                    value="{{$asset->value}}">
            </div>
            <div class="form-group m-form__group" id="date_acquired-group">
                <label for="date-acquired">
                    * {{__('web.date_acquired')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="date_acquired" 
                    id="date-acquired" value="{{get_formatted_date_from_timestamp($asset->date_acquired)}}" readonly>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="date-returned">
                    {{__('web.date_returned')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="date_returned" 
                    id="date-returned" value="{{get_formatted_date_from_timestamp($asset->date_returned)}}" readonly>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="">
                <label for="date-assigned">
                    {{__('web.date_assigned')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="date_assigned" 
                    id="date-assigned" value="{{get_formatted_date_from_timestamp($asset->date_assigned)}}" readonly>
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
        $('.m_selectpicker').selectpicker();
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            clearBtn: !0
        });
    });
</script>