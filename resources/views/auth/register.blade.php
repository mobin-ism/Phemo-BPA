<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>Phemo | {{__('web.register')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="{{asset('public/login_assets/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
    <link href="{{asset('public/login_assets/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <link href="{{asset('public/login_assets/login.style.css')}}" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href="{{asset('public/backend/assets/images/favicon.ico')}}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="d-flex flex-column-reverse flex-md-row m-grid__item m-grid__item--fluid m-grid m-grid--desktop m-grid--ver-desktop m-grid--hor-tablet-and-mobile m-login m-login--6" id="m_login">
        <div class="m-grid__item   m-grid__item--order-tablet-and-mobile-2  m-grid m-grid--hor m-login__aside main-login-bg">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver">
                <div class="m-grid__item m-grid__item--middle">
                    <span class="m-login__title" style="font-family: 'Pacifico', cursive;">Meet Phemo</span>
                    <span class="m-login__title" style="font-family: 'Pacifico', cursive;">Made with SMME in mind</span>
                </div>
            </div>
            <div class="m-grid__item">
                <div class="m-login__info">
                    <div class="m-login__section">
                        <a href="#" class="m-link">&copy 2018 NDAMS (PTY) LIMITED</a>
                    </div>
                    <div class="m-login__section">
                        <a href="http://phemo.net/privacy" class="m-link" target="_blank">Privacy Policy</a>
                        <a href="http://phemo.net/terms" class="m-link" target="_blank">Terms of Use</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">

            <!--begin::Head-->
            <div class="m-login__head">
                <span>{{__('Already have an account?')}}</span>
                <a href="{{route('login')}}" class="m-link m--font-danger">{{__('Sign In')}}</a>
            </div>

            <!--end::Head-->

            <!--begin::Body-->
            <div class="m-login__body">

                <!--begin::Signin-->
                <div class="m-login__signin">
                    <div class="m-login__logo">
                        <a href="">
                            <img src="{{asset('public/backend/assets/images/phemo_white.png')}}" width="200">
                        </a>
                    </div>

                    <!--begin::Form-->
                    <form class="m-login__form m-form" action="{{route('accounts.register')}}" method="post" id="">
                        @csrf
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="{{__('Company Name')}}" name="company_name" autocomplete="off"
                                value="{{ old('company_name') }}">
                            <div class="form-control-feedback m--font-danger">
                                @if($errors->has('company_name')) {{$errors->first('company_name')}} @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="{{__('Full Name')}}" name="name" autocomplete="off"
                            value="{{old('name')}}">
                            <div class="form-control-feedback m--font-danger">
                                @if($errors->has('name')) {{$errors->first('name')}} @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="{{__('Email')}}" name="email" autocomplete="off"
                            value="{{old('email')}}">
                            <div class="form-control-feedback m--font-danger">
                                @if($errors->has('email')) {{$errors->first('email')}} @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="{{__('Password')}}" name="password">
                            <div class="form-control-feedback m--font-danger">
                                @if($errors->has('password')) {{$errors->first('password')}} @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="{{__('Confirm Password')}}" name="password_confirmation">
                            <div class="form-control-feedback m--font-danger">
                                @if($errors->has('password_confirmation')) {{$errors->first('password_confirmation')}} @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group mt-5">
                            <button type="submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                {{__('Create My Account')}}
                            </button>
                        </div>
                    </form>

                    <!--end::Form-->

                    <!--begin::Action-->
                    <p>
                        By proceeding, you agree to the <a href="http://phemo.net/terms">Terms of Use</a> and <a href="http://phemo.net/privacy">Privacy Policy</a>
                    </p>
                    <!--end::Action-->
                </div>
                <!--end::Signin-->
            </div>

            <!--end::Body-->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!--begin::Global Theme Bundle -->
<script src="{{asset('public/login_assets/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('public/login_assets/scripts.bundle.js')}}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts -->
{{-- <script src="{{asset('public/login_assets/register.js')}}" type="text/javascript"></script> --}}

<script>
    $(function () {
        @if(Session::has('success'))
        @php
            $str = Session::get('success');
        @endphp
        $.notify({
            title: 'Success',
            message: '{{ __($str) }}'
        },{
            type: 'success',
            timer: 2000,
            z_index: 10000,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            allow_dismiss: true
        });
        @endif
    });
</script>

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>