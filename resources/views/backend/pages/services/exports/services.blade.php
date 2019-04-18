<html>
    <head>
        <style>
            body {
                padding: 10px;
                font-size: 12px;
            }
            table {
                width: 100%;
                border-collapse:collapse;
                border: 1px solid #cfd0d2;
            }
            td, th {
                border-bottom-width: 0;
                border-left-width: 0;
                border: 1px solid #cfd0d2;
                padding: 5px;
            } 
            .table-holder {
                width: 100%;
                height: auto;
                position: relative;
            }   
            .title-info {
                width: 100%;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="title-info">
            <img src="{{url('public/storage/'. get_config('logo'))}}" width="100">
            <h4>{{__('web.services')}} | {{date('F j, Y')}}</h4>
        </div>
        <div class="table-holder">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('web.code')}}</th>
                        <th>{{__('web.name')}}</th>
                        <th>{{__('web.rate')}}</th>
                        <th>{{__('web.uom')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $key => $service)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$service->code}}</td>
                            <td>{{$service->name}}</td>
                            <td>{{get_config('currency')}} {{number_format($service->rate, 2, '.', ',')}}</td>
                            <td>{{$service->unit_of_measure_id > 0 ? $service->unit_of_measure->name : ''}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>