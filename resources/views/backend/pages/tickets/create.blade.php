@if (is_permitted('ticket_create'))
<form method="post" id="modal-form" action="{{ route('tickets.store') }}">
    @csrf
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="customer_id-group">
                <label for="customer">
                    * {{__('web.customer')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="customer_id" id="customer">
                    @foreach (\App\Customer::where('account_id', Auth::user()->account_id)->get() as $customer)
                    <option value="{{$customer->id}}">
                        {{$customer->customer_type == 'company' ? $customer->primary_contact.' ('.$customer->company_name.')' : $customer->customer_name}}
                    </option>
                    @endforeach
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
            <div class="form-group m-form__group" id="">
                <label for="employee">
                    {{__('web.assigned_employee')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="employee_id" id="employee">
                    @foreach (\App\Employee::where('account_id', Auth::user()->account_id)->get() as $employee)
                    <option value="{{$employee->id}}">
                        {{$employee->user->name}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-form__group" id="resolve_status-group">
                <label for="status">
                    * {{__('web.status')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    title="{{__('web.select_one')}}" name="resolve_status" id="status">
                    <option value="pending">{{__('web.pending')}}</option>
                    <option value="resolved">{{__('web.resolved')}}</option>
                </select>
            </div>
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
@endif