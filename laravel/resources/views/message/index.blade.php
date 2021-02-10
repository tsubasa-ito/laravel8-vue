@extends('layouts.app')

@section('content')

        <div id="app">
            <example-component></example-component>
            <p>ここはindex.blade.php</p>
        </div>
    <script src="{{ mix('js/app.js') }}"></script>

@endsection
