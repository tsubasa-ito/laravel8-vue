@extends('layouts.app')

@section('content')

@auth
    <mypage-component user-id= {{ Auth::id() }} ></mypage-component>
@endauth

@endsection
