@extends('layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Profile</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Profile</a>
                </li>
                <li class="active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form class="form-horizontal" method="POST" action="{{ route('profile.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="col-lg-2 control-label">First Name<span class="required-star"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ isset($user->name) ? $user->name : old('name')}}" name="name" class="form-control">
                                    @error('name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Last Name<span class="required-star"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ isset($user->last_name) ? $user->last_name : old('last_name')}}" name="last_name" class="form-control">
                                    @error('last_name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email<span class="required-star"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="email" value="{{ isset($user->email) ? $user->email : old('email')}}" disabled name="email" class="form-control">
                                    @error('email') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            @if(Auth::user()->role_id != 1)
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Account Type<span class="required-star"> *</span></label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="account_type_id" disabled>
                                            <option {{ $user->account_type_id == 0 ? 'selected':'' }} value="0">Free</option>
                                            <option {{ $user->account_type_id == 1 ? 'selected':'' }} value="1">Paid</option>
                                        </select>
                                    </div>

                                    @error('account_type_id') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif

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
