@extends('Acl::layout/layout')
@section('content')
    <div class="form">
        <h3>Edit {{ ucfirst($action)  }}</h3>
        <form method="POST" action="{{ route($action.'.update') }}">
            @csrf
            <input type="hidden" name="id" value="{{   $model->id }}">
            <input type="text" name="name" value="{{   $model->name }}">
            <input type="text" name="info" value="{{   $model->info }}">
            Active <input type="radio" name="default_access" value=1 @if($model->default_access == true) checked="checked" @endif>
            Disabled <input type="radio" name="default_access" value=0 @if($model->default_access == false) checked="checked" @endif>
            <input type="submit" name="submit" value="Update">
        </form>
    </div>
@endsection
