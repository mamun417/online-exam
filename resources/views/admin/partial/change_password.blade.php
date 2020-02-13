@extends('layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Change Password</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('dashboard') }}">Home</a>
                </li>
                <li>
                    <a href="">Profile</a>
                </li>
                <li class="active">
                    <strong>Change Password</strong>
                </li>
            </ol>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                            @csrf
                             <div class="form-group">
							    <label class="col-lg-2 control-label">Old Password<span class="required-star"> *</span></label>
							    <div class="col-lg-6">
							        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="old_password" >

							        @error('old_password') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror

							        <span class="help-block m-b-none text-danger">@if(session('olderror')){{ session('olderror') }}@endif</span>

							    </div>
							</div>

                            <div class="form-group">
							    <label class="col-lg-2 control-label">Password<span class="required-star"> *</span></label>
							    <div class="col-lg-6">
							        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

							        @error('password') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
							    </div>
							</div>

							<div class="form-group">
							    <label class="col-lg-2 control-label">Confirm Password<span class="required-star"> *</span></label>
							    <div class="col-lg-6">
							        <input type="password" name="password_confirmation" class="form-control">
							    </div>
							</div>

                            <div class="form-group">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    <button class="btn btn-sm btn-primary pull-left m-t-n-xs" type="submit"><strong>Update</strong></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
