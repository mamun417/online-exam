@extends('backend.layouts.master')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Department Add</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a>Tables</a>
                </li>
                <li class="active">
                    <strong>Data Tables</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            @if(session('success'))
                <span class="text-success float-right" role="alert">
                    <strong>{{session('success')}}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form class="form-horizontal" method="POST" action="{{ route('department.store') }}">
                            @csrf
                           @include('backend.department.element')

                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Submit</strong></button>
                            <br>
                            <br>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
