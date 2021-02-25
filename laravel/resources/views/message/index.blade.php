@extends('layouts.app')

@section('content')

<index-component  user-id= {{ Auth::id() }}></index-component>

@endsection
