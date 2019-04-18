<form method="post" id="modal-form" action="{{ route('taxes.update', $tax) }}">
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
                    value="{{$tax->name}}">
            </div>
            <div class="form-group m-form__group" id="percentage-group">
                <label for="percentage">
                    * {{__('web.percentage')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="percentage" name="percentage"
                    value="{{$tax->percentage}}">
            </div>
        </div>
    </div>
</form>