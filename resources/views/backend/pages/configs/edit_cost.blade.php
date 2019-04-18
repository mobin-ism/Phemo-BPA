<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/fonts/font-awesome.min.css')}}">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">

<script type="text/javascript" src="{{asset('backend/assets/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/assets/js/custom.js')}}"></script>

<div class="dashboard modal-body">

    <div class="inner_board">

        <div class="vender_box">

            <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-top: -30px; margin-bottom: 15px;">
                <img src="{{asset('backend/assets/images/close_icon.png')}}" style="max-height: 32px; max-width: 32px;">
            </button>

             <div class="col-xs-12 col-sm-12 padding_left">
                 <div class="form">

                    <form action="{{ route('additional_costs.update', $additional_cost->id) }}" method="POST">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf

                         <img src="{{ asset('backend/assets/images/purple_box.png') }}" alt="shape" class="shape">
                         
                         <div class="col-xs-12">
                             <div class="col-xs-4 padding_0">
                                 <div class="col-xs-12 padding_left">
                                     <label>Cost Heading</label>
                                     <input type="text" name="name" value="{{ $additional_cost->name }}" required>
                                 </div>
                             </div>
                             <div class="col-xs-4 padding_0">
                                 <div class="col-xs-12 padding_0">
                                     <label>Unit Price</label>
                                     <input type="number" min="0" step="0.01" name="unit_price" value="{{ $additional_cost->unit_price }}" required>
                                 </div>
                             </div>
                             <div class="col-xs-4 padding_0">
                                 <div class="col-xs-12 padding_right">
                                     <label>Unit Price</label>
                                     <select name="unit" class="select-search" required>
                                         <option value="Per KM" <?php if($additional_cost->unit == "Per KM") echo "selected";?> >Per KM</option>
                                         <option value="Per Day" <?php if($additional_cost->unit == "Per KM") echo "selected";?> >Per Day</option>
                                         <option value="Per Night" <?php if($additional_cost->unit == "Per KM") echo "selected";?> >Per Night</option>
                                         <option value="Per Pax" <?php if($additional_cost->unit == "Per KM") echo "selected";?> >Per Pax</option>
                                     </select>
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
