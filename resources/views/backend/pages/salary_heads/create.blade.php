<form method="post" id="modal-form" action="{{ route('salary_heads.store') }}">
    @csrf
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="name-group">
                <label for="name">
                    * {{__('web.name')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="name" name="name">
            </div>
            <div class="form-group m-form__group" id="type-group">
                <label for="country">
                    * {{__('web.type')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="type">
                    <option value="benefit">{{__('web.benefit')}}</option>
                    <option value="deduction">{{__('web.deduction')}}</option>
                </select>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.m_selectpicker').selectpicker();
    });
</script>