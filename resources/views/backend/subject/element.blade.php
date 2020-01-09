<div class="form-group"><label class="col-lg-2 control-label">Subject Name<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{isset($subject->name) ? $subject->name:old('name')}}" name="name" class="form-control">
        @error('name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group"><label class="col-lg-2 control-label">Subject Code<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{isset($subject->subject_code) ? $subject->subject_code:old('subject_code')}}" name="subject_code" class="form-control">
        @error('subject_code') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

