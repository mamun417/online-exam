<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | E-commerce</title>

    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{asset('backend/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/custom_style.css') }}" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    @include('backend.element.sidebar')
</div>
<div id="page-wrapper" class="gray-bg">
    @include('backend.element.header')
    @yield('content')
    @include('backend.element.footer')
</div>

<script src="{{ asset('backend/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Peity -->
<script src="{{asset('backend/js/plugins/peity/jquery.peity.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('backend/js/inspinia.js') }}"></script>
<script src="{{asset('backend/js/plugins/pace/pace.min.js')}}"></script>

<!-- iCheck -->
<script src="{{asset('backend/js/plugins/iCheck/icheck.min.js')}}"></script>
<!-- Peity -->
<script src="{{asset('backend/js/demo/peity-demo.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>
</html>
