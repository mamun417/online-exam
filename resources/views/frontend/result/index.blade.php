@extends('layouts.master')

@section('content')
     <div class="row wrapper border-bottom white-bg page-heading">
       <div class="col-lg-10">
            <h2>Top Scorer</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="table-responsive">

                            @if($results->count() > 0)
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Obtain marks</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($results as $result)
                                            <tr>
                                                <td>{{ ucfirst($result->user->name).' '.$result->user->last_name }}</td>
                                                <td>{{ $result->user->email }}</td>
                                                <td>{{ $result->result }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                                <div class="dataTables_info table-pagination" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                    <div class="m-r-lg">
                                        Showing {{ $results->firstItem() }} to {{ $results->lastItem() }} of {{ $results->total() }} entries
                                    </div>
                                    {{ $results->links() }}
                                </div>

                            @else
                                <div class="alert alert-warning no-margins">
                                    No score found
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
