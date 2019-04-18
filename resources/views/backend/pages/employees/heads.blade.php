<form action="{{route('employees.update_heads')}}" method="post" id="modal-form">
    @csrf
    {{ Form::hidden('id', $employee->id) }}
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-muted">
                {{__('web.benefits')}}
            </h4>
            <hr>
            @foreach (\App\SalaryHead::where(['account_id' => Auth::user()->account_id, 'type' => 'benefit'])->get() as $benefit)
            <label class="m-option">
                <span class="m-option__control">
                    <span class="m-radio m-radio--brand m-radio--check-bold">
                        <input type="checkbox" name="benefits[]" value="{{$benefit->id}}" 
                            {{has_salary_head($benefit->id, $employee->benefits) ? 'checked' : ''}}>
                        <span></span>
                    </span>
                </span>
                <span class="m-option__label">
                    <span class="m-option__head">
                        <span class="m-option__title">
                            {{$benefit->name}}
                        </span>
                    </span>
                </span>
            </label>
            @endforeach
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-muted">
                {{__('web.deductions')}}
            </h4>
            <hr>
            @foreach (\App\SalaryHead::where(['account_id' => Auth::user()->account_id, 'type' => 'deduction'])->get() as $deduction)
            <label class="m-option">
                <span class="m-option__control">
                    <span class="m-radio m-radio--brand m-radio--check-bold">
                        <input type="checkbox" name="deductions[]" value="{{$deduction->id}}"
                            {{has_salary_head($deduction->id, $employee->deductions) ? 'checked' : ''}}>
                        <span></span>
                    </span>
                </span>
                <span class="m-option__label">
                    <span class="m-option__head">
                        <span class="m-option__title">
                            {{$deduction->name}}
                        </span>
                    </span>
                </span>
            </label>
            @endforeach
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
    });
</script>