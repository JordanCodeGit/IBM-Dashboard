@extends('app')
@section('page-title')
    Salesman Summary
@endsection
@section('content')
    <div class="container">
        <h1>Salesman</h1>
        <p>General page for salesman data.</p>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link {{ !request('tab') ? 'active' : '' }}" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="false">General</button>
                <button class="nav-link {{ request('tab') == 'daily' ? 'active' : '' }}" id="nav-daily-tab" data-bs-toggle="tab" data-bs-target="#nav-daily" type="button" role="tab" aria-controls="nav-daily" aria-selected="false">Daily Report</button>
                <button class="nav-link {{ request('tab') == 'monthly' ? 'active' : '' }}" id="nav-monthly-tab" data-bs-toggle="tab" data-bs-target="#nav-monthly" type="button" role="tab" aria-controls="nav-monthly" aria-selected="true">Monthly Report</button>
            </div>
        </nav>
        <div class="tab-content pt-3" id="nav-tabContent">
            <div class="tab-pane fade {{ !request('tab') ? 'show active' : '' }}" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                @include('components.tabs.general', ['general' => $general])
            </div>
            <div class="tab-pane fade {{ request('tab') == 'daily' ? 'show active' : '' }}" id="nav-daily" role="tabpanel" aria-labelledby="nav-daily-tab">
                @include('components.tabs.daily', ['daily' => $daily])
            </div>
            <div class="tab-pane fade {{ request('tab') == 'monthly' ? 'show active' : '' }}" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                @include('components.tabs.monthly', ['monthly' => $monthly])
            </div>
        </div>
    </div>
@endsection
