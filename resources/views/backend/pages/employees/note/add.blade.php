<form method="post" id="modal-form" action="{{route('employees.store_note')}}">
    @csrf
    {{ Form::hidden('id', $employee_id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="title-group">
                <label for="title">
                    * {{__('web.title')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="title" name="title"
                    value="">
            </div>
            <div class="form-group m-form__group" id="description-group">
                <label for="description">
                    * {{__('web.description')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="description" name="description" rows="5"></textarea>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('#description').autosize();
    });
</script>