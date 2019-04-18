<form method="post" id="modal-form" action="{{route('scompanies.update_credentials')}}">
    @csrf
    {{ Form::hidden('role', $user->role) }}
    {{ Form::hidden('user_id', $user->id) }}
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="email-group">
                <label for="email">
                    * {{__('web.email')}}
                </label>
                <input type="email" class="form-control m-input m-input--pill" id="email" name="email"
                    value="{{$user->email}}">
                    <br>
                <span class="m-form__help text-muted">
                    Before changing the email, please make sure you really want to change the email for a very important reason. However, the email you enter,
                    if there is already an user with the email the changes will not be saved.
                </span>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="password">
                    {{__('web.password')}}
                </label>
                <input type="password" class="form-control m-input m-input--pill" id="password" name="password">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="confirm-password">
                    {{__('web.confirm_password')}}
                </label>
                <input type="password" class="form-control m-input m-input--pill" id="confirm-password" name="confirm_password">
            </div>
        </div>
    </div>
</form>