

@extends('AclView::layout/layout')
@section('content')
    <div class="form">
        <h3>{{__('AclLang::views.edit_info', ['action' => ucfirst($action), 'item' => $repository->name])}}</h3>
        <form method="POST" action="{{ route($action.'.update') }}">
            @csrf
            <input type="hidden" name="id" value="{{   $repository->id }}">
            <input type="text" name="name" value="{{   $repository->name }}">
            <input type="email" name="email" value="{{   $repository->email }}">
            <input type="password" name="password" placeholder="{{__('AclLang::views.password_info')}}">
            <input type="text" name="info" value="{{__('AclLang::views.description_info')}}">
            <input type="submit" name="submit" value="{{__('AclLang::views.update')}}">
        </form>
    </div>
@endsection
