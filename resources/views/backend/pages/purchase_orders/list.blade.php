@extends('backend.layouts.master')
@section('content')

    <div class="vender_box">
    <h2>Purchase Orders</h2>
    <div class="table_box">
        <img src="{{ asset('backend/assets/images/purple_box.png') }}" alt="#" class="shape">
        <div class="table-responsive">
            <table class="table table-striped datatable-basic" style="width: 100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>PO</th>
                    <th>Vendor</th>
                    <th>{{ __('web.date') }}</th>
                    <th>{{ __('web.status') }}</th>
                    <th>{{ __('web.grand_total') }}</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($purchase_orders as $key=>  $purchase_order)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $purchase_order->po }}</td>
                    <td>{{ $purchase_order->vendor->name }}</td>
                    <td>{{ date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format, $purchase_order->date) }}</td>
                    @php
                        if($purchase_order->status == 1 )
                        {
                            $status = __('web.due');
                            $label = 'label-danger';
                        }
                        else if($purchase_order->status == 2 ){
                            $status = 'Partially Paid';
                            $label = 'label-danger';
                        }
                        else{
                            $status = 'Paid';
                            $label = 'label-success';
                        }
                    @endphp
                    <td><span class="label {{ $label }}">{{ $status }}</span></td>
                    <td>{{ number_format($purchase_order->grand_total,2) }}</td>
                    <td style="width: 20%;">
                        <div class="row">
                            @if(Auth::user()->role == "admin")
                            <div class="col-sm-4">
                                <a href="{{ route('purchase_orders.edit', $purchase_order->id) }}"><img src="{{asset('backend/assets/images/edit_icon.png')}}" alt="#"></a> 
                            </div>
                            <div class="col-sm-4">
                                <div class="dropdown">
                                    <button class="btn note-btn dropdown-toggle" type="button" data-toggle="dropdown">
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a target=”_blank” href="{{ route('purchase_orders.preview', $purchase_order->id) }}">Preview</a></li>
                                        <li><a hhref="{{ route('purchase_orders.download', $purchase_order->id) }}">Download</a></li>
                                        <li><a href="{{ route('emails.po', $purchase_order->id) }}">Email to Customer</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <a  href="javascript:void(0)" onclick="confirm_modal('{{route('purchase_orders.delete', $purchase_order->id)}}');"><img src="{{asset('backend/assets/images/delete_icon.png')}}" alt="#"></a>
                            </div>
                            @elseif(Auth::user()->role == "employee")

                                @php

                                $permissions = json_decode(Auth::user()->userPermission->permissions);

                                @endphp

                                @if(in_array(7.2, $permissions))
                                    <div class="col-sm-4">
                                        <div class="dropdown">
                                            <button class="btn note-btn dropdown-toggle" type="button" data-toggle="dropdown">
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a target=”_blank” href="{{ route('purchase_orders.preview', $purchase_order->id) }}">Preview</a></li>
                                                <li><a hhref="{{ route('purchase_orders.download', $purchase_order->id) }}">Download</a></li>
                                                <li><a href="{{ route('emails.po', $purchase_order->id) }}">Email to Customer</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                @if(in_array(7.3, $permissions))
                                    <div class="col-sm-4">
                                        <a href="{{ route('purchase_orders.edit', $purchase_order->id) }}"><img src="{{asset('backend/assets/images/edit_icon.png')}}" alt="#"></a> 
                                    </div>
                                @endif
                                @if(in_array(7.4, $permissions))
                                    <div class="col-sm-4">
                                        <a  href="javascript:void(0)" onclick="confirm_modal('{{route('purchase_orders.delete', $purchase_order->id)}}');"><img src="{{asset('backend/assets/images/delete_icon.png')}}" alt="#"></a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

    @endsection