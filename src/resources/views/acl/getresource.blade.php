<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Berechtigungen anpassen für {{ $from->name }}</title>
</head>
<body>


@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<h3>Berechtigungen anpassen für {{ $from->name }}</h3>
<div class='table-responsive'>
    <form action="{{route('acl.setPermissions')}}" method="POST">
        @csrf
    <table id="role" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
        <caption class="text-center"> Hinzufügen zu {{ $from->name }} </caption>
        <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Gesetzt ?</th>
            <th class="text-center">Recht Zuweisen</th>
        </tr>
        </thead>
        <tbody>

        @foreach($to as $key => $value)
            <tr class="text-center">
                <td>{{ $value[1] }}</td>
                <td>Status Aktiv Ja / Nein</td>
                <td>

                    Set <input id="{{$key}}" type="radio" name="{{$key}}" value=1 {{(isset($value[0]) && $value[0] == 1) ? 'checked="checked"' : ""}}>
                    Remove <input id="{{$key}}" type="radio" name="{{$key}}" value=0 {{(isset($value[0]) && $value[0] != 1) ? 'checked="checked"' : "" }}>
                    <input type="hidden" name="old_{{$key}}" value="{{$value[0]}}"></td>
            </tr>
        @endforeach

        </tbody>
    </table>
        <input type="hidden" name="_id" value="{{$id}}">
        <input type="hidden" name="action" value="{{$action}}">
        <input type="submit" name="submit" value="Setzen">
    </form>
</div>
</body>
</html>