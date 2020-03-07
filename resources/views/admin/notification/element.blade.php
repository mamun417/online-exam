<div class="col-lg-6">

    <div class="form-group">
        <label>Exam<span class="required-star"> *</span></label>
        <select class="form-control" name="question_template_id">
            <option value="">Select Exam</option>
            @foreach($question_templates as $question_template)
                <option value="{{ $question_template->id }}">{{ $question_template->subject->name }}-{{ $question_template->name }}</option>
            @endforeach
        </select>
        @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Mail Subject<span class="required-star"> *</span></label>
        <input type="text" name="mail_subject" value="{{ old('mail_subject') }}" class="form-control">
        @error('mail_subject') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Date<span class="required-star"> *</span></label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" name="start_date" autocomplete="off" class="form-control expire_date" value="{{ old('start_date') }}">
        </div>
        @error('start_date') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Duration in hours<span class="required-star"> *</span></label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            <input type="number" name="duration" autocomplete="off" class="form-control" value="{{ old('duration') }}">
        </div>
        @error('duration') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Notice</label>
        <textarea name="notice" id="textarea2" class="form-control" rows="3">Your exam [[SUBJECT]] will be held on [[DATE-TIME]]. Please be prepared for your online exam.</textarea>
        @error('notice') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>

</div>

@section('custom-js')
    <script>

        $(function () {
            $('.expire_date').datetimepicker({
                format:'DD-MM-YYYY h:mm A',
            });
        });

    </script>
@endsection
