@extends('layouts.app')

@section('content')

@guest
    this is guest page.

@else
    this is logind page.
    <index-component></index-component>
@endguest

@endsection
