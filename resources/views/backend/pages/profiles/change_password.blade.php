<form method="post" id="modal-form" action="{{ route('profiles.update_password') }}">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="current_password-group">
                <label for="current-password">
                    * {{__('web.current_password')}}
                </label>
                <input type="password" class="form-control m-input m-input--pill" id="current-password" name="current_password">
            </div>
            <div class="form-group m-form__group" id="password-group">
                <label for="password">
                    * {{__('web.new_password')}}
                </label>
                <input type="password" class="form-control m-input m-input--pill" id="password" name="password">
            </div>
            <div class="form-group m-form__group" id="password_confirmation-group">
                <label for="confirm-password">
                    * {{__('web.confirm_password')}}
                </label>
                <input type="password" class="form-control m-input m-input--pill" id="confirm-password" name="password_confirmation">
            </div>
        </div>
    </div>
</form>