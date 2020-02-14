@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('study.select-subject') }}">Practice</a>
                </li>
                <li class="active">
                    <strong>Summery</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Summery Details</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="badge badge-primary">16</span>
                                        But I must explain to
                                    </li>
                                    <li class="list-group-item ">
                                        <span class="badge badge-info">12</span>
                                        How all this mistaken
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge badge-danger">10</span>
                                        But because occasionally
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge badge-success">10</span>
                                        But who has any right
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge badge-warning">7</span>
                                        On the other hand
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
=
