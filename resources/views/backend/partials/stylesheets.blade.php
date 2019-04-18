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
<link href="{{asset('public/backend/met-assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--RTL version:<link href="../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

<link href="{{asset('public/backend/met-assets/demo/demo6/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--RTL version:<link href="../../assets/demo11/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

<link href="{{asset('public/backend/met-assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--RTL version:<link href="../../../assets/vendors/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

<link rel="stylesheet" href="{{asset('public/backend/assets/custom/phemo.css')}}" type="text/css">

<link rel="stylesheet" href="{{asset('public/backend/assets/plugins/minicolors/jquery.minicolors.css')}}" type="text/css">

<!--end::Global Theme Styles -->
<link rel="shortcut icon" href="{{asset('public/backend/assets/images/favicon.ico')}}" />