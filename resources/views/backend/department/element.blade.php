<br>
<br>
<div class="form-group"><label class="col-lg-2 control-label">Department Name<span class="required-star"> *</span></label>
    <div class="col-lg-10">
        <input type="text" value="{{isset($department->name) ? $department->name:old('name')}}" name="name" class="form-control">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                   <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
</div>


