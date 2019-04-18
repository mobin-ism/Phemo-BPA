<div class="row text-center mb-5">
    <div class="col">
        <h4>{{$config->company_name}}</h4>
        <p>
            {{$config->address_line_1}}, {{$config->address_line_2}}
            <br>
            {{$config->city}}, {{\App\Country::where('id', $config->country_id)->first()->name}}
        </p>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr class="m--font-bolder">
                        <td class="text-left">{{__('web.total_users')}}</td>
                        <td class="text-right">{{\App\User::where('account_id', $config->account_id)->count()}}</td> 
                    </tr>
                    <tr class="m--font-bolder">
                        <td class="text-left">{{__('web.customers')}}</td>
                        <td class="text-right">{{\App\Customer::where('account_id', $config->account_id)->count()}}</td>
                    </tr>
                    <tr class="m--font-bolder">
                        <td class="text-left">{{__('web.employees')}}</td>
                        <td class="text-right">{{\App\Employee::where('account_id', $config->account_id)->count()}}</td> 
                    </tr>
                    <tr class="m--font-bolder">
                        <td class="text-left">{{__('web.vendors')}}</td>
                        <td class="text-right">{{\App\Vendor::where('account_id', $config->account_id)->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr class="m--font-bolder">
                        <td class="text-left">{{__('web.account_created')}}</td>
                        <td class="text-right">{{\App\Account::where('id', $config->account_id)->first()->created_at}}</td> 
                    </tr>
                    <tr class="m--font-bolder">
                        <td class="text-left">{{__('web.status')}}</td>
                        <td class="text-right">Active/Terminated</td>
                    </tr>
                    <tr class="m--font-bolder">
                        <td class="text-left">{{__('web.last_login')}}</td>
                        <td class="text-right">{{\App\User::where('account_id', $config->account_id)->orderBy('last_login_at', 'desc')->take(1)->first()->last_login_at}}</td> 
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.modal-footer').hide();
    });
</script>





