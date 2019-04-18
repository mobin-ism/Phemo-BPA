<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/fonts/font-awesome.min.css')}}">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">


<div class="dashboard modal-body">

    <div class="inner_board">

        <div class="vender_box">

            <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-top: -30px; margin-bottom: 15px;">
                <img src="{{asset('backend/assets/images/close_icon.png')}}" style="max-height: 32px; max-width: 32px;">
            </button>

             <div class="col-xs-12 col-sm-12 padding_left">
                 <div class="form">

                    <form action="{{ route('taxs.store') }}" method="POST">
                        @csrf
                        {{ Form::hidden('account_id',  Auth::user()->account_id) }}
                        
                         <img src="{{ asset('backend/assets/images/purple_box.png') }}" alt="shape" class="shape">
                         
                         <div class="col-xs-12">
                             <div class="col-xs-6 padding_0">
                                 <div class="col-xs-12 padding_left">
                                     <label>Tax Heading</label>
                                     <input type="text" name="name" required>
                                 </div>
                             </div>
                             <div class="col-xs-6 padding_0">
                                 <div class="col-xs-12 padding_right">
                                     <label>Percentage</label>
                                     <input type="number" min="0" step="0.01" name="percentage" required>
                                 </div>
                             </div>
                         </div>

                         <div class="text-center" style="background-color: transparent;box-shadow: none;">
                             
                             <button type="submit">Submit</button>

                         </div>

                     </form>
                     
                 </div>
                                 
             </div>

        </div>
    </div>
</div>
