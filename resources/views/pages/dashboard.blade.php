@extends('app')
@section('page-title')
    Dashboard
@endsection
@section('content')
    <h1>Selamat datang</h1>
    @if (session('type') !== null)
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            @if (session('type') == 'fetch')
                                <p>Script executed. Run `php artisan queue:work` in the command prompt / shell terminal.</p>
                            @elseif (session('type') == 'delete')
                                <p>All data deleted.</p>
                            @elseif (session('type') == 'reset')
                                <p>Schema resets successfully.</p>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Understood</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {!! $chart->container() !!}
    <div class="d-flex w-50 justify-content-around align-items-center">
        <a class="btn btn-danger w-100 m-2" href={{route('debug.reset')}}>Reset schema</a>
        <a class="btn btn-danger w-100 m-2" href={{route('debug.delete')}}>Delete all data</a>
        <a class="btn btn-primary w-100 m-2" href={{route('debug.fetch')}}>Get all data</a>
    </div>
    {{-- <h1>Sales Individu</h1>
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Testimonial</h6>
        <div class="owl-carousel testimonial-carousel">
            @for ($i = 1; $i < 25; $i++)
                {{ $charts[$i]->container() }}
            @endfor
            <div class="testimonial-item text-center">
                <img class="img-fluid rounded-circle mx-auto mb-4" src="img/testimonial-2.jpg" style="width: 100px; height: 100px;">
                <h5 class="mb-1">Client Name</h5>
                <p>Profession</p>
                <p class="mb-0">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
            </div>
        </div>
    </div> --}}
@endsection
@section('script')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

    @if (session('type') !== null)
        <script type="text/javascript">
            $(document).ready(function() {
                $('#staticBackdrop').modal('show');
            });
        </script>
    @endif
@endsection
