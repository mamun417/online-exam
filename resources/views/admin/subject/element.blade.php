<div class="col-lg-7">
    <div class="form-group">
        <label>Subject Name<span class="required-star"> *</span></label>
        <input type="text" value="{{isset($subject->name) ? $subject->name:old('name')}}" name="name" class="form-control">
        @error('name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="col-lg-7">
    <div class="form-group">
        <label>Subject Code<span class="required-star"> *</span></label>
        <input type="text" value="{{isset($subject->subject_code) ? $subject->subject_code:old('subject_code')}}" name="subject_code" class="form-control">
        @error('subject_code') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="col-lg-7">
    <div class="form-group" id="tokenize-select">
        <label>Faculty<span class="required-star"> *</span></label>
        <select class="form-control departments" name="department_id[]" multiple>
            @foreach($departments as $department )
                @php($selected = (isset($subject) and in_array($department->id, $subject_departments)) ? 'selected' : '')
                <option {{ $selected }} value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
        @error('department_id[]') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

@section('custom-js')
    <script>
        $(function () {
            $('.departments').tokenize2({

                dataSource: function(term, object){
                    $.get('{{ route('admin.get-department-list') }}', {term:term}, function (option_list) {
                        object.trigger('tokenize:dropdown:fill', [option_list]);
                    });
                },

                placeholder: "Type here...",
                sortable: true,
                delimiter: false
            });
        });
    </script>
@endsection
