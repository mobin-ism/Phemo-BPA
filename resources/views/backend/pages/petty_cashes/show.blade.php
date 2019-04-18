




<div class="dashboard modal-body">

    <div class="inner_board">

        <div class="vender_box">

            <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-top: -30px; margin-bottom: 15px;">
                <img src="{{asset('backend/assets/images/close_icon.png')}}" style="max-height: 32px; max-width: 32px;">
            </button>

             <div class="col-xs-12 col-sm-12 padding_left">
                 <div class="form">
                     <img src="{{ asset('backend/assets/images/purple_box.png') }}" alt="shape" class="shape">

                     <div class="col-xs-12 padding_0">
                         <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                             <label>Date</label>
                             <input type="text" name="date" placeholder="" class="datepicker" value="{{ date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format,$pettyCash->date) }}" disabled>
                         </div>
                     </div>
                     <div class="col-xs-12 padding_0">
                         <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                             <label>Department</label>
                             <select name="department" class="select-search" disabled>
                                 @foreach(\App\Department::where('account_id', Auth::user()->account_id)->get() as $department)
                                     <option value="{{ $department->name }}" <?php 
                                         if($pettyCash->department == $department->name) echo "selected";
                                     ?> >{{ $department->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     <div class="col-xs-12 padding_0">
                         <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                             <label>Requested By</label>
                             <input type="text" name="requested_by" placeholder value="{{ $pettyCash->requested_by }}"disabled>
                         </div>
                     </div>
                     <div class="col-xs-12 padding_0">
                         <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                             <label>Amount</label>
                             <input type="number" step="0.01" name="amount" value="{{ number_format($pettyCash->amount,2) }}" placeholder="" disabled>
                         </div>
                     </div>
                     <div class="col-xs-12 padding_0">
                         <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                             <label>Petty Cash Voucher</label>
                             <input type="text" name="voucher_no" placeholder="" value="{{ $pettyCash->voucher_no }}" disabled>
                         </div>
                     </div>

                     <div class="col-xs-12 padding_0">
                         <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                             <label>Description</label>
                             <textarea name="description" disabled>{{ $pettyCash->description }}</textarea>
                         </div>
                     </div>

                     @php
                         if($pettyCash->status == 1 )
                         {
                             $status = __('web.due');
                         }
                         else if($pettyCash->status == 2){
                             $status = "Accepted";
                         }
                         else{
                             $status = "Rejected";
                         }
                     @endphp

                     <div class="col-xs-12 padding_0">
                         <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                             <label>Status</label>
                             <input type="text" name="voucher_no" placeholder="" value="{{ $status }}" disabled>
                         </div>
                     </div>

                     @if($pettyCash->status != 1)
                     <div class="col-xs-12 padding_0">
                         <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                             <label>{{ $status }} By</label>
                             <input type="text" name="voucher_no" placeholder="" value="{{ $pettyCash->changed_by }}" disabled>
                         </div>
                     </div>
                     @endif
                 </div>
                                 
             </div>

        </div>
    </div>
</div>