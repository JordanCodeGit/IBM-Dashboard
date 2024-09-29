@extends('app')
@section('page-title')
    Dashboard
@endsection
@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <iframe src="{{ $dashboard ? $dashboard : config('web-settings.default.dashboard_url') }}" style="width: 70%; height: 90vh;" allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
    </div>
@endsection
