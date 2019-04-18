<br>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h5 class="panel-title">Employment Information</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>

            </ul>
        </div>


    </div>

    <div class="panel-body">

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Joined Date</label>
                <input type="text" name="joined_date" placeholder="" class="datepicker" required="true">
            </div>
        </div>

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>End of Probation</label>
                <input type="text" name="probation_date" placeholder="" class="datepicker" required="true">
            </div>
        </div>

    </div>

</div>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h5 class="panel-title">Job Status</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>

            </ul>
        </div>


    </div>

    <div class="panel-body">

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Position</label>
                <input type="text" name="position" placeholder="" required="true">
            </div>

            <div class="col-xs-12 col-sm-6 padding_right">
                <label>Effective Date</label>
                <input type="text" name="effective_date" placeholder="" required="true" class="datepicker">
            </div>

        </div>

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Line Manager</label>
                <input type="text" name="line_manager" placeholder="">
            </div>
            <div class="col-xs-12 col-sm-6 padding_right">
                <label>Department</label>
                <select name="department" class="select-search" required>
                    @foreach(\App\Department::where('account_id', Auth::user()->account_id)->get() as $department)
                        <option value="{{ $department->name }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Branch</label>
                <input type="text" name="branch" placeholder="">
            </div>
        </div>

    </div>

</div>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h5 class="panel-title">Employment Status</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>

            </ul>
        </div>


    </div>

    <div class="panel-body">

        <div class="col-xs-12 col-sm-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Job Type</label>
                <select name="job_type" id="job_type" class="select-search" required="true">
                    <option value="Permanent">Permanent</option>
                    <option value="Probation">Probation</option>
                    <option value="Contractual">Contractual</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 padding_0">
            <div class="col-xs-12 col-sm-6 padding_left">
                <label>Job Status</label>
                <input type="text" name="job_status" placeholder="">
            </div>
        </div>

    </div>

</div>