<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Access Control List</title>
</head>
<body>


@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<h3>Acl Overview</h3>
<div class='table-responsive'>
    <table id="role" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
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