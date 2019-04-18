@extends('backend.layouts.master')
@section('content')

    <div class="vender_box">
        <h2>User Permissions</h2>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('user_permissions.permissions.store') }}" method="POST" id="validate-form">
            @csrf
            <div class="col-xs-12 col-sm-12 padding_left">
                <div class="form">
                    <img src="{{ asset('backend/assets/images/purple_box.png') }}" alt="shape" class="shape">
                    
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Select Employee</label>
                            <select name="user_id" id="employee-select" class="select-search" required>
                                @foreach(\App\Employee::where('account_id', Auth::user()->account_id)->get() as $key => $employee)
                                    <option value="{{ $employee->user_id }}">{{ $employee->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-12 padding_left">
                            <div id="roles">

                            </div>
                        </div>
                    </div>

                </div>
                                
            </div>

            <div class="col-xs-12 padding_0">
                <div class="text-center" style="background-color: transparent;box-shadow: none;">
                    
                    <button type="submit">Save</button>
                </div>
            </div>

        </form>
    </div>

@endsection

@section('script')

<script type="text/javascript">
    
    $(function() {
            $("#validate-form").validate();
            getUserPermissions($('#employee-select').val());
    });

    $('#employee-select').bind('change', function(){
        getUserPermissions($('#employee-select').val());
    });

    function getUserPermissions(user_id){

        $.post('{{ route('user_permissions.permissions') }}',{_token:'{{ csrf_token() }}', user_id:user_id}, function(data){
            
            $('#roles').html(data);

        });
    }

</script>

@endsection