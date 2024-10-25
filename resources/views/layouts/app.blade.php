// app.blade.php
<!DOCTYPE html>
<html>
<head>
    @include('layouts.head')
</head>
<body>
    @include('layouts.nav')
    @yield('content')
    @include('components.footer')
    @include('layouts.scripts')
</body>
</html>

@extends('layouts.app')

@section('content')
    @include('components.hero')
    @include('components.cards')
    @include('components.resources')
    @include('components.contact')
    @include('components.chat-widget')
@endsection
