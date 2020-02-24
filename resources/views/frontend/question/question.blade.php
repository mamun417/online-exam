@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('study.select-subject') }}">Study</a>
                </li>
                <li class="active">
                    <strong>Question</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    @php($question_paper_type = substr(Route::currentRouteName(), 0, strpos(Route::currentRouteName(), ".")))

                    <div class="ibox-title">
                        <h5>Select Your Answer</h5>
                        <a onclick="finishedStudy()" href="javascript:void(0)" class="btn btn-sm btn-danger pull-right m-t-n-xs" type="button">
                            <strong>Finished</strong>
                        </a>
                        <form id="finished-form" method="POST" action="{{ route($question_paper_type.'.question.finished') }}" style="display: none" >
                            @csrf()
                        </form>
                    </div>

                    <div class="ibox-content">

                        @include('flash-messages.flash-messages')

                        @if(!Session::get('limit_cross'))
                            <form onsubmit="submitQuestionForm(this)" action="{{ route($question_paper_type.'.question.submit') }}" method="POST" class="form-horizontal">
                                @csrf

                                <input name="question_id" value="{{ $question->id }}" type="hidden">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="m-b-sm" style="font-size: 14px"><b>{{ count(Session::get('question_paper_info')['generated_question_ids']) }}.</b> {{ $question->question }}</label>
                                        @foreach($question_options as $option)
                                            <div class="i-checks {{ in_array($option->id, $correct_answers) ? 'text-primary' : (in_array($option->id, $student_answer) ? 'text-danger' : '') }}">
                                                <label>
                                                    <input name="options[]" value="{{ $option->id }}" {{  in_array($option->id, $student_answer) ? 'checked' : '' }} type="checkbox">
                                                    <i></i> {{ $option->option }}
                                                </label>
                                            </div>
                                        @endforeach
                                        @error('options') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-sm btn-primary pull-left m-t-n-xs m-r-xs" style="width: 80px" type="submit">
                                            <strong>Next</strong>
                                        </button>

                                        @if(Session::get('question_paper_info')['question_paper_type'] == 'practice' || Session::get('question_paper_info')['question_paper_type'] == 'examination')
                                            <a href="" class="btn btn-sm btn-info pull-left m-t-n-xs" type="button" style="width: 80px">
                                                <strong>Skip</strong>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script>

        if(performance.navigation.type === 2){
            location.reload(true);
        }

        function submitQuestionForm(e){
            event.preventDefault();
            if($('input[name="options[]"]:checked').length === 0){
                alert('You have to select at least one option.');
                return false;
            }
            e.submit();
        }

        //show confirm message when delete table row
        function finishedStudy() {
            swal({
                title: "Are you sure?",
                text: "You want to finished yor "+'{{ $question_paper_type }}'+" for today!",
                type: "warning",
                showCancelButton: true,
                allowOutsideClick: true,
                confirmButtonColor: "#1ab394",
                confirmButtonText: "Yes, finished study!",
                closeOnConfirm: true
            }, function () {
                document.getElementById('finished-form').submit();
            });
        }
    </script>
@endsection

