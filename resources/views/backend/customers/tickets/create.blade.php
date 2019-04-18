<form method="post" id="modal-form" action="{{ route('customer.store_ticket') }}">
    @csrf
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="customer_id-group">
                <label for="customer">
                    * {{__('web.customer')}}
                </label>
                @php
                    $customer = \App\Customer::where('user_id', Auth::user()->id)->first();
                @endphp
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="customer_id" id="customer">
                    <option value="{{$customer->id}}">
                        {{$customer->customer_type == 'company' ? $customer->primary_contact.' ('.$customer->company_name.')' : $customer->customer_name}}
                    </option>
                </select>
            </div>
            <div class="form-group m-form__group" id="subject-group">
                <label for="subject">
                    * {{__('web.subject')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    title="{{__('web.select_one')}}" name="subject" id="subject">
                    <option value="product">{{__('web.product')}}</option>
                    <option value="service">{{__('web.service')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group" id="title-group">
                <label for="title">
                    * {{__('web.title')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="title" name="title">
            </div>
            <div class="form-group m-form__group" id="priority-group">
                <label for="priority">
                    * {{__('web.priority')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    title="{{__('web.select_one')}}" name="priority" id="priority">
                    <option value="high">{{__('web.high')}}</option>
                    <option value="medium">{{__('web.medium')}}</option>
                    <option value="normal">{{__('web.normal')}}</option>
                </select>
            </div>
            <input type="hidden" name="employee_id" value="">
            <input type="hidden" name="resolve_status" value="pending">
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="description-group">
                <label for="description">
                    * {{__('web.description')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="description" name="description" rows="8"></textarea>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('.m_selectpicker').selectpicker();
    });
</script>