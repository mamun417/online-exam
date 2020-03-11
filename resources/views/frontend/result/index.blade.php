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

                        <div class="row" style="margin-bottom: 10px">

                            <div class="col-sm-12">
                                <form action="{{ route('examination.topScorer') }}" method="get" class="form-inline" role="form">

                                    <div class="form-group">
                                        <br>
                                        <label>Exam<span class="required-star"> *</span></label>

                                        <select id="select" onchange="submit()" class="input-sm form-control"  name="exam_notification_id">
                                            <option value="">Select Exam</option>
                                            @foreach($exams as $exam)
                                                <option {{ $exam->id == $id ? 'Selected' : '' }} value="{{ $exam->id }}">{{ $exam->template->subject->name.'-'.$exam->template->name.'-'.$exam->start_date }}</option>
                                            @endforeach
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
                                        <a href="{{ route('examination.topScorer') }}" class="btn btn-default btn-sm">Reset</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">

                            @if($results->count() > 0)
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Obtain marks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $result)
                                        <tr>
                                            <td>{{ ucfirst($result->user->name).' '.$result->user->last_name }}</td>
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


