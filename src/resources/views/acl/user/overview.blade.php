@extends('AclView::layout/layout')
@section('content')
@include('AclView::partials.status')
<div class="col-sm-8 offset-md-2 py-2 text-center">
    <table id="role" class="table table-striped table-hover table-bordered table-dark" cellspacing="0" width="100%">
        <caption class="text-center"> {{__('AclLang::views.overview')}} </caption>
        <thead>
        <tr>
            <th class="text-center">{{__('AclLang::views.id')}}</th>
            <th class="text-center">{{__('AclLang::views.name')}}</th>
            <th class="text-center">{{__('AclLang::views.email')}}</th>
            <th class="text-center">{{__('AclLang::views.description')}}</th>
            <th class="text-center">{{__('AclLang::views.edit')}}</th>
            @if(isset($link) && count($link) == 2)
                <th class="text-center">{{__('AclLang::views.assign')}}</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($repository as $value)
            <tr class="text-center">
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->info }}</td>
                <td>@perm($action.'.show')
                        <a class="btn btn-xs btn-warning" href="{{ route($action.'.show' , $value->id) }}"> <i class="fa fa-btn fa-edit"></i>{{__('AclLang::views.show')}}</a>
                    @endperm
                    @perm($action.'.destroy')
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_{{$value->id}}"><i class="fa fa-btn fa-trash"></i>{{__('AclLang::views.destroy')}}</button>
                        @include('AclView::user._modals')
                    @endperm
                </td>
                @if(isset($link) && count($link) == 2)
                    <td>
                        @perms(['acl.getPermissions' , 'role.user'])
                            <a class="btn btn-xs btn-success" href="{{ route('acl.getPermissions', [$link[0], $action, $value->id]) }}"><i class="fa fa-btn fa-chain"></i>
                                {{__('AclLang::views.assign_to', ['assign' => ucfirst($link[0])])}}</a>
                        @endperms

                        @perms(['acl.getPermissions' , 'resource.user'])
                                <a class="btn btn-xs btn-success" href="{{ route('acl.getPermissions', [$link[1], $action, $value->id]) }}"><i class="fa fa-btn fa-chain"></i>
                                    {{__('AclLang::views.assign_to', ['assign' => ucfirst($link[1])])}}
                                </a>
                        @endperms
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
@endsection