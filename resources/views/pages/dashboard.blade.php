@extends('app')
@section('page-title')
    Dashboard
@endsection
@section('content')
    <h1>Dashboard</h1>
    <iframe src="{{ $dashboard ? $dashboard : config('web-settings.default.dashboard_url') }}" class="w-100" style="height: 50vh" allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
@endsection
