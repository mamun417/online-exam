@extends('layouts.master')
@section('content')
    <div id="app">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Home</h2>
               {{-- <ol class="breadcrumb">
                    <li>
                        <a>Dashboard</a>
                    </li>
                    <li class="active">
                        <strong>Home</strong>
                    </li>
                </ol>--}}

            </div>
        </div>

        <div class="wrapper wrapper-content animated">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">

                            @include('flash-messages.flash-messages')

                            <div class="table-responsive">
                                <h2>Welcome to Medi Spark</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
