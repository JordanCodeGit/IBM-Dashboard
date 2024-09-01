@extends('app')
@section('page-title')
    Dashboard
@endsection
@section('content')
    <h1>Dashboard</h1>
    {!! $chart->container() !!}
@endsection
@section('script')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection
