@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('video.index') }}">Videos</a>
                </li>
                <li class="active">
                    <strong>{{ ucfirst($subject->name) }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            @if(count($subject->videos) > 0)
                @foreach($subject->videos as $key => $video)

                    <div class="col-md-3">
                        <div class="ibox">
                            <div class="ibox-content product-box">
                                <div class="product-imitation" style="padding: 0!important;cursor:pointer;" data-toggle="modal" data-target="#videoModal-{{ $key }}">
                                    <img src="{{ asset('admin/uploads/images/video/'.$video->thumbnail) }}" width="100%" height="200px">
                                </div>
                                <div class="product-desc text-center">
                                    <h4 title="{{ $video->name }}"> {{ ucfirst(Str::limit($video->name, 26)) }}</h4>
                                    <div class="m-t">
                                        <button data-toggle="modal" data-target="#videoModal-{{ $key }}" class="btn btn-outline btn-primary">Play</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal inmodal" id="videoModal-{{ $key }}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header" style="padding: 10px 15px">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title pull-left">{{ $video->name }}</h4>
                                </div>
                                <div class="modal-body" style="padding: 20px">
                                    <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/{{ $video->video_id }}"
                                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-warning">
                    Video not found
                </div>
            @endif
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $('.modal').on('hidden.bs.modal', function (e) {
            $(this).find('iframe').attr('src', $(this).find('iframe').attr('src'));
        })
    </script>
@endsection

