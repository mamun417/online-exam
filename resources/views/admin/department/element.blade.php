<div class="col-lg-7">
	<div class="form-group">
    	<label>Department Name<span class="required-star"> *</span></label>
        <input type="text" value="{{ isset($department->name) ? $department->name : old('name')}}" name="name" class="form-control">
        @error('name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>


