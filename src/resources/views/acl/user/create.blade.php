@extends('AclView::layout/layout')
@section('content')
    <div class="form">
        <h3>{{__('AclLang::views.create_info' , ['type' => ucfirst($action)])}}</h3>
        <form  method="POST" action="{{ route($action.'.store') }}">
            @csrf
            <input type="text" name="name" placeholder="{{__('AclLang::views.username')}}">
            <input type="email" name="email" placeholder="{{__('AclLang::views.email_info')}}">
            <input type="password" name="password" placeholder="{{__('AclLang::views.password')}}">
            {{__('AclLang::views.active')}} <input type="radio" name="active" value=1>
            {{__('AclLang::views.deactive')}} <input type="radio" name="active" value=0>
            <input type="submit" name="submit" value="{{__('AclLang::views.add')}}">
        </form>
    </div>
@endsection
