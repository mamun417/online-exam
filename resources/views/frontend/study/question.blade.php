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

                    <div class="ibox-title">
                        <h5>Select Your Answer</h5>
                        <a onclick="finishedStudy()" href="javascript:void(0)" class="btn btn-sm btn-danger pull-right m-t-n-xs" type="button">
                            <strong>Finished</strong>
                        </a>
                        <form id="finished-form" method="POST" action="{{ route('study.finished') }}" style="display: none" >
                            @csrf()
                        </form>
                    </div>

                    <div class="ibox-content">

                        @include('flash-messages.flash-messages')

                        @if(!Session::get('limit_cross'))
                            <form onsubmit="submitQuestionForm(this)" action="{{ route('study.question.submit') }}" method="POST" class="form-horizontal">
                                @csrf

                                <input name="question_id" value="{{ $question->id }}" type="hidden">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="m-b-sm" style="font-size: 14px">{{ $question->question }}</label>
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
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <button class="btn btn-sm btn-primary pull-left m-t-n-xs m-r-xs" style="width: 80px" type="submit">
                                            <strong>Next</strong>
                                        </button>

                                        {{--<a href="" class="btn btn-sm btn-info pull-left m-t-n-xs" type="button">
                                            <strong>Skip</strong>
                                        </a>--}}
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
                text: "You want to finished yor study for today!",
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

