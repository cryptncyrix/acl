@extends('AclView::layout/layout')
@section('content')
<div class="col-sm-8 offset-md-2 py-2 text-center">
    <form action="{{route('acl.setPermissions')}}" method="POST">
        @csrf
        <table id="role" class="table table-striped table-hover table-bordered table-dark" cellspacing="0" width="100%">
            <h3>{{ __('AclLang::views.heading_acl', ['action' => $action_split,'for' => $from->name]) }}</h3>
            @include('AclView::partials.status')
            <caption class="text-center"> <i class="fa fa-plus"></i> {{ __('AclLang::views.set_to', ['to' => $from->name]) }} </caption>
            <thead>
            <tr>
                <th class="text-center">{{ __('AclLang::views.name') }}</th>
                <th class="text-center">{{ __('AclLang::views.set') }} ?</th>
                <th class="text-center">{{ __('AclLang::views.assign') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($to as $key => $value)
                <tr class="text-center">
                    <td>{{ $value[1] }}</td>
                    <td>@if(isset($value[0]) && $value[0] == 1)
                            <i class='fa fa-check'></i>
                        @else
                            <i class='fa fa-ban'></i>
                        @endif
                    </td>
                    <td>
                        {{ __('AclLang::views.set') }} <input id="{{$key}}" type="radio" name="new[{{$key}}]" value=1 {{(isset($value[0]) && $value[0] == 1) ? 'checked="checked"' : ""}}>
                        {{ __('AclLang::views.remove') }} <input id="{{$key}}" type="radio" name="new[{{$key}}]" value=0 {{(isset($value[0]) && $value[0] != 1) ? 'checked="checked"' : "" }}>
                        <input type="hidden" name="old[{{$key}}]" value="{{$value[0]}}">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <input type="hidden" name="_id" value="{{$id}}">
        <input type="hidden" name="action" value="{{$action}}">
        <input class="btn-danger btn-lg btn-dark" type="submit" name="submit" value="{{ __('AclLang::views.update') }}">
    </form>
</div>
@endsection