<div class="form-group">
    <label class="col-lg-2 control-label">Date<span class="required-star"> *</span></label>
    <div class="col-lg-6">
        <div class="form-group" id="data_1">
	        <div class="input-group date">
	            <span class="input-group-addon">
	                <i class="fa fa-calendar"></i>
	            </span>
	            <input type="text" name="expire_date" class="form-control" value="{{ $user->expire_date}}">  
	        </div>
	    </div>

        @error('expire_date') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>


