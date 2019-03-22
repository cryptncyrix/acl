@extends('AclView::layout/layout')

@section('content')
<div class="col-sm-8 offset-md-2 py-2 text-center form">
    <h1>401 <i class="fa fa-1x fa-lock"></i> {{__('AclLang::exception.error_authorized')}}</h1>
    <p>{{__('AclLang::exception.unauthorized')}}</p>
    <a class="btn btn-lg btn-outline-dark" href="{{ route('login')}}"> {{__('AclLang::exception.back_login')}} </a>
</div>
@endsection
