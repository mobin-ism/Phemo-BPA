@if (is_permitted('service_view'))
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.code')}}</span><br>
        <span class="m--font-bolder">{{$service->code}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.name')}}</span><br>
        <span class="m--font-bolder">{{$service->name}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.description')}}</span><br>
        <span class="m--font-bolder">{{$service->description}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.rate')}}</span><br>
        <span class="m--font-bolder">{{get_config('currency')}} {{number_format($service->rate, 2, '.', ',')}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.unit_of_measure')}}</span><br>
        <span class="m--font-bolder">{{$service->unit_of_measure_id > 0 ? $service->unit_of_measure->name : ''}}</span>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-footer').hide();
    });
</script>
@endif