@extends('layouts.app')

@section('content')

@guest
    this is guest page.

@else
    this is logind page.
    <index-component user-id= {{ Auth::id() }} ></index-component>
@endguest

@endsection
