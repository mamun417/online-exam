
<div class="form-group">
    <label class="col-lg-2 control-label">Department<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <select selected class="form-control" name="department_id">

            <option value="" >Select Deparment</option>
            @foreach($departments as $department )
               <option @if( isset($questionTemplate) and $questionTemplate->department_id ==    $department->id) selected @endif value="{{ $department->id }}">
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
        <select selected class="form-control" name="subject_id">

            <option value="">Select Subject</option>
            @foreach($subjects as $subject)
                <option @if( isset($questionTemplate) and $questionTemplate->subject_id == $subject->id) selected @endif value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach

        </select>
        @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Question Type<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <select selected class="form-control" name="question_type_id">

            <option value="">Select Question Type</option>
            @foreach($questionTypes as $questionType)
                <option @if( isset($questionTemplate) and $questionTemplate->question_type_id == $questionType->id) selected @endif value="{{ $questionType->id }}">{{ $questionType->name }}</option>
            @endforeach

        </select>
        @error('question_type_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Total Questions<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="number" value="{{ isset($questionTemplate->total_questions) ? $questionTemplate->total_questions : old('total_questions')}}" name="total_questions" class="form-control">
        @error('total_questions') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div> 

 <div class="form-group">
    <label class="col-lg-2 control-label">Total Marks<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="number" value="{{ isset($questionTemplate->total_marks) ? $questionTemplate->total_marks : old('total_marks')}}" name="total_marks" class="form-control">
        @error('total_marks') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div> 

 <div class="form-group">
    <label class="col-lg-2 control-label">Negative Marks<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input step="0.01" type="number" value="{{ isset($questionTemplate->negative_marks) ? $questionTemplate->negative_marks : old('negative_marks')}}" name="negative_marks" class="form-control">
        @error('negative_marks') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div> 


