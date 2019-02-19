@extends('Acl::layout/layout')
@section('content')
    <div class="form">
        <h3>Create {{ ucfirst($action)  }}</h3>
        <form  method="POST" action="{{ route($action.'.store') }}">
            @csrf
            <input type="text" name="name" placeholder="name">
            <input type="text" name="info" placeholder="Description - Max Length 191 Signs">
            Active <input type="radio" name="default_access" value=1>
            Disabled <input type="radio" name="default_access" value=0>
            <input type="submit" name="submit" value="Add">
        </form>
    </div>
@endsection
