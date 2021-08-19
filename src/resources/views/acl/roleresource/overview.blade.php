@extends('AclView::layout/layout')
@section('content')
<div class="col-sm-8 offset-md-2 py-2 text-center">
    <table id="role" class="table table-striped table-hover table-bordered table-dark" cellspacing="0" width="100%">
        <h3>{{ __('AclLang::views.' . $action . 's_overview')}}</h3>
        @include('AclView::partials.status')
        <caption class="text-center"> {{__('AclLang::views.overview')}} </caption>
        <thead>
            <tr>
                <th class="text-center"> {{__('AclLang::views.id')}}</th>
                <th class="text-center"> {{__('AclLang::views.name')}}</th>
                <th class="text-center"> {{__('AclLang::views.default_access')}}</th>
                <th class="text-center"> {{__('AclLang::views.description')}}</th>
                <th class="text-center">{{__('AclLang::views.edit')}}</th>
                @if(isset($link) && count($link) == 1)
                    <th class="text-center">{{__('AclLang::views.assign')}}</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach($repository as $value)
            <tr class="text-center">
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->default_access }}</td>
                <td>{{ $value->info }}</td>
                <td>
                @perm($action.'.show')
                    <a class="btn btn-xs btn-warning" href="{{ route($action.'.show' , $value->id) }}">
                        <i class="fa fa-btn fa-edit"></i>{{__('AclLang::views.show')}}
                    </a>
                @endperm
                @perm($action.'.destroy')
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_{{$value->id}}"><i class="fa fa-btn fa-trash"></i>{{__('AclLang::views.destroy')}}</button>
                    @include('AclView::roleresource._modals')
                @endperm
                </td>
                @if(isset($link) && count($link) == 1)
                <td>
                @perms(['acl.getPermissions' , 'resource.role'])
                    <a class="btn btn-xs btn-success" href="{{ route('acl.getPermissions', [$link[0], $action, $value->id]) }}"><i class="fa fa-btn fa-chain"></i>{{__('AclLang::views.assign_to', ['assign' => ucfirst($link[0])])}}</a>
                @endperms
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection