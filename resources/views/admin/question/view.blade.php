 @extends('layouts.master')

@section('content')
     <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Question View</h2>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
                <a href="{{ route('questions.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-content">

                        <p><b>Question: </b> {{ $question->question }}</p>
                        <p><b>Template Name: </b> {{ $question->template->name }}</p>
                        <p><b>Question Type: </b> {{ $question->questionType->name }}</p>
                        <p><b>Created At: </b> {{ $question->created_at }}</p>
                        <p><b>Description: </b> {{ $question->description }}</p>
                        <p><b>Image:</b></p> <p><img src="{{ asset('admin/uploads/images/question/'.$question->image) }}" style="margin:10px 10px 10px 50px; " width="300" height="200"></p>

                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-content">
                        <p><b>Options: </b></p>
                        @foreach($question_options as $key => $question_option)

                            <p style="margin-left: 50px">{{++$key.'.  '.$question_option->option }}{{ $question_option->correct_answer == 1 ? ' C':'' }}</p>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
