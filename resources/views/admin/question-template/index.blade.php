 @extends('layouts.master')

@section('content')
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Questions Template</h2>
    </div>
    <div class="col-lg-2">
        <div class="ibox-tools">
            <a href="{{ route('admin.question-templates.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">

                        <div class="row" style="margin-bottom: 10px">

                            <div class="col-sm-12">
                                <form action="{{ route('admin.question-templates.index') }}" method="get" class="form-inline" role="form">

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
                                         <a href="{{ route('admin.question-templates.index') }}" class="btn btn-default btn-sm">Reset</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Subject</th>
                                        <th>Student Type</th>
                                        <th>Total Question</th>
                                        <th>Question Assigned</th>
                                        <th>Total Marks</th>
                                        <th>Negative Marks</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($questionTemplates as $questionTemplate)
                                        <tr>
                                            <td>{{ ucfirst($questionTemplate->name) }}</td>
                                            <td>{{ ucfirst($questionTemplate->department->name) }}</td>
                                            <td>{{ ucfirst($questionTemplate->subject->name) }}</td>
                                            <td>{{ ucfirst($questionTemplate->studentType->name) }}</td>
                                            <td>{{ ucfirst($questionTemplate->total_questions) }}</td>
                                            <td>{{ ucfirst($questionTemplate->questions_count) }}</td>
                                            <td>{{ ucfirst($questionTemplate->total_marks) }}</td>
                                            <td>{{ ucfirst($questionTemplate->negative_marks) }}</td>
                                            <td class="text-center">

                                                <a href="{{ route('admin.question-templates.edit', $questionTemplate->id) }}" title="Edit" class="btn btn-info cus_btn">
                                                    <i class="fa fa-pencil-square-o"></i> <strong>Edit</strong>
                                                </a>

                                                @if(config('app.env') === 'local')
                                                    <a onclick="deleteRow({{ $questionTemplate->id }})" href="JavaScript:void(0)" title="Delete" class="btn btn-danger cus_btn">
                                                        <i class="fa fa-trash"></i> <strong>Delete</strong>
                                                    </a>

                                                    <form id="row-delete-form{{ $questionTemplate->id }}" method="POST" action="{{ route('admin.question-templates.destroy', $questionTemplate->id) }}" style="display: none" >
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
                                Showing {{ $questionTemplates->firstItem() }} to {{ $questionTemplates->lastItem() }} of {{ $questionTemplates->total() }} entries
                            </div>
                            {{ $questionTemplates->appends(['perPage' => request('perPage'), 'department' => request('department'), 'subject' => request('subject'), 'quiestionType' => request('questionType'), 'keyword' => request('keyword')])->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
