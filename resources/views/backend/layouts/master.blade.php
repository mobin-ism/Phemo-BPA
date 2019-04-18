<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<title>Phemo</title>
        @include('backend.partials.metas')
        @include('backend.partials.stylesheets')
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default ">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
            @include('backend.partials.header')
			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				@include('backend.partials.navigation')
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
                        @yield('content')
                    </div>
				</div>
			</div>
            @include('backend.partials.footer')
		</div>
		@include('backend.partials.sidebar')
		<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->
        @include('backend.partials.javascripts')
        @include('backend.partials.modal')

        <script>
            $(function () {
                @if(Session::has('success'))
                @php
                    $str = 'web.'.Session::get('success');
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
                @if(Session::has('error'))
                @php
                    $str = 'web.'.Session::get('error');
                @endphp
                $.notify({
                    title: 'Error',
                    message: '{{ __($str) }}'
                },{
                    type: 'danger',
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
    
            function notify(message, type) {
                $.notify({
                    message: message
                },{
                    type: type,
                    timer: 2000,
                    z_index: 10000,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    },
                    allow_dismiss: true
                });
            }
        </script>
        @yield('script')

	</body>

	<!-- end::Body -->
</html>
