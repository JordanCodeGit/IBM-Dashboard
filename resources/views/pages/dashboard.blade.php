@extends('app')
@section('page-title')
    Dashboard
@endsection
@section('content')
    <h1>Selamat datang, [nama]</h1>
    {!! $charts[0]->container() !!}
    <h1>Sales Individu</h1>
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Testimonial</h6>
        <div class="owl-carousel testimonial-carousel">
            {{-- @for ($i = 1; $i < 25; $i++)
                {{ $charts[$i]->container() }}
            @endfor --}}
            {{-- <div class="testimonial-item text-center">
                <img class="img-fluid rounded-circle mx-auto mb-4" src="img/testimonial-2.jpg" style="width: 100px; height: 100px;">
                <h5 class="mb-1">Client Name</h5>
                <p>Profession</p>
                <p class="mb-0">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
            </div> --}}
        </div>
    </div>
    {{ $charts->onEachSide(1)->links() }}
    <div class="w-100">
        {{ $charts->links() }}
    </div>
@endsection
@section('script')
    <script src="{{ $charts[0]->cdn() }}"></script>
    {{ $charts[0]->script() }}
    {{-- @for ($i = 1; $i < 25; $i++)
        <script src="{{ $charts[$i]->cdn() }}"></script>
        {{ $charts[$i]->script() }}
    @endfor --}}
    {{-- <script src="{{ asset('js/dashboard.js') }}"></script> --}}
@endsection
