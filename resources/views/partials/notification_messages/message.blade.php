@if($message = Session::get('success'))

    <div class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success!</strong> {{ $message }}.
    </div>
@endif()

@if($message = Session::get('warning'))
    <div class="alert alert-warning fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Warning!</strong> {{ $message }}.
    </div>
@endif()


@if($message = Session::get('error'))
    <div class="alert alert-warning fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> {{ $message }}.
    </div>
@endif()


