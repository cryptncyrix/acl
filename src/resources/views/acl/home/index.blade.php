@extends('AclView::layout/layout')
@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="col-sm-8 offset-md-2 py-2 text-center form">

        <p>{{ __('AclLang::views.name') }}: {{ auth()->user()->name  }}</p>
        <p>{{ __('AclLang::views.roles') }}:
        @if(config('acl.acl.superAdmin') == auth()->user()->id)
            < superAdmin >
        @endif
        @foreach(auth()->user()->roles as $value)
         {{ '< '.$value['name'].' >' }}
        @endforeach
        </p>
        <p>{{ __('AclLang::views.permissions') }}:
            @foreach(auth()->user()->resources as $value)
                {{ '< '.$value['name'].' >' }}
            @endforeach
        </p>
    </div>
@endsection