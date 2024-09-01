@extends('app')
@section('page-title')
    Help and Guides
@endsection
@section('content')
    <div class="container">
        <h1>Help and Guides</h1>
        <hr>
        <h2 id="api">API</h2>
        <p>You can use the API links below for third-party app uses or other things,</p>
        <h5>Salesman</h5>
        <ul>
            <li>
                <a href="/api/salesman/get">https://{{$domain}}/api/salesman/get</a>
                <p>Get all salesman data.</p>
            </li>
            <li>
                <a href="/api/salesman/get/daily">https://{{$domain}}/api/salesman/get/daily</a>
                <p>Get all salesman data that is created today.</p>
            </li>
            <li>
                <a href="/api/salesman/get/monthly">https://{{$domain}}/api/salesman/get/monthly</a>
                <p>Get all salesman data that is created this month.</p>
            </li>
            <li>
                https://{{$domain}}/api/salesman/get/{id}
                <p>Get all data for one salesman by id.</p>
            </li>
            <li>
                https://{{$domain}}/api/salesman/get/{id}/daily
                <p>Get data for one salesman that is created today.</p>
            </li>
            <li>
                https://{{$domain}}/api/salesman/get/{id}/monthly
                <p>Get data for one salesman that is created this month.</p>
            </li>
        </ul>
        <p>*Note : Replace the '{id}' with a number from {{$firstID}} to {{$firstID + 23}}</p>
    </div>
@endsection
