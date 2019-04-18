@if (is_permitted('ticket_view'))
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.subject')}}</span><br>
        <span class="m--font-bolder">{{__('web.'.$ticket->subject)}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.title')}}</span><br>
        <span class="m--font-bolder">{{$ticket->title}}</span>
    </div>
</div>
<?php
    $customer_id = $ticket->customer_id;
    $row = \App\Customer::where('id', $customer_id)->first();
    $name = $row->customer_type == 'company' ? $row->primary_contact : $row->customer_name;
?>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.customer')}}</span><br>
        <span class="m--font-bolder">{{$name}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.description')}}</span><br>
        <span class="m--font-bolder">{{$ticket->description}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.assigned_employee')}}</span><br>
        <span class="m--font-bolder">
            @if ($ticket->employee_id != null)
            {{$ticket->employee->user->name}}
            @endif
        </span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.priority')}}</span><br>
        <span class="m--font-bolder">{{__('web.'.$ticket->priority)}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.status')}}</span><br>
        <span class="m--font-bolder">{{__('web.'.$ticket->resolve_status)}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.created_at')}}</span><br>
        <span class="m--font-bolder">{{$ticket->created_at}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.last_updated')}}</span><br>
        <span class="m--font-bolder">{{$ticket->updated_at}}</span>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-footer').hide();
    });
</script>
@endif