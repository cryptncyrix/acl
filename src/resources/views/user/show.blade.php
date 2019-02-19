@extends('Acl::layout/layout')
@section('content')
    <div class="form">
        <h3>Show {{ ucfirst($action)  }}</h3>
        <p>{{$model->id}}</p>
        <p>{{$model->name}}</p>
        <p>{{$model->email}}</p>
        <p>{{$model->info}}</p>
        <a href="{{ route($action.'.edit', $model->id) }}"> Bearbeiten</a>
    </div>
@endsection