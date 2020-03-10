@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('practice.select-subject') }}">Exam</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Exam</h5>
                    </div>

                    <div class="ibox-content">
                        @include('flash-messages.flash-messages')
                        @if(!Session::get('limit_cross'))
                            @isset($start_exam)
                                <div class="row">
                                    <div class="col-sm-4">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <span class="badge badge-success">{{ $exam_notification->template->subject->name }}</span>
                                                Subject Name
                                            </li>
                                            <li class="list-group-item ">
                                                <span class="badge badge-info">{{ $exam_notification->template->total_questions }}</span>
                                                Total Question
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge badge-primary">{{ $exam_notification->template->total_marks }}</span>
                                                Full Marks
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge badge-danger">{{ $exam_notification->template->negative_marks }}</span>
                                                Negative Mark/Question
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge badge-warning">{{ $exam_notification->duration }} hours</span>
                                                Duration
                                            </li>
                                        </ul>
                                        <a href="{{ route('examination.start', $exam_notification->id) }}" class="btn btn-sm btn-primary m-t-n-xs" style="width: 100%">
                                            <strong>Start Exam</strong>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="example" data-date="{{ $exam_notification->start_date }}" style="width: 500px; height: 150px;"></div>
                                <p>Your exam english will be held on {{ $exam_notification->start_date->format('d-m-Y h:i A') }}. Please be prepared for your online exam.</p>
                            @endisset
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $(".example").TimeCircles({count_past_zero: false}).addListener(countdownComplete);

        function countdownComplete(unit, value, total){
            if(total <= 0){
                setTimeout(location.reload.bind(location), 1000);
            }
        }
    </script>
@endsection


