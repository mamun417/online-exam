<div class="col-lg-7">
    <div class="form-group">
        <label>Subject<span class="required-star"> *</span></label>
        <select class="form-control" name="subject_id">
            <option value="">Select Subject</option>
            @foreach($subjects as $subject)
                <option @if( isset($video) and $video->subject_id == $subject->id) selected @endif value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>
        @error('subject_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="col-lg-7">
    <div class="form-group">
        <label>Name<span class="required-star"> *</span></label>
        <input type="text" value="{{ isset($video->name) ? $video->name : old('name')}}" name="name" class="form-control">
        @error('name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-7">
            <div class="form-group">
                <label>
                    URL<span class="required-star"> *</span>
                </label>
                <input type="text" name="embed_code" value="{{ isset($video->embed_code) ? $video->embed_code : old('embed_code') }}" class="form-control">
                @error('embed_code') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-lg-3">
            <iframe id="preview" style="margin-top: 32px;width: 100%!important;" height="130" class="hidden" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<div class="col-lg-7">
    <div class="form-group">
        <label>Thumbnail<span class="required-star"> *</span></label>
        <input type="file" name="img" class="form-control">
        @error('img') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
        @if(!empty($video->thumbnail))
            <img src="{{ asset('admin/uploads/images/video/'.$video->thumbnail) }}" style="margin-top:10px" width="100" height="100">
        @endif
    </div>
</div>




