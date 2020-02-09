<div class="row no-margins">
    <div class="col-lg-6">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>Good Job!</strong> {{ 'Eikhane message show korano hbe' }}.
            </div>
        @endif()

        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>Oops!</strong> {{ 'Eikhane message show korano hbe' }}.
            </div>
        @endif()

        @if($message = Session::get('warning'))
            <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>Warning!</strong> {{ 'Eikhane message show korano hbe' }}.
            </div>
        @endif()
    </div>
</div>
