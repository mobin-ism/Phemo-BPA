@extends('backend.layouts.master')
@section('content')
    <div class="vender_box">
        <h2>Vendors</h2>
        <div class="col-xs-12 col-sm-7 padding_left">
            <form>
                <img src="{{ asset('backend/assets/images/purple_box.png') }}" alt="shape" class="shape">
                <h4>Vendors Basic Info</h4>
                <div class="col-xs-12 padding_0">
                    <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                        <label>Name</label>
                        <input type="text" placeholder="Said">
                    </div>
                    <div class="col-xs-12 col-sm-6 padding_right">
                        <input type="text" placeholder="Contact Person">
                    </div>
                </div>
                <div class="col-xs-12 padding_0">
                    <div class="col-xs-12 col-sm-6 padding_left">
                        <input type="text" placeholder="Company Email">
                    </div>
                    <div class="col-xs-12 col-sm-6 padding_right">
                        <input type="text" placeholder="Contact Email">
                    </div>
                </div>
                <div class="col-xs-12 padding_0">
                    <div class="col-xs-12 col-sm-6 padding_left">
                        <input type="text" placeholder="Work Number">
                    </div>
                    <div class="col-xs-12 col-sm-6 padding_right">
                        <input type="text" placeholder="Cell phone">
                    </div>
                </div>
                <div class="col-xs-12 padding_0">
                    <div class="col-xs-12 col-sm-6 padding_left">
                        <input type="text" placeholder="TIN Number">
                    </div>
                    <div class="col-xs-12 col-sm-6 padding_right">
                        <input type="text" placeholder="Tax Number">
                    </div>
                </div>
                <div class="col-xs-12 padding_0">
                    <div class="col-xs-12 col-sm-6 padding_left">
                        <input type="text" placeholder="SWIFT Code">
                    </div>
                    <div class="col-xs-12 col-sm-6 padding_right">
                        <input type="text" placeholder="IBAN">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-12 col-sm-5 padding_right">
            <form>
                <h4>Vendors Address</h4>
                <div class="col-xs-12 padding_0">
                    <div class="col-xs-12 padding_0" style="position: relative;">
                        <label>Street Address</label>
                        <textarea></textarea>
                    </div>
                </div>
                <div class="col-xs-12 padding_0">
                    <div class="col-xs-12 col-sm-6 padding_left">
                        <input type="text" placeholder="Zip Code">
                    </div>
                    <div class="col-xs-12 col-sm-6 padding_right">
                        <input type="text" placeholder="State">
                    </div>
                </div>
                <div class="col-xs-12 padding_0">
                    <div class="col-xs-12 col-sm-6 padding_left">
                        <input type="text" placeholder="Country">
                    </div>
                    <div class="col-xs-12 col-sm-6 padding_right">
                        <input type="text" placeholder="Skype ID">
                    </div>
                </div>
                <div class="col-xs-12 padding_0">
                    <div class="col-xs-12 col-sm-6 padding_left">
                        <input type="text" placeholder="Website">
                    </div>
                    <div class="col-xs-12 col-sm-6 padding_right">
                        
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-12 padding_0">
            <form class="text-center" style="background-color: transparent;box-shadow: none;">
                <button value="submit" type="submit">UPDATE</button>
            </form>
        </div>
    </div>
@endsection