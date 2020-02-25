@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('practice.select-subject') }}">Practice</a>
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

                        <form class="form-horizontal" method="POST" action="{{ route('practice.select-subject') }}">
                            @csrf

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>Subject<span class="required-star"> *</span></label>
                                    <select class="form-control" name="subject_id">
                                        <option value="">Select</option>
                                        @foreach($subjects as $subject)
                                            <option {{ old('subject_id') == $subject->id ? 'selected':'' }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label>Number Of Question<span class="required-star"> *</span></label>
                                    <select class="form-control" name="question_quantity">
                                        <option value="">Select</option>
                                        <option value="25" {{ old('question_quantity') == 25 ? 'selected':'' }} >25</option>
                                        <option value="50" {{ old('question_quantity') == 50 ? 'selected':'' }} >50</option>
                                        <option value="75" {{ old('question_quantity') == 75 ? 'selected':'' }} >75</option>
                                        <option value="100" {{ old('question_quantity') == 100 ? 'selected':'' }} >100</option>
                                        <option value="150" {{ old('question_quantity') == 150 ? 'selected':'' }} >150</option>
                                    </select>
                                    @error('question_quantity') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
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


