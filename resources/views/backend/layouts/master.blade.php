<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Medi-Spark</title>

    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/plugins/iCheck/custom.css')}}" rel="stylesheet">

    {{--<link href="{{asset('backend/css/animate.css')}}" rel="stylesheet">--}}

    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('backend/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    {{--sweet alert--}}
    <link href="{{ asset('backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    {{--Tokenize2--}}
    <link href="{{ asset('backend/js/extra-plugin/tokenize2/tokenize2.min.css') }}" rel="stylesheet">

    {{--Date timepicker--}}
    <link href="{{ asset('backend/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">

    {{--custom style--}}
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

<!-- Custom and plugin javascript -->
<script src="{{ asset('backend/js/inspinia.js') }}"></script>
<script src="{{ asset('backend/js/plugins/pace/pace.min.js')}}"></script>

<!-- Data picker -->
<script src="{{ asset('backend/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

<!-- iCheck -->
<script src="{{ asset('backend/js/plugins/iCheck/icheck.min.js') }}"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="{{ asset('backend/js/plugins/fullcalendar/moment.min.js') }}"></script>

<!-- Date range picker -->
<script src="{{ asset('backend/js/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('backend/js/plugins/toastr/toastr.min.js') }}"></script>

{{--Sweetalert--}}
<script src="{{ asset('backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

{{--Tokenize2--}}
<script src="{{ asset('backend/js/extra-plugin/tokenize2/tokenize2.min.js') }}"></script>

<script>

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

<script>
        $(document).ready(function(){

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });


        });


    </script>

@yield('custom-js')

</body>
</html>
