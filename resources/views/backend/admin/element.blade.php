<div class="form-group">
    <label class="col-lg-2 control-label">First Name<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{ isset($user->name) ? $user->name : old('name')}}" name="name" class="form-control">
        @error('name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Last Name<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{ isset($user->last_name) ? $user->last_name : old('last_name')}}" name="last_name" class="form-control">
        @error('last_name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Email<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <input type="text" value="{{ isset($user->email) ? $user->email : old('email')}}" name="email" class="form-control">
        @error('email') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>



