<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 py-3 text-center">
                    <h4 class="text-white">{{ __('AclLang::views.roles') }}</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('role.index') }}" class="text-white">{{ __('AclLang::views.roles_overview') }}</a></li>
                        <li><a href="{{ route('role.create') }}" class="text-white">{{ __('AclLang::views.roles_create') }}</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 py-3 text-center">
                    <h4 class="text-white">{{ __('AclLang::views.permissions') }}</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('resource.index') }}" class="text-white">{{ __('AclLang::views.permissions_overview') }}</a></li>
                        <li><a href="{{ route('resource.create') }}" class="text-white">{{ __('AclLang::views.permissions_create') }}</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 py-3 text-center">
                    <h4 class="text-white">{{ __('AclLang::views.users') }}</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('user.index') }}" class="text-white">{{ __('AclLang::views.users_overview') }}</a></li>
                        <li><a href="{{ route('user.create') }}" class="text-white">{{ __('AclLang::views.users_create') }}</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 py-3 text-center">
                    <h4 class="text-white">{{ __('AclLang::views.logout') }}</h4>

                    <a class="text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

                </div>

            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="{{route('home')}}" class="navbar-brand d-flex align-items-center"><strong>{{ __('AclLang::views.home') }}</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>