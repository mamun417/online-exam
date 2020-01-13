
<div class="form-group">
    <label class="col-lg-2 control-label">Department<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <select selected class="form-control" name="department_id">

        	<option>Select Deparment</option>
            @foreach($departments as $department )
        	   <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach

        </select>
        @error('department_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Subject<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <select selected class="form-control" name="subject_id">

            <option>Select Subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach

        </select>
        @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

 <div class="form-group">
    <label class="col-lg-2 control-label">Total Marks<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="" name="total_marks" class="form-control">
        @error('total_marks') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div> 
