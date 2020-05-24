<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('admin/img/favicon.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('admin/img/favicon.png') }}" />
    <title>MedMission - First Medical Online Course Preparation Portal</title>
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    {{--Social icon--}}
    <link href="{{ asset('admin/css/plugins/bootstrapSocial/bootstrap-social.css') }}" rel="stylesheet">

    @stack('extra-css')

    <style>
        body{
            color: black;
        }
        .ibox-content{
            border-style: none;
            box-shadow: 1px 0 20px rgba(0,0,0,.08);
        }
    </style>

</head>
<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            @yield('content')
        </div>
    </div>
</body>

<script src="{{ asset('admin/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>

<!-- iCheck -->
<script src="{{ asset('admin/js/plugins/iCheck/icheck.min.js') }}"></script>

@yield('custom-js')

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>

</html>
