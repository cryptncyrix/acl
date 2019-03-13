@extends('AclView::layout/layout')
@section('content')
    <div class="form">
        <h3>{{__('AclLang::views.show_info', ['action' => ucfirst($action), 'item' => $repository->name])}}</h3>
        <p>{{$repository->id}}</p>
        {{-- <p>{{$repository->name}}</p> --}}
        <p>{{$repository->email}}</p>
        <p>{{$repository->info}}</p>
        <a href="{{ route($action.'.edit', $repository->id) }}"> {{__('AclLang::views.edit')}}</a>
    </div>
@endsection