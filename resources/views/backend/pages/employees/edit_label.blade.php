<form method="post" id="modal-form" action="{{route('employees.update_label')}}">
    @csrf
    {{ Form::hidden('id', $doc->id) }}
    {{ Form::hidden('employee_id', $doc->employee_id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="label-group">
                <label for="label">
                    * {{__('web.label')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="label" name="label"
                    value="{{$doc->label}}">
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('.modal-footer').show();
    });
</script>