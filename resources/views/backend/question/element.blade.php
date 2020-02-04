<div class="row">
    <div class="col-sm-6">

        <div class="form-group">
            <label>Question Name<span class="required-star"> *</span></label>
            <select class="form-control" name="question_template_id">

                <option value="">Select Question Name</option>
                @foreach($questionNames as $questionName)
                    <option @if( isset($question) and $question->question_template_id == $questionName->id) selected @endif value="{{ $questionName->id }}">{{ $questionName->name}}</option>
                @endforeach

            </select>
            @error('question_template_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Question<span class="required-star"> *</span></label>
            <input type="text" placeholder="Question" value="{{ isset($questions->question) ? $questions->question : old('question')}}" name="question" class="form-control">
            @error('question') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
        </div>
        
        <div class="form-group">
            <label>Question Type<span class="required-star"> *</span></label>
            <select class="form-control" name="question_type_id">

                <option value="">Select Question Type</option>
                @foreach($questionTypes as $questionType)
                    <option @if( isset($question) and $question->question_type_id == $questionType->id) selected @endif value="{{ $questionType->id }}">{{ $questionType->name}}</option>
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

        <div class="form-group" style="margin-bottom: 14px">
            <label>&nbsp;</label>
            <div>
                <button id="addMoreOption" type="button" class="btn btn-primary" style="margin-bottom: 0;"><i class="fa fa-plus"></i> Add Option</button>
            </div>
        </div>

        <div class="row">
            <div id="optionsSection">

                @foreach($question_options as $key => $question_option)

                    <?php
                        $single_option = '<div class="single-option">';
                        $single_option .= '<div class="col-sm-6">';
                        $single_option .= '<div class="form-group" id="tokenize-select">';
                        $single_option .= '<label>Option</label>';
                        $single_option .= '<select class="form-control options" name="options[]" multiple>';
                        foreach($options as $option){
                            $selected = (isset($question_option->id) && $question_option->id == $option->id)?'selected':'';
                            $single_option .= '<option '.$selected.' value='.$option->id.'>'.$option->option.'</option>';
                        }
                        $single_option .= '</select>';
                        $single_option .= '</div>';
                        $single_option .= '</div>';

                        $single_option .= '<div class="col-sm-6">';
                        $single_option .= '<div class="form-group">';
                        $single_option .= '<label>Answer</label>';
                        $single_option .= '<div class="correct_ans">';
                        $true_check = isset($question_option->id) ? ($question_option->pivot->correct_answer === '1' ? 'checked' : '') : '';
                        $false_check = isset($question_option->id) ? ($question_option->pivot->correct_answer === '0' ? 'checked' : '') : '';
                        $single_option .= '<label class="checkbox-inline i-checks"> <input '.$true_check.' name="correct_ans['.$key.']" type="radio" value="1"> True </label>';
                        $single_option .= '<label class="checkbox-inline i-checks"> <input '.$false_check.' name="correct_ans['.$key.']" type="radio" value="0"> False </label>';
                        $single_option .= '<button onclick="removeOption(this)" type="button" class="btn btn-danger btn-circle" style="margin-left: 20px;"><i class="fa fa-times"></i></button>';
                        $single_option .= '</div>';
                        $single_option .= '</div>';
                        $single_option .= '</div>';
                        $single_option .= '</div>';
                    ?>

                    @if(Route::currentRouteName() === 'questions.edit' && isset($question_option->id))
                        {!! $single_option !!}
                    @endif

                @endforeach

            </div>
        </div>
    </div>

</div>

@section('custom-js')
    <script>

        @if(Route::currentRouteName() === 'questions.edit' && isset($question_option->id))
            $(function(){
                $('.options').tokenize2({

                    dataSource: function(term, object){
                        $.get('{{ route('get-option-list') }}', {term:term}, function (option_list) {
                            object.trigger('tokenize:dropdown:fill', [option_list]);
                        });
                    },

                    placeholder: "Type here...",
                    //displayNoResultsMessage: true,
                    tokensAllowCustom: true,
                    sortable: true,
                    tokensMaxItems: 1,
                });
            });
        @endif

        $('#addMoreOption').click(function () {

            $("#optionsSection").find('.correct_ans').find('input[type=radio]').removeAttr('name');

            $('#optionsSection').append('{!! $single_option !!}').find('select').last().val('');

            $('.options').tokenize2({

                dataSource: function(term, object){
                    $.get('{{ route('get-option-list') }}', {term:term}, function (option_list) {
                        object.trigger('tokenize:dropdown:fill', [option_list]);
                    });
                },

                placeholder: "Type here...",
                //displayNoResultsMessage: true,
                tokensAllowCustom: true,
                sortable: true,
                tokensMaxItems: 1
            });

            // correct_ans naming
            $('.single-option').each(function (index, element) {
                $(element).find('.correct_ans').find('input[type="radio"]').attr('name', 'correct_ans['+index+']')
            });

            // reload radio style
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });

        // Delete Single Option
        function removeOption(e){

            var target_option = $(e).parents('.single-option');
            $(target_option).hide("fast", function(){  $(target_option).remove(); });

            // correct_ans naming
            $('.single-option').each(function (index, element) {
                $(element).find('.correct_ans').find('input[type="radio"]').attr('name', 'correct_ans['+index+']')
            });
        }

    </script>
@endsection
