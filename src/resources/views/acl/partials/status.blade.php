@if(session('status'))
    <div class="alert text-center alert-success">
        {{ session('status') }}
    </div>
@endif
@if(session('error'))
    <div class="alert text-center alert-danger">
        {{ session('error') }}
    </div>
@endif