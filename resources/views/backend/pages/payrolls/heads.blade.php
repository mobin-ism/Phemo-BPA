<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{__('web.benefits')}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body" id="benefits-section">
            @if (!isset($employee_info)) {{__('web.please_select_an_employee_first')}} @endif
            @if (isset($employee_info))
            @if($employee_info->benefits != 'null')
                @php
                    $benefits = json_decode($employee_info->benefits);
                @endphp
                @for ($i = 0; $i < count($benefits); $i++)
                <div class="form-group m-form__group">
                    <label>{{\App\SalaryHead::find($benefits[$i])->name}}</label>
                    <div class="input-group m-input-group m-input-group--pill">
                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">{{get_config('currency')}}</span></div>
                        <input type="text" class="form-control m-input" name="benefits[]" value="0" onkeyup="calculateSalary()">
                    </div>
                </div>
                <input type="hidden" name="benefit_id[]" value="{{$benefits[$i]}}">
                <input type="hidden" name="benefit_name[]" value="{{\App\SalaryHead::find($benefits[$i])->name}}">
                @endfor
            @endif
            @endif
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{__('web.deductions')}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body" id="deductions-section">
            @if (!isset($employee_info)) {{__('web.please_select_an_employee_first')}} @endif
            @if (isset($employee_info))
            @if($employee_info->deductions != 'null')
                @php
                    $deductions = json_decode($employee_info->deductions);
                @endphp
                @for ($i = 0; $i < count($deductions); $i++)
                <div class="form-group m-form__group">
                    <label>{{\App\SalaryHead::find($deductions[$i])->name}}</label>
                    <div class="input-group m-input-group m-input-group--pill">
                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">{{get_config('currency')}}</span></div>
                        <input type="text" class="form-control m-input" name="deductions[]" value="0" onkeyup="calculateSalary()">
                    </div>
                </div>
                <input type="hidden" name="deduction_id[]" value="{{$deductions[$i]}}">
                <input type="hidden" name="deduction_name[]" value="{{\App\SalaryHead::find($deductions[$i])->name}}">
                @endfor
            @endif
            @endif
        </div>
    </div>
</div>
@php
    $basic_salary = isset($employee_info) ? $employee_info->pay_in_figures : 0.0;
@endphp
<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{__('web.summary')}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="row mb-3">
                <div class="col">
                    <span class="m--font-bold @if($basic_salary == null) m--font-danger @endif">{{__('web.salary')}}</span>
                </div>
                <div class="col text-right">
                    <span class="m--font-bolder @if($basic_salary == null) m--font-danger @endif">
                        {{get_config('currency')}} <span id="salary-basic">{{$basic_salary}}</span>
                    </span>
                    <input type="hidden" name="salary" value="{{$basic_salary}}" id="salary">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <span class="m--font-bold">{{__('web.benefits')}}</span>
                </div>
                <div class="col text-right">
                    <span class="m--font-bolder">
                        {{get_config('currency')}} <span id="benefit-total">0</span>
                    </span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <span class="m--font-bold">{{__('web.deductions')}}</span>
                </div>
                <div class="col text-right">
                    <span class="m--font-bolder">
                        {{get_config('currency')}} <span id="deduction-total">0</span>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="m--font-bold">{{__('web.net_salary')}}</span>
                </div>
                <div class="col text-right">
                    <span class="m--font-bolder">
                        {{get_config('currency')}} <span id="net-salary">{{$basic_salary}}</span>
                    </span>
                    <input type="hidden" name="net_salary" id="net" value="{{$basic_salary}}">
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill pull-right">
        <span>
            <i class="la la-save"></i>
            <span>{{__('web.save')}}</span>
        </span>
    </button>
</div>

<script>
    $("input[name='benefits[]']").on('focus', function() {
        if ($(this).val() == 0)
            $(this).val('');
    });
    $("input[name='deductions[]']").on('focus', function() {
        if ($(this).val() == 0)
            $(this).val('');
    });
    function calculateSalary() {
        // calculate benefits
        var benefitTotal = 0.0;
        var benefits = $("input[name='benefits[]']").map(function() {
            return $(this).val();
        }).get();
        for (var i = 0; i < benefits.length; i++) {
            benefitTotal += parseFloat(benefits[i]);
        }
        $('#benefit-total').html(benefitTotal);

        // calculate deductions
        var deductionTotal = 0.0;
        var deductions = $("input[name='deductions[]']").map(function() {
            return $(this).val();
        }).get();
        for (var i = 0; i < deductions.length; i++) {
            deductionTotal += parseFloat(deductions[i]);
        }
        $('#deduction-total').html(deductionTotal);

        // calculate net salary
        var basicSalary = parseFloat($('#salary').val());
        var netSalary = (basicSalary + benefitTotal) - deductionTotal;
        $('#net-salary').html(netSalary);
        $('#net').val(netSalary);
    }
</script>
