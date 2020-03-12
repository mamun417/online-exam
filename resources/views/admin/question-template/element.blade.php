<div class="col-lg-7">
    <div class="form-group">
        <label>Exam Name<span class="required-star"> *</span></label>
        <input type="text" value="{{ isset($questionTemplate->name) ? $questionTemplate->name : old('name')}}" name="name" class="form-control">
        @error('name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="col-lg-7">
    <div class="form-group">
        <label>Department</label>
        <select class="form-control" name="department_id">
            <option value="">Select Department</option>
            @foreach($departments as $department )
               <option @if( isset($questionTemplate) and $questionTemplate->department_id == $department->id) selected @endif value="{{ $department->id }}">
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-lg-7">
    <div class="form-group">
        <label>Subject<span class="required-star"> *</span></label>
        <select class="form-control" name="subject_id">

            <option value="">Select Subject</option>
            @foreach($subjects as $subject)
                <option @if( isset($questionTemplate) and $questionTemplate->subject_id == $subject->id) selected @endif value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach

        </select>
        @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="col-lg-7">
    <div class="form-group">
        <label>Student Type<span class="required-star"> *</span></label>
        <select class="form-control" name="student_type_id">

            <option value="">Select Student Type</option>
            @foreach($studentTypes as $studentType)
                <option @if( isset($questionTemplate) and $questionTemplate->student_type_id == $studentType->id) selected @endif value="{{ $studentType->id }}">{{ $studentType->name }}</option>
            @endforeach

        </select>
        @error('student_type_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="col-lg-7">
    <div class="form-group">
        <label>Total Questions<span class="required-star"> *</span></label>
        <input type="number" value="{{ isset($questionTemplate->total_questions) ? $questionTemplate->total_questions : old('total_questions')}}" name="total_questions" class="form-control">
        @error('total_questions') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="col-lg-7">
    <div class="form-group">
        <label>Total Marks<span class="required-star"> *</span></label>
        <input type="number" value="{{ isset($questionTemplate->total_marks) ? $questionTemplate->total_marks : old('total_marks')}}" name="total_marks" class="form-control">
        @error('total_marks') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="col-lg-7">
    <div class="form-group">
        <label>Negative Marks/Question<span class="required-star"> *</span></label>
        <input step="0.01" type="number" value="{{ isset($questionTemplate->negative_marks) ? $questionTemplate->negative_marks : old('negative_marks')}}" name="negative_marks" class="form-control">
        @error('negative_marks') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>


