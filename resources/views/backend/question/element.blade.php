<div class="form-group">
    <label class="col-lg-2 control-label">Question<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{ isset($question->question) ? $question->question : old('question')}}" name="question" class="form-control">
        @error('question') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Department<span class="required-star"> *</span></label>
    <div class="col-lg-6">
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
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Subject<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <select class="form-control" name="subject_id">

            <option value="">Select Subject</option>
            @foreach($subjects as $subject)
                <option @if( isset($question) and $question->subject_id == $subject->id) selected @endif value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach

        </select>
        @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Question Type<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <select class="form-control" name="question_type_id">

            <option value="">Select Question Type</option>
            @foreach($question_types as $question_type)
                <option @if( isset($question) and $question->question_type_id == $question_type->id) selected @endif value="{{ $question_type->id }}">{{ $question_type->name }}</option>
            @endforeach

        </select>
        @error('question_type_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

 <div class="form-group">
    <label class="col-lg-2 control-label">Description</label>
    <div class="col-lg-6">
        <textarea name="description" id="textarea2" class="form-control" rows="5">{{ isset($question->description) ? $question->description : old('description')}} </textarea>
        @error('description') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Image</label>
    <div class="col-lg-6">
        <input type="hidden" name="oldImage" value="{{ isset($question->image) ? $question->image :''}}">
        <input type="file" name="img" class="form-control">
        @error('img') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
        @if(!empty($question->image))
            <img src="{{ asset('backend/uploads/images/question/'.$question->image) }}" style="margin-top:10px" width="80" height="100">
        @endif
    </div>
</div>
