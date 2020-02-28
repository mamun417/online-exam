<div class="col-lg-6">
    <div class="form-group">
        <label>Date<span class="required-star"> *</span></label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" name="expire_date" class="form-control expire_date" value="{{ $user->expire_date->format('d-m-Y') }}">
        </div>
        @error('expire_date') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <div class="col-sm-2 no-padding">
            <label>Status</label>
        </div>
        <div class="col-sm-10 no-padding">
            <div class="input-group">
                <div class="i-checks">
                    <label>
                        <input name="status" value="1" type="checkbox" {{ $user->status == 1 ? 'checked' : '' }}>
                        <i></i>
                    </label>
                </div>
            </div>
        </div>
        @error('Status') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>

</div>

@section('custom-js')
    <script>
        $('.expire_date').datetimepicker({
            format:'DD-MM-YYYY',
        });
    </script>
@endsection
