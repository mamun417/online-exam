<div class="col-lg-6">
    <div class="form-group">
        <label>Date<span class="required-star"> *</span></label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" name="expire_date" class="form-control expire_date" value="{{ $user->expire_date->format('d-m-Y') }}">
        </div>
        @error('expire_date') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

@section('custom-js')
    <script>
        $('.expire_date').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
    </script>
@endsection
