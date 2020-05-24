@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Library</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-sm-12">

                                @include('flash-messages.flash-messages')

                                <iframe
                                    id="iframe"
                                    src="https://drive.google.com/embeddedfolderview?id=1n5kNq2Lmu9XizLY_UvOqBH4rcRSkmJV4#list"
                                    frameborder="0"
                                    width="100%"
                                    height="458px">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


