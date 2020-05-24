@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('practice.select-subject') }}">Subjects</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">

            @include('flash-messages.flash-messages')

            @if(count($subjects) > 0)
                @foreach($subjects as $subject)
                    <a href="{{ route('video.video-list', $subject->code) }}" class="color-success">
                        <div class="col-lg-3">
                            <div class="ibox">
                                <div class="ibox-content" style="border-style: none!important;">
                                    <h3 style="color: black">{{ $subject->name }}</h3>
                                    <div class="stat-percent font-bold text-navy">{{ $subject->videos_count }} <i
                                            class="fa fa-file-video-o"></i></div>
                                    <span style="color: black">Total Videos</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="alert alert-warning">
                    No subject found in your faculty
                </div>
            @endif
        </div>
    </div>
@endsection


