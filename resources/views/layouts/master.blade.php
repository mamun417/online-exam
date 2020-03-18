<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Medical-Spark</title>

    <!--fontowsome-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
   <!-- <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">-->
    <link href="{{ asset('admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">

    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('admin/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    {{--sweet alert--}}
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    {{--Tokenize2--}}
    <link href="{{ asset('admin/js/extra-plugin/tokenize2/tokenize2.min.css') }}" rel="stylesheet">

    {{--Datetime picker--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    {{--Editor --}}
    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet">

    {{--custom style--}}
    <link href="{{ asset('admin/css/custom_style.css') }}" rel="stylesheet">

    <!--time circle-->
    <link href="{{ asset('admin/js/plugins/time-circles/TimeCircles.css') }}" rel="stylesheet">

    <!--summernote editor-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">

</head>
<body>

<div id="wrapper">
    @include('element.sidebar')
</div>

<div id="page-wrapper" class="gray-bg">

    @include('element.header')

    @yield('content')

    @include('element.footer')

</div>

<script src="{{ asset('admin/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('admin/js/inspinia.js') }}"></script>
<script src="{{ asset('admin/js/plugins/pace/pace.min.js')}}"></script>


<!-- iCheck -->
<script src="{{ asset('admin/js/plugins/iCheck/icheck.min.js') }}"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="{{ asset('admin/js/plugins/fullcalendar/moment.min.js') }}"></script>

<!-- Date range picker -->
<script src="{{ asset('admin/js/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('admin/js/plugins/toastr/toastr.min.js') }}"></script>

{{--Sweetalert--}}
<script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

{{--Tokenize2--}}
<script src="{{ asset('admin/js/extra-plugin/tokenize2/tokenize2.min.js') }}"></script>

{{--Datetime picker--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript" src="{{ asset('admin/js/plugins/time-circles/TimeCircles.js') }}"></script>

{{--Editor--}}
<script src="{{ asset('admin/js/plugins/summernote/summernote.min.js')}}"></script>

<script>

    /*summernote*/
    $(document).ready(function(){
        $('.summernote').summernote();
    });

    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    {{--toastr message--}}
    $(function () {

        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 2500
        };

        @if(session('successTMsg'))
        toastr.success('{{ session('successTMsg') }}');
        @endif

        @if(session('errorTMsg'))
        toastr.error('{{ session('errorTMsg') }}');
        @endif
    });

    //show confirm message when delete table row
    function deleteRow(rowId) {

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this item!",
            type: "warning",
            showCancelButton: true,
            allowOutsideClick: true,
            confirmButtonColor: "#1ab394",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: true
        }, function () {
            document.getElementById('row-delete-form'+rowId).submit();
        });
    }
</script>

@yield('custom-js')

</body>
</html>
