@if (is_permitted('ticket_edit'))
<form method="post" id="modal-form" action="{{ route('tickets.update', $ticket) }}">
    @csrf
    {{method_field('PATCH')}}
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
                    <option value="{{$customer->id}}" <?php if ($customer->id == $ticket->customer_id) echo 'selected'; ?>>
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
                    <option value="product" {{$ticket->subject == 'product' ? 'selected' : ''}}>{{__('web.product')}}</option>
                    <option value="service" {{$ticket->subject == 'service' ? 'selected' : ''}}>{{__('web.service')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group" id="title-group">
                <label for="title">
                    * {{__('web.title')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="title" name="title"
                    value="{{$ticket->title}}">
            </div>
            <div class="form-group m-form__group" id="priority-group">
                <label for="priority">
                    * {{__('web.priority')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    title="{{__('web.select_one')}}" name="priority" id="priority">
                    <option value="high" {{$ticket->priority == 'high' ? 'selected' : ''}}>{{__('web.high')}}</option>
                    <option value="medium" {{$ticket->priority == 'medium' ? 'selected' : ''}}>{{__('web.medium')}}</option>
                    <option value="normal" {{$ticket->priority == 'normal' ? 'selected' : ''}}>{{__('web.normal')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="employee">
                    {{__('web.assigned_employee')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="employee_id" id="employee">
                    @foreach (\App\Employee::where('account_id', Auth::user()->account_id)->get() as $employee)
                    <option value="{{$employee->id}}" <?php if ($employee->id == $ticket->employee_id) echo 'selected'; ?>>
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
                    <option value="pending" {{$ticket->resolve_status == 'pending' ? 'selected' : ''}}>{{__('web.pending')}}</option>
                    <option value="resolved" {{$ticket->resolve_status == 'resolved' ? 'selected' : ''}}>{{__('web.resolved')}}</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="description-group">
                <label for="description">
                    * {{__('web.description')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="description" name="description" rows="8">{{$ticket->description}}</textarea>
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
    