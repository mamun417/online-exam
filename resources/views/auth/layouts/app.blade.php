<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>medi-spark</title>
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    {{--Social icon--}}
    <link href="{{ asset('admin/css/plugins/bootstrapSocial/bootstrap-social.css') }}" rel="stylesheet">

</head>
<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            @yield('content')
        </div>
        <hr/>
    </div>
</body>
</html>
