@php
    if (isset($filtered_employees))
        $employee_data = $filtered_employees;
    else
        $employee_data = $employees;
@endphp
@foreach ($employee_data as $key => $employee)
<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body text-center">
            <img src="{{profile_photo('employee', $employee->id)}}" class="rounded-circle img-thumbnail" width="100">
            <h4 class="mt-3">
                <a href="{{route('employees.show', $employee->id)}}" class="m-link">
                    <span>{{$employee->user->name}}</span>
                </a>
            </h4>
            <p class="text-muted m--font-bolder">
                {{$employee->position}} {{$employee->department_id == null ? '' : ' | ' .$employee->department->name}}
            </p>
            <div class="row mt-5">
                <div class="col">
                    <a href="{{$employee->facebook}}" class="m-link" target="_blank">
                        <i class="socicon-facebook"></i>
                    </a>
                </div>
                <div class="col">
                    <a href="{{$employee->twitter}}" class="m-link" target="_blank">
                        <i class="socicon-twitter"></i>
                    </a>
                </div>
                <div class="col">
                    <a href="{{$employee->linkedin}}" class="m-link" target="_blank">
                        <i class="socicon-linkedin"></i>
                    </a>
                </div>
                <div class="col">
                    <a href="{{$employee->skype}}" class="m-link" target="_blank">
                        <i class="socicon-skype"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach