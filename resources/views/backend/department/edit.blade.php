@extends('backend.layouts.master')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Department Edit</h2>
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
        <div class="col-lg-2">

        </div>
    </div>
    <br>
    <br>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <form class="form-horizontal" method="POST" action="{{ route('department.update') }}">

                    @include('backend.department.element')
                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Update</strong></button>
                </form>
            </div>
        </div>
    </div>
@endsection
