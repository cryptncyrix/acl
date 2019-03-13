@extends('AclView::layout/layout')
@section('content')
    <div class="form">
        <h3>{{__('AclLang::views.create_info' , ['type' => ucfirst($action)])}}</h3>
        <form  method="POST" action="{{ route($action.'.store') }}">
            @csrf
            <input type="text" name="name" placeholder="{{__('AclLang::views.name')}}">
            <input type="text" name="info" placeholder="{{__('AclLang::views.description_info')}}">
            {{__('AclLang::views.allow')}} <input type="radio" name="default_access" value=1>
            {{__('AclLang::views.disallowed')}} <input type="radio" name="default_access" value=0>
            <input type="submit" name="submit" value="{{__('AclLang::views.create')}}">
        </form>
    </div>
@endsection
