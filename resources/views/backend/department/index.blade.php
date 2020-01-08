@extends('backend.layouts.master')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Departments</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('department.index') }}">Departments</a>
                </li>
                <li class="active">
                    <strong>Index</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
                <a href="{{ route('department.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Departments</h5>
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                            <tr>
                                <th  style=" text-align: center; width: 80px">Sl No</th>
                                <th  style=" text-align: center;">Department Name</th>
                                <th  style=" text-align: center; width: 80px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1?>
                            @foreach($departments as $department)
                                <tr>
                                    <td  style="text-align: center; width: 80px">{{ $count++ }}</td>
                                    <td  style="text-align: center">{{ $department->name }}</td>
                                    <td  style="text-align: center; width: 80px">
                                        <div style="width: 80px">
                                            <a title="Edit" href="{{ route('department.edit',$department->id) }}" class="btn btn-success fs-btn-success btn-outline"> <i class="fa fa-pencil-square-o"></i></a>
                                            <form action="{{ route('department.destroy',$department->id) }}" class="delete-button-style" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="alert('Sure this item delete')"  class="btn btn-danger fs-btn-danger  btn-outline"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
