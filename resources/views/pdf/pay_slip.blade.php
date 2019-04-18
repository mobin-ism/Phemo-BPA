<style media="screen">
    *{
        font-family: "Helvetica Neue", Helvetica, "Noto Sans", sans-serif;
    }
    .text-center{text-align: center;}
    .text-right{text-align: right;}
    hr {
        margin-top: 17px;
        margin-bottom: 17px;
        border: 0;
        border-top: 1px solid #eeeeee;
    }
    .table-bordered {
        border: 1px solid #ebebeb;
    }
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ebebeb;
    }
    .table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
        background-color: #f5f5f6;
        border-bottom-width: 0px;
        color: #a6a7aa;
        border-bottom: 0 !important;
    }
    .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
        border: 1px solid #ebebeb;
    }
</style>


@php
    $employee = \App\Employee::find($data['employee_id']);
@endphp

<div id="payroll_print">
        <table width="100%" border="0">
            <tbody><tr>
                <td width="50%"><img src="{{ asset('backend/assets/images/phemo_white.png') }}" style="max-height:80px;"></td>
                <td align="right">
                    <div>Employee : {{$employee->user->name}}</div>
                    <div>Date of Payment: {{$data['date_of_payment']}}</div>
                    <div>Payment Period : {{$data['date_from']}} to {{$data['date_to']}}</div>
                </td>
            </tr>
        </tbody></table>

        <hr><br>
        <h4 style="text-align: center;">Allowance Summary</h4>
        <div></div>
        <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th width="60%">Type</th>
                    <th>Amount</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Salary</td>
                    <td class="text-right">{{$employee->salary}}</td>
                </tr>
                @php
                    $earning = 0;
                @endphp
                @foreach($data['earning_amounts'] as $key => $earning_amount)
                    @if($earning_amount > 0)
                        @php
                            $earning += $data['earning_amounts'][$key];
                        @endphp
                        <tr>
                            <td class="text-center">{{$key+2}}</td>
                            <td>{{$data['earning_types'][$key]}}</td>
                            <td class="text-right">{{$data['earning_amounts'][$key]}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <br>
        <h4 style="text-align: center;">Deduction Summary</h4>
        <div></div>
        <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th width="60%">Type</th>
                    <th>Amount</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $deduction = 0;
                @endphp
                @foreach($data['deduction_amounts'] as $key => $deduction_amount)
                    @if($deduction_amount > 0)
                        @php
                            $deduction += $data['deduction_amounts'][$key];
                        @endphp
                        <tr>
                            <td class="text-center">{{$key+2}}</td>
                            <td>{{$data['deduction_types'][$key]}}</td>
                            <td class="text-right">{{$data['deduction_amounts'][$key]}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <br>
        <h3 style="text-align: center; margin-bottom: 0px;">Payslip Summary</h3>
        <center><hr style="margin: 5px 0px 5px 0px; width: 50%;"></center>
        <center>
            <table>
                <tbody><tr>
                        <td style="font-weight: 600; font-size: 15px; color: #000;">
                            Basic Salary</td>
                        <td style="font-weight: 600; font-size: 15px; color: #000; width: 15%;
                            text-align: center;"> : </td>
                        <td style="font-weight: 600; font-size: 15px; color: #000;
                            text-align: right;">{{$employee->salary}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; font-size: 15px; color: #000;">
                            Total Allowance</td>
                        <td style="font-weight: 600; font-size: 15px; color: #000;
                            width: 15%; text-align: center;"> : </td>
                        <td style="font-weight: 600; font-size: 15px; color: #000;
                            text-align: right;">{{$earning}}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; font-size: 15px; color: #000;">
                            Total Deduction</td>
                        <td style="font-weight: 600; font-size: 15px; color: #000;
                            width: 15%; text-align: center;"> : </td>
                        <td style="font-weight: 600; font-size: 15px; color: #000;
                            text-align: right;">{{$deduction}}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr style="margin: 5px 0px;"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; font-size: 15px; color: #000;">
                            Net Salary</td>
                        <td style="font-weight: 600; font-size: 15px; color: #000;
                            width: 15%; text-align: center;"> : </td>
                        <td style="font-weight: 600; font-size: 15px; color: #000;
                            text-align: right;">{{$employee->salary+$earning-$deduction}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
        <br>
    </div>
