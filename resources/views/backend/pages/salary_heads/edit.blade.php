<form method="post" id="modal-form" action="{{ route('salary_heads.update', $salary_head) }}">
    @csrf
    {{method_field('PATCH')}}
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="name-group">
                <label for="name">
                    * {{__('web.name')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="name" name="name"
                    value="{{$salary_head->name}}">
            </div>
            <div class="form-group m-form__group" id="type-group">
                <label for="country">
                    * {{__('web.type')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="type">
                    <option value="benefit" <?php if ($salary_head->type == 'benefit') echo 'selected';?>>{{__('web.benefit')}}</option>
                    <option value="deduction" <?php if ($salary_head->type == 'deduction') echo 'selected';?>>{{__('web.deduction')}}</option>
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