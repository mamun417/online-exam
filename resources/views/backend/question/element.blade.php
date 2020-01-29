<div class="row">
    <div class="col-sm-6">

        <div class="form-group">
            <label>Question<span class="required-star"> *</span></label>
            <input type="text" placeholder="Type question" value="{{ isset($question->question) ? $question->question : old('question')}}" name="question" class="form-control">
            @error('question') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Department<span class="required-star"> *</span></label>
            <select class="form-control" name="department_id">
                <option value="">Select Department</option>
                @foreach($departments as $department )
                    <option @if( isset($question) and $question->department_id == $department->id) selected @endif value="{{ $department->id }}">
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Subject<span class="required-star"> *</span></label>
            <select class="form-control" name="subject_id">

                <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option @if( isset($question) and $question->subject_id == $subject->id) selected @endif value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach

            </select>
            @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Type<span class="required-star"> *</span></label>
            <select class="form-control" name="question_type_id">
                <option value="">Select Question Type</option>
                @foreach($question_types as $question_type)
                    <option @if( isset($question) and $question->question_type_id == $question_type->id) selected @endif value="{{ $question_type->id }}">{{ $question_type->name }}</option>
                @endforeach
            </select>
            @error('question_type_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
        </div>


        <div class="form-group">
            <label>Description</label>
            <textarea name="description" id="textarea2" class="form-control" rows="2">{{ isset($question->description) ? $question->description : old('description')}} </textarea>
            @error('description') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="hidden" name="oldImage" value="{{ isset($question->image) ? $question->image :''}}">
            <input type="file" name="img" class="form-control">
            @error('img') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
            @if(!empty($question->image))
                <img src="{{ asset('backend/uploads/images/question/'.$question->image) }}" style="margin-top:10px" width="80" height="100">
            @endif
        </div>

    </div>

    <div class="col-sm-6">

        <div class="form-group">
            <label>&nbsp;</label>
            <div>
                <button id="addMoreOption" type="button" class="btn btn-primary" style="margin-bottom: 0;"><i class="fa fa-plus"></i> Add Option</button>
            </div>
        </div>

        <div class="row">
            <div id="optionsSection">

                <?php
                    $single_option = '<div class="single-option">';
                    $single_option .= '<div class="col-sm-6">';
                    $single_option .= '<div class="form-group" id="tokenize-select">';
                    $single_option .= '<label>Option</label>';
                    $single_option .= '<select class="form-control options" name="test.options[]" multiple>';
                    foreach($options as $option){
                        $single_option .= '<option value='.$option->id.'>'.$option->option.'</option>';
                    }
                    $single_option .= '</select>';
                    $single_option .= '</div>';
                    $single_option .= '</div>';

                    $single_option .= '<div class="col-sm-4">';
                    $single_option .= '<div class="form-group">';
                    $single_option .= '<label>Answer</label>';
                    $single_option .= '<div class="correct_ans">';
                    $single_option .= '<label class="checkbox-inline i-checks"> <input name="correct_ans[]" type="radio" value="1"> True </label>';
                    $single_option .= '<label class="checkbox-inline i-checks"> <input name="correct_ans[]" type="radio" value="0"> False </label>';
                    $single_option .= '</div>';
                    $single_option .= '</div>';
                    $single_option .= '</div>';

                    $single_option .= '<div class="col-sm-2">';
                    $single_option .= '<br>';
                    $single_option .= '<button onclick="removeOption(this)" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>';
                    $single_option .= '</div>';
                    $single_option .= '</div>';
                ?>

                {{--{!! $single_option !!}--}}

            </div>
        </div>
    </div>

</div>

@section('custom-js')
    <script>

        $('.options').tokenize2({
            placeholder: "Type here...",
            displayNoResultsMessage: true,
            tokensAllowCustom: true,
            sortable: true,
            tokensMaxItems: 1,
        });

        /*$('.options').tokenize2({
            dataSource: function(term, object){

                $.get('', {term:term}, function (response) {
                    object.trigger('tokenize:dropdown:fill', [response]);
                });
            },

            placeholder: "Type your option",
            searchFromStart: false,
            displayNoResultsMessage: true,
            noResultsMessageText: "No results mached '%s'"
        });*/

        $('#addMoreOption').click(function () {

            $('#optionsSection').append('{!! $single_option !!}');

            $('.options').tokenize2({
                placeholder: "Type here...",
                displayNoResultsMessage: true,
                tokensAllowCustom: true,
                sortable: true,
                tokensMaxItems: 1,
            });

            //correct ans name
            $('.single-option').each(function (index, element) {
                $(element).find('.correct_ans').find('input[type="radio"]').attr('name', 'correct_ans['+index+']')
            });
        });

        // Delete Single Option
        function removeOption(e){
            var target_option = $(e).parents('.single-option');
            $(target_option).hide("fast", function(){  $(target_option).remove(); });
        }

    </script>
@endsection
