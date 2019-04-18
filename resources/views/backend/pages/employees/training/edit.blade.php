<form method="post" id="modal-form" action="{{route('employees.update_training')}}">
    @csrf
    {{ Form::hidden('id', $training->id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group">
                <label for="training-type">
                    {{__('web.training_type')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="training_type_id" id="training-type"
                        onchange="handleDynamicAdd('training_type_id')">
                    @foreach (\App\TrainingType::where('account_id', Auth::user()->account_id)->get() as $trainingType)
                    <option value="{{$trainingType->id}} <?php if ($training->training_type_id == $trainingType->id) echo 'selected'; ?>">{{$trainingType->name}}</option>
                    @endforeach
                    <option value="-1" data-icon="la la-plus"> {{__('web.new_training_type')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group" id="description-group">
                <label for="description">
                    * {{__('web.description')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="description" name="description" rows="3">{{$training->description}}</textarea>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="duration">
                    {{__('web.duration')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="duration" name="duration"
                    value="{{$training->duration}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="start">
                    {{__('web.start')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="start" 
                    id="start" value="{{get_formatted_date_from_timestamp($training->start)}}" readonly>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="end">
                    {{__('web.end')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="end" 
                    id="end" value="{{get_formatted_date_from_timestamp($training->end)}}" readonly>
            </div>
        </div>
        <div class="col-lg-6" id="not-conference">
            <div class="form-group m-form__group" id="">
                <label for="offered-by">
                    {{__('web.offered_by')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="offered-by" name="offered_by"
                    value="{{$training->offered_by}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="award">
                    {{__('web.award')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="award" name="award"
                    value="{{$training->award}}">
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

@php
    $format = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('#dynamic-add').hide();
        $('.m_selectpicker').selectpicker();
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            clearBtn: !0
        });
    });

    function handleDynamicAdd(type) {
        if ($('select[name='+type+']').val() == -1) {
            $('.modal-footer').hide();
            $('#modal-form').hide();
            $('#dynamic-add').fadeIn();
            $('input[name=dynamic_add_type]').val(type);
            $('input[name=dynamic_add_name]').val('');
            if (type == 'training_type_id')
                $('input[name=dynamic_add_name]').attr('placeholder', '{{__('web.training_type')}}');
        }
    }

    function saveDynamicAdd() {
        var url = '{{route('employees.dynamic_add')}}';
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
        switch (response.type) {
            case 'trainingType':
                $('#training-type').prepend('<option value="'+ response.training_type_id+'" selected>'+ response.name +'</option>');
                $('#training-type').selectpicker('refresh');
                break;
        }
    }

    function removeDynamicAdd() {
        $('#dynamic-add').hide();
        $('#modal-form').fadeIn();
        if ($('#training-type').val() == -1) {
            $('#training-type').val('');
            $('#training-type').selectpicker('refresh');
        }
    }

</script>