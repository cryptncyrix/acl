@extends('Acl::layout/layout')
@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="col-sm-8 offset-md-2 py-2 text-center form">

        <p> Name: {{ auth()->user()->name  }}</p>
        <p> Rollen:
        @if(config('acl.acl.superAdmin') == auth()->user()->id)
            < superAdmin >
        @endif
        @foreach(auth()->user()->roles as $value)
         {{ '< '.$value['name'].' >' }}
        @endforeach
        </p>
        <p> Rechte:
            @foreach(auth()->user()->resources as $value)
                {{ '< '.$value['name'].' >' }}
            @endforeach
        </p>
    </div>
    </body>
    </html>
@endsection