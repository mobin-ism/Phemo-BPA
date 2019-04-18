<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>{{__('web.name')}}</th>
                    <th>{{__('web.email')}}</th>
                    <th>{{__('web.role')}}</th>
                    <th>{{__('web.time')}}</th>
                    <th>{{__('web.ip')}}</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{__('web.'.$user->role)}}</td>
                            <td>{{$user->last_login_at}}</td>
                            <td>{{$user->last_login_ip}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-footer').hide();
    });
</script>