@extends('app')
@section('page-title')
    Salesman Summary
@endsection
@section('content')
    <h1>Selamat datang, [nama]</h1>
    {!! $charts[0]->container() !!}
    <div class="w-10">
        {{ $charts->links() }}
    </div>
@endsection
@section('script')
    <script src="{{ $charts[0]->cdn() }}"></script>
    {{ $charts[0]->script() }}
@endsection
