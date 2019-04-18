<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>Phemo | {{__('web.reset_password')}}</title>
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
                <span>{{__('Do not have an account?')}}</span>
                <a href="{{route('register')}}" class="m-link m--font-danger">{{__('Sign Up')}}</a>
            </div>

            <!--end::Head-->

            <!--begin::Body-->
            <div class="m-login__body">
                
                <!--begin::Signin-->
                <div class="m-login__signin">
                    {{--<div class="m-login__title">--}}
                        {{--<h3>{{__('Sign In')}}</h3>--}}
                    {{--</div>--}}
                    
                    <div class="m-login__logo">
                        <a href="">
                            <img src="{{asset('public/backend/assets/images/phemo_white.png')}}" width="200">
                        </a>
                    </div>

                    <!--begin::Form-->
                    <form class="m-login__form m-form" action="{{ route('password.request') }}" method="post" id="">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group m-form__group @if ($errors->has('email')) has-danger @endif">
                            <input class="form-control m-input" type="email" placeholder="{{__('Email')}}" 
                                name="email" autocomplete="off" value="{{ $email or old('email') }}" required>
                            @if ($errors->has('email'))
                            <div class="form-control-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group m-form__group @if ($errors->has('password')) has-danger @endif">
                            <input class="form-control m-input" type="password" placeholder="{{__('Password')}}" 
                                name="password" autocomplete="off" required>
                            @if ($errors->has('password'))
                            <div class="form-control-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group m-form__group @if ($errors->has('password_confirmation')) has-danger @endif">
                            <input class="form-control m-input" type="password" placeholder="{{__('Confirm Password')}}" 
                                name="password_confirmation" autocomplete="off" required>
                            @if ($errors->has('password_confirmation'))
                            <div class="form-control-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                            @endif
                        </div>
                        <div class="m-login__action">
                            <button type="submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                {{__('Reset Password')}}
                            </button>
                        </div>
                    </form>

                    <!--end::Form-->
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

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>


