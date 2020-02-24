@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Departments</h2>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
                <a href="{{ route('admin.departments.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">

                        <div class="row" style="margin-bottom: 10px">

                            <div class="col-sm-12">
                                <form action="{{ route('admin.departments.index') }}" method="get" class="form-inline" role="form">

                                    <div class="form-group">
                                        <div>Records Per Page</div>
                                        <select name="perPage" id="perPage" onchange="submit()" class="input-sm form-control" style="width: 115px;">
                                            <option value="10"{{ request('perPage') == 10 ? ' selected' : '' }}>10</option>
                                            <option value="25"{{ request('perPage') == 25 ? ' selected' : '' }}>25</option>
                                            <option value="50"{{ request('perPage') == 50 ? ' selected' : '' }}>50</option>
                                            <option value="100"{{ request('perPage') == 100 ? ' selected' : '' }}>100</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <div class="input-group">
                                            <input name="keyword" type="text" value="{{ request('keyword') }}" class="input-sm form-control" placeholder="Search Here">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-sm btn-primary"> Go!</button>
                                            </span>
                                        </div>
                                         <a href="{{ route('admin.departments.index') }}" class="btn btn-default btn-sm">Reset</a>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Department Name</th>
                                        <th>Created At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($departments as $department)
                                        <tr>
                                            <td>{{ ucfirst($department->name) }}</td>
                                            <td>{{ date_format($department->created_at, 'd-m-Y') }}</td>
                                            <td class="text-center">

                                                <a href="{{ route('admin.departments.edit', $department->id) }}" title="Edit" class="btn btn-info cus_btn">
                                                    <i class="fa fa-pencil-square-o"></i> <strong>Edit</strong>
                                                </a>


                                                @if(config('app.env') === 'local')
                                                    <a onclick="deleteRow({{ $department->id }})" href="JavaScript:void(0)" title="Delete" class="btn btn-danger cus_btn">
                                                        <i class="fa fa-trash"></i> <strong>Delete</strong>
                                                    </a>

                                                    <form id="row-delete-form{{ $department->id }}" method="POST" action="{{ route('admin.departments.destroy', $department->id) }}" style="display: none" >
                                                        @method('DELETE')
                                                        @csrf()
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        <div class="dataTables_info table-pagination" id="DataTables_Table_0_info" role="status" aria-live="polite">
                            <div class="m-r-lg">
                                Showing {{ $departments->firstItem() }} to {{ $departments->lastItem() }} of {{ $departments->total() }} entries
                            </div>
                            {{ $departments->appends(['perPage' => request('perPage'), 'keyword' => request('keyword')])->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
