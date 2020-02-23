@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('study.select-subject') }}">Study</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-title">
                        <h5>Select Subject</h5>
                    </div>

                    <div class="ibox-content">

                        @include('flash-messages.flash-messages')

                        <form class="form-horizontal" method="POST" action="{{ route('study.select-subject') }}">
                            @csrf

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Subject<span class="required-star"> *</span></label>
                                    <select class="form-control" name="subject_id">

                                        <option value="">Select</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    <button class="btn btn-sm btn-primary pull-left m-t-n-xs" type="submit">
                                        <strong>Next</strong>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


