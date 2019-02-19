<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 py-4 text-center">
                    <h4 class="text-white">Roles</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('role.index') }}" class="text-white">Overview Roles</a></li>
                        <li><a href="{{ route('role.create') }}" class="text-white">Create Roles</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 py-4 text-center">
                    <h4 class="text-white">Resources</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('resource.index') }}" class="text-white">Overview Resources</a></li>
                        <li><a href="{{ route('resource.create') }}" class="text-white">Create Resources</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 py-4 text-center">
                    <h4 class="text-white">User</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('user.index') }}" class="text-white">Overview User</a></li>
                        <li><a href="{{ route('user.create') }}" class="text-white">Create User</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="{{route('home')}}" class="navbar-brand d-flex align-items-center"><strong>Home</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>