<div class="col-lg-6">

    <div class="form-group">
        <label>Exam<span class="required-star"> *</span></label>
        <select class="form-control" name="subject_id">
            <option value="">Select Subject</option>
            @foreach($subjects as $subject)
                <option @if( isset($questionTemplate) and $questionTemplate->subject_id == $subject->id) selected @endif value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>
        @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Mail Subject<span class="required-star"> *</span></label>
        <input type="text" name="mail_subject" value="" class="form-control">
        @error('mail_subject') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Date<span class="required-star"> *</span></label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" name="start_date" autocomplete="off" class="form-control expire_date" value="">
        </div>
        @error('start_date') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Notice<span class="required-star"> *</span></label>
        <textarea name="notice" id="textarea2" class="form-control" rows="3"></textarea>
        @error('notice') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
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
            autoclose: true,
            todayHighlight: true
        });
    </script>
@endsection
