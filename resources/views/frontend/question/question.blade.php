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

                    @php
                        $question_paper_info = Session::get('question_paper_info');
                        $question_paper_type = substr(Route::currentRouteName(), 0, strpos(Route::currentRouteName(), "."));
                        $total_question = count($question_paper_info['generated_question_ids'])+$question_paper_info['question_quantity'];
                        $generated_question_count = count($question_paper_info['generated_question_ids']);
                        $progress = (($generated_question_count-1)/$total_question)*100;
                    @endphp

                    <div class="ibox-title">
                        <h5>Select Your Answer</h5>
                        <a onclick="finishedStudy()" href="javascript:void(0)" class="btn btn-sm btn-danger pull-right m-t-n-xs" type="button">
                            <strong>Cancel</strong>
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

                                    @if($question_paper_info['question_paper_type'] == 'examination')
                                        <div class="progress progress-striped active">
                                            <div style="width: {{ $progress }}%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="{{ $progress }}" role="progressbar" class="progress-bar progress-bar">
                                                <span class="">{{ $progress }}% Complete</span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group">

                                        <label class="m-b-sm" style="font-size: 14px">
                                            <b>{{ $generated_question_count }}.</b>
                                            {{ $question->question }}
                                        </label>
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

                                    @if($question->description)
                                        <label>
                                            <u>Explanation:</u>  <?php echo $question->description ?>
                                        </label><br><br>
                                    @endif

                                    @if($question->image)
                                        <label>
                                            <img src="{{ asset('admin/uploads/images/question/'.$question->image) }}" style="height: 150px; width: 150px" class="">
                                        </label><br><br>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-sm btn-primary pull-left m-t-n-xs m-r-xs" style="width: 80px" type="submit">
                                            <strong>Next</strong>
                                        </button>

                                        @if($question_paper_info['question_paper_type'] == 'practice' || $question_paper_info['question_paper_type'] == 'examination')
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
                //text: "You want to cancel!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                allowOutsideClick: true,
                confirmButtonColor: "#1ab394",
                confirmButtonText: "Yes",
                closeOnConfirm: true
            }, function () {
                document.getElementById('finished-form').submit();
            });
        }
    </script>
@endsection

