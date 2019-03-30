@extends('AclView::layout/layout')
@section('content')
<div class="col-sm-8 offset-md-2 py-2 text-center form">
    @include('AclView::partials.status')
    <p>{{ __('AclLang::views.name') }}: {{ auth()->user()->name  }}</p>
    <p>{{ __('AclLang::views.roles') }}:
        @if(config('acl.acl.superAdmin') == auth()->user()->id)
            {{ __('AclLang::views.superAdmin') }}
        @endif
        @foreach(auth()->user()->roles as $value)
            {{ '< '.$value['name'].' >' }}
        @endforeach
    </p>
    <p>{{ __('AclLang::views.resources') }}:
        @foreach(auth()->user()->resources as $value)
            {{ '< '.$value['name'].' >' }}
        @endforeach
    </p>
</div>
@endsection