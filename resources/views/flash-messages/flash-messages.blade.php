<div class="row no-margins">
    <div class="col-lg-6">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>Success!</strong> {{ $message }}
            </div>
        @endif()

        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>Oops!</strong> {{ $message }}
            </div>
        @endif()

        @if($message = Session::get('warning'))
            <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ $message }}
            </div>
        @endif()

        @if($message = Session::get('limit_cross'))
            <div class="alert alert-warning no-margins">
                {{ $message }}
            </div>
        @endif()

    </div>
</div>

@if($message = Session::get('payment_success'))
    <div class="alert alert-success alert-dismissable">
        <strong>Success!</strong> {{ $message }}
        @php(Session::forget('payment_success'))
    </div>
@endif()

@if($message = Session::get('payment_fail'))
    <div class="alert alert-danger alert-dismissable">
        <strong>Success!</strong> {{ $message }}
        @php(Session::forget('payment_fail'))
    </div>
@endif()
