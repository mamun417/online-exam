@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('practice.select-subject') }}">Examination</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Examination</h5>
                    </div>

                    <div class="ibox-content">
                        @include('flash-messages.flash-messages')
                        @if(!Session::get('limit_cross'))
                            @isset($start_exam)
                                <a href="{{ route('examination.start') }}" class="btn btn-sm btn-success m-t-n-xs" type="button">
                                    <strong>Start</strong>
                                </a>
                            @else
                                <p>Your exam english will be held on {{ $exam_notification->start_date->format('d-m-Y h:i A') }}. Please be prepared for your online exam.</p>
                            @endisset
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


