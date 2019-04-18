<form method="post" id="modal-form" action="{{route('employees.update_employment_history')}}">
    @csrf
    {{ Form::hidden('id', $history->id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="title-group">
                <label for="title">
                    * {{__('web.title')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="title" name="title"
                    value="{{$history->title}}">
            </div>
            <div class="form-group m-form__group" id="employer-group">
                <label for="employer">
                    * {{__('web.employer')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="employer" name="employer"
                    value="{{$history->employer}}">
            </div>
            <div class="form-group m-form__group" id="start-group">
                <label for="start">
                    * {{__('web.start')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="start"
                    id="start" value="{{get_formatted_date_from_timestamp($history->start)}}" readonly>
            </div>
            <div class="form-group m-form__group" id="end-input">
                <label for="end">
                    {{__('web.end')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="end"
                    id="end" value="{{get_formatted_date_from_timestamp($history->end)}}" readonly>
            </div>
            <div class="m-form__group form-group">
                <div class="m-checkbox-list">
                    <label class="m-checkbox m-checkbox--brand">
                        <input type="checkbox" name="present" value="{{$history->present}}" @if ($history->present == 1) checked @endif>
                        {{ __('web.present') }} ({{__('web.only_check_if_currently_employed')}})
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group m-form__group" id="description-group">
                <label for="description">
                    * {{__('web.description')}} ({{__('web.role_and_responsibilities')}})
                </label>
                <textarea class="form-control m-input m-input--pill" id="description" name="description" rows="5">{{$history->description}}</textarea>
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
        if ($(this).is(':checked')) {
            $('#end-input').hide();
        }
        $('.m_selectpicker').selectpicker();
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            clearBtn: !0
        });
        $('input[name=present]').on('change', function() {
            if ($(this).is(':checked')) {
                $(this).val(1);
                $('#end-input').fadeOut();
            } else {
                $(this).val(0);
                $('#end-input').fadeIn();
            }
        });
    });
</script>
