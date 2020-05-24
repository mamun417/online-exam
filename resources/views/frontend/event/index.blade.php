@extends('layouts.master')

@push('extra-links')

    <link href={{ asset('full_calender/packages/core/main.css') }} rel='stylesheet' />
    <link href={{ asset('full_calender/packages/daygrid/main.css') }} rel='stylesheet' />
    <link href={{ asset('full_calender/packages/tooltip/tooltip.css') }} rel='stylesheet' />
    <script src={{ asset('full_calender/packages/core/main.js') }}></script>
    <script src={{ asset('full_calender/packages/interaction/main.js') }}></script>
    <script src={{ asset('full_calender/packages/daygrid/main.js') }}></script>

    <script src={{ asset('full_calender/packages/tooltip/popper.min.js') }}></script>
    <script src={{ asset('full_calender/packages/tooltip/tooltip.min.js') }}></script>

    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        .tooltip-inner{
            background-color: #FFC107;
        }
        .tooltip{
            opacity: 1;
        }
        .tooltip-inner{
            color: black!important;
        }
        .fc-button{
            padding: 0 0.6em;
        }
    </style>
@endpush

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Routine</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-sm-12">

                                @include('flash-messages.flash-messages')

                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid' ],
                //defaultDate: '2020-03-12',
                //editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: {!! $events !!},
                eventRender: function(info) {
                    var tooltip = new Tooltip(info.el, {
                        title: info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                }
            });

            calendar.render();
        });

    </script>
@endsection

