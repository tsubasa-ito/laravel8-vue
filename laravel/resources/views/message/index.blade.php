@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    {{-- @if (count($messages) > 0) --}}
        {{-- <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>メッセージ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}
        <div id="app">
            <example-component></example-component>
            <p>ここはindex.blade.php</p>
        </div>
    <script src="{{ mix('js/app.js') }}"></script>
    {{-- @endif --}}

@endsection
