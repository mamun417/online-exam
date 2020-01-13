
<div class="form-group">
    <label class="col-lg-2 control-label">Department<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <select selected class="form-control" name="department_id">

        	<option value="" >Select Deparment</option>
            @foreach($departments as $department )
        	   <option @if( isset($examination) and $examination->department_id == $department->id) selected @endif value="{{ $department->id }}">{{ $department->name }}</option>
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
                <option @if( isset($examination) and $examination->subject_id == $subject->id) selected @endif value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach

        </select>
        @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

 <div class="form-group">
    <label class="col-lg-2 control-label">Total Marks<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{ isset($examination->total_marks) ? $examination->total_marks : old('total_marks')}}" name="total_marks" class="form-control">
        @error('total_marks') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div> 
