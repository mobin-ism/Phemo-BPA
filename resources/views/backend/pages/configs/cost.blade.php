@extends('backend.layouts.master')
@section('content')
    
    <!-- <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> {{ __('web.customers') }}</h4>
    
            </div>
    
        </div>
    </div> -->


    <div class="vender_box">
        <h2>Departments & Expense Categories</h2>
        <div class="table_box">
            
            <div>
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="{{$tab == 'tax' ? 'active' : ''}}"><a href="{{route('configs.tax')}}" >Tax</a></li>
                        <li class="{{$tab == 'cost' ? 'active' : ''}}"><a href="{{route('configs.additional_cost')}}">Additional Costs</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="basic-tab1">
                            
                            <table class="table table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Cost Heading</th>
                                    <th>Unit Cost</th>
                                    <th>UoM</th>
                                    <th width="20%">Option</th>
                                </thead>
                                <tbody>
                                    @foreach(\App\AdditionalCost::where('account_id', Auth::user()->account_id)->get() as $key => $cost)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $cost->name }}</td>
                                            <td>{{ number_format($cost->unit_price,2) }}</td>
                                            <td>{{ $cost->unit }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <a href="#" onclick="showAjaxModal('{{ route('additional_costs.edit', $cost->id) }}');"><img src="{{asset('backend/assets/images/edit_icon.png')}}" alt="#"></a> 
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <a href="#" onclick="confirm_modal('{{route('additional_costs.delete', $cost->id)}}');"><img src="{{asset('backend/assets/images/delete_icon.png')}}" alt="#"></a> 
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="col-sm-12" align="center">
                                <button class="btn" onclick="showAjaxModal('{{ route('additional_costs.create') }}');">Create</button>
                            </div>
                            
                        </div>

                    </div>
                </div>


                <br/>

                <br/>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

@endsection