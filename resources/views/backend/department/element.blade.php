<br>
<br>
<div class="form-group"><label class="col-lg-2 control-label">Department Name<span class="required-star"> *</span></label>
    <div class="col-lg-10">
        <input type="text" name="name" placeholder="Department Name" class="form-control">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                   <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <div class="i-checks">
            <label class="">
                <div class="icheckbox_square-green" style="position: relative;">
                    <input type="checkbox" value="1" name="is_active" style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div>
                <i></i> Active
            </label>
        </div>
        <br>

        <div class="i-checks">
            <label class="">
                <div class="icheckbox_square-green" style="position: relative;">
                    <input type="checkbox" value="1" name="is_deleted" style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div><i></i> Deleted
            </label>
        </div>
    </div>
</div>
<br>
<br>
