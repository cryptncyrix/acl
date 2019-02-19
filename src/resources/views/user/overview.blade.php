@extends('Acl::layout/layout')
@section('content')

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="col-sm-8 offset-md-2 py-2 text-center">
    <table id="role" class="table table-striped table-hover table-bordered table-dark" cellspacing="0" width="100%">
        <caption class="text-center"> Übersicht </caption>
        <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Beschreibung</th>
            <th class="text-center">Bearbeiten</th>
            @if(isset($link) && count($link) == 2)
                <th class="text-center">Rechte Zuweisen</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($model as $value)
            <tr class="text-center">
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->info }}</td>
                <td>@perm($action.'.show')
                        <a class="btn btn-xs btn-warning" href="{{ route($action.'.show' , $value->id) }}"> <i class="fa fa-btn fa-edit"></i>Anzeigen</a>
                    @endperm
                    @perm($action.'.destroy')
                        <a class="btn btn-xs btn-danger" href="{{ route($action.'.destroy' , $value->id) }}"> <i class="fa fa-btn fa-edit"></i>Delete</a>
                    @endperm
                </td>
                @if(isset($link) && count($link) == 2)
                    <td>

                        @perms(['acl.getPermissions' , 'role.user'])
                            <a class="btn btn-xs btn-success" href="{{ route('acl.getPermissions', [$link[0], $action, $value->id]) }}"><i class="fa fa-btn fa-chain"></i>Add {{ $link[0] }}</a>
                        @endperms

                        @perms(['acl.getPermissions' , 'resource.user'])
                                <a class="btn btn-xs btn-success" href="{{ route('acl.getPermissions', [$link[1], $action, $value->id]) }}"><i class="fa fa-btn fa-chain"></i>Add {{ $link[1] }}</a>
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