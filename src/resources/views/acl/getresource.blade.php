@extends('Acl::layout/layout')
@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h3>Berechtigungen anpassen für {{ $from->name }}</h3>
    <div class="col-sm-8 offset-md-2 py-2 text-center">
    <form action="{{route('acl.setPermissions')}}" method="POST">
        @csrf
    <table id="role" class="table table-striped table-hover table-bordered table-dark" cellspacing="0" width="100%">
        <caption class="text-center"> <i class="fa fa-plus"></i> Hinzufügen zu {{ $from->name }} </caption>
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
                <td>@if(isset($value[0]) && $value[0] == 1)
                        <i class='fa fa-check'></i>
                    @else
                        <i class='fa fa-ban'></i>
                    @endif
                </td>
                <td>

                    Set <input id="{{$key}}" type="radio" name="new[{{$key}}]" value=1 {{(isset($value[0]) && $value[0] == 1) ? 'checked="checked"' : ""}}>
                    Remove <input id="{{$key}}" type="radio" name="new[{{$key}}]" value=0 {{(isset($value[0]) && $value[0] != 1) ? 'checked="checked"' : "" }}>
                    <input type="hidden" name="old[{{$key}}]" value="{{$value[0]}}"></td>
            </tr>
        @endforeach

        </tbody>
    </table>
        <input type="hidden" name="_id" value="{{$id}}">
        <input type="hidden" name="action" value="{{$action}}">
        <input type="submit" name="submit" value="Setzen">
    </form>
</div>
@endsection