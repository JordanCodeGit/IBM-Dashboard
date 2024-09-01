@extends('app')
@section('page-title')
    Settings
@endsection
@section('content')
    <div class="container">
        @session('type')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            @if (session('type') == 'fetch')
                Data fetched successfully!
            @elseif (session('type') == 'delete')
                Data deleted successfully.
            @elseif (session('type') == 'reset')
                Database reset.
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endsession
        <h1>Settings</h1>
        <hr>
        <section>
            <h3>Get Data</h3>
            <p>Get all data from spreadsheet. After pressing the button, don't forget to run `artisan queue:work`.</p>
            <a class="btn btn-primary" href={{route('debug.fetch')}}>Get all data</a>
        </section>
        <hr>
        <section>
            <h3>Clear Data</h3>
            <p>Delete all data from database.</p>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Delete all data
            </button>
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="exampleModalLabel">Warning!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>You are about to <strong class="text-danger text-uppercase">delete all data</strong> from the database. Are you sure?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, go back.</button>
                            <a class="btn btn-danger" href={{route('debug.delete')}}>Yes, delete all of the data</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section>
            <h3>Reset Database</h3>
            <p>Delete database schema and make a new one.</p>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#resetModal">
                Reset schema
            </button>
            <div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="exampleModalLabel">Warning!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>You are about to <strong class="text-danger text-uppercase">reset the whole database schema</strong> for this application. Are you sure?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, go back.</button>
                            <a class="btn btn-danger" href={{route('debug.reset')}}>Reset schema</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
