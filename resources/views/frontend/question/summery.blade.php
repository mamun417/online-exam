@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('study.select-subject') }}">Practice</a>
                </li>
                <li class="active">
                    <strong>Summery</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Summery Details</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="badge badge-success">{{ $subject->name }}</span>
                                        Subject Name
                                    </li>
                                    <li class="list-group-item ">
                                        <span class="badge badge-info">{{ count($total_questions) }}</span>
                                        Total Question
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge badge-primary">{{ $right_answer }}</span>
                                        Right Answer
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge badge-danger">{{ $wrong_answer }}</span>
                                        Wrong Answer
                                    </li>
                                </ul>
                            </div>

                            @php($i=1)
                            <div class="col-sm-8">
                                @foreach($total_questions->chunk(2) as $k => $questions)
                                    <div class="row">
                                        @foreach($questions as $question)
                                            <div class="col-sm-6">
                                                <div class="form-group {{ $question->is_correct_answer ? '' : 'error_answer' }}">
                                                    <label class="m-b-sm" style="font-size: 14px"><b>{{ $i }}.</b> {{ $question->question }}</label>
                                                    @foreach($question->options as $option)
                                                        <div class="i-checks {{ in_array($option->id, $question->original_answer) ? 'text-primary' : (in_array($option->id, $question->student_answer) ? 'text-danger' : '') }}">
                                                            <label>
                                                                <input {{ in_array($option->id, $question->student_answer) ? 'checked' : '' }} type="checkbox">
                                                                <i></i> {{ $option->option }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @php($i++)
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
