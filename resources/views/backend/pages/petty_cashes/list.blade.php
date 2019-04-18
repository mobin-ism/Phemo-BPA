@extends('backend.layouts.master')
@section('content')

    <!-- <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> {{ __('web.vendors') }}</h4>
    
            </div>
    
        </div>
    </div> -->


    <div class="vender_box">
        <h2>Petty Cashes</h2>
        <div class="table_box">
            
            <div>
                <table class="table table-responsive table-striped datatable-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Requested By</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>{{ __('web.options') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($petty_cashes as $key => $petty_cash)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format,$petty_cash->date) }}</td>
                            <td>{{ $petty_cash->requested_by }}</td>
                            <td>{{ number_format($petty_cash->amount,2) }}</td>
                            @php
                                if($petty_cash->status == 1 )
                                {
                                    $status = __('web.due');
                                    $label = 'label-danger';
                                }
                                else if($petty_cash->status == 2){
                                    $status = "Accepted";
                                    $label = 'label-success';
                                }
                                else{
                                    $status = "Rejected";
                                    $label = 'label-danger';
                                }
                            @endphp
                            <td><span class="label {{ $label }}">{{ $status }}</span></td>
                            <td style="width: 20%;">
                                <div class="row">
                                    @if(Auth::user()->role == "admin")
                                    <div class="col-sm-4">
                                        <a href="#" onclick="showAjaxModal('{{ route('petty_cashes.show', $petty_cash->id) }}');">
                                            <img src="{{asset('backend/assets/images/show_icon.png')}}" alt="#">
                                        </a>  
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="{{ route('petty_cashes.edit', $petty_cash->id) }}"><img src="{{asset('backend/assets/images/edit_icon.png')}}" alt="#"></a>  
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="#" onclick="confirm_modal('{{route('petty_cashes.delete', $petty_cash->id)}}');"><img src="{{asset('backend/assets/images/delete_icon.png')}}" alt="#"></a>  
                                    </div>
                                    @elseif(Auth::user()->role == "employee")

                                        @php

                                        $permissions = json_decode(Auth::user()->userPermission->permissions);

                                        @endphp

                                        @if(in_array(11.2, $permissions))
                                            <div class="col-sm-4">
                                                <a href="#" onclick="showAjaxModal('{{ route('petty_cashes.show', $petty_cash->id) }}');">
                                                    <img src="{{asset('backend/assets/images/show_icon.png')}}" alt="#">
                                                </a>  
                                            </div>
                                        @endif
                                        @if(in_array(11.3, $permissions))
                                            <div class="col-sm-4">
                                                <a href="{{ route('petty_cashes.edit', $petty_cash->id) }}"><img src="{{asset('backend/assets/images/edit_icon.png')}}" alt="#"></a>  
                                            </div>
                                        @endif
                                        @if(in_array(11.4, $permissions))
                                            <div class="col-sm-4">
                                                <a href="#" onclick="confirm_modal('{{route('petty_cashes.delete', $petty_cash->id)}}');"><img src="{{asset('backend/assets/images/delete_icon.png')}}" alt="#"></a>  
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <br/>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

@endsection