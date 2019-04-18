<br>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h5 class="panel-title">Personal Info</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>

            </ul>
        </div>


    </div>

    <div class="panel-body">

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Name</label>
                <input type="text" name="name" placeholder="" required="true"
            value="{{$employee->user->name}}">
            </div>
        </div>

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                <label>Gender</label>
                <select name="gender" id="gender" class="select-search">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Birth Date</label>
                <input type="text" name="bday" placeholder="" id="birth-date" required="true">
            </div>
        </div>

    </div>

</div>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h5 class="panel-title">Nationality Details</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>

            </ul>
        </div>


    </div>

    <div class="panel-body">

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Nationality</label>
                <input type="text" name="nationality" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>National ID</label>
                <input type="text" name="nid" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Passport No</label>
                <input type="text" name="passport" placeholder="">
            </div>
        </div>

    </div>

</div>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h5 class="panel-title">Additional Details</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>

            </ul>
        </div>


    </div>

    <div class="panel-body">

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Ethnicity</label>
                <input type="text" name="ethnicity" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Religion</label>
                <input type="text" name="religion" placeholder="">
            </div>
        </div>

    </div>

</div>