 @extends('backend.layouts.master')

@section('content')
     <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Examination</h2>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
                <a href="{{ route('examinations.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>


 <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Subject</th>
                                        <th>Total Marks</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($examinations as $examination)
                                        <tr>
                                            <td>{{ ucfirst($examination->department->name) }}</td>
                                            <td>{{ ucfirst($examination->subject->name) }}</td>
                                            <td>{{ ucfirst($examination->total_marks) }}</td>
        
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
 