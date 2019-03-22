@extends('AclView::layout/layout')
@section('content')
    <div class="form">
        <h3>{{__('AclLang::views.edit_info', ['action' => ucfirst($action), 'item' => $repository->name])}}</h3>
        <form method="POST" action="{{ route($action.'.update') }}">
            @csrf
            <input type="hidden" name="id" value="{{   $repository->id }}">
            <input type="text" name="name" value="{{   $repository->name }}">
            <input type="text" name="info" value="{{   $repository->info }}">

            <div class="form-check form-check-inline">
                 <input id="allow" type="radio" class="form-check-input" name="default_access" value=1 @if($repository->default_access == true) checked="checked" @endif>
                <label class="form-check-label" for="allow">{{__('AclLang::views.allow')}}</label>
            </div>
            <div class="form-check form-check-inline">
                <input id="disallow" type="radio" class="form-check-input" name="default_access" value=0 @if($repository->default_access == false) checked="checked" @endif>
                <label class="form-check-label" for="disallow">{{__('AclLang::views.disallowed')}}</label>
            </div>

            <input type="submit" name="submit" value="Update">
        </form>
    </div>
@endsection
