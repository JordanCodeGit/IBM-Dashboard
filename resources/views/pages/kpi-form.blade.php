@extends('app')
@section('page-title')
    Salesman KPI
@endsection
@section('content')
    <div class="container">
        @session('message')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession
        <h1>Salesman Key Performance Index Form</h1>
        <form action="" method="POST">
            @csrf
            <h5>Salesman</h5>
            <div class="form-floating mb-3 w-50">
                <select class="form-select" id="floatingSelect" required name="salesman">
                    @if ($salesmen->isEmpty())
                        <option value="" selected disabled>There's no salesman available.</option>
                    @else
                        @foreach ($salesmen as $salesman)
                            <option value="{{$salesman->id_salesman}}">{{$salesman->nama}}</option>
                        @endforeach
                    @endif
                </select>
                <label for="floatingSelect">Salesman</label>
            </div>
            <h5>Periode</h5>
            <input required type="date" class="form-control mb-3 w-50" name="periode" placeholder="periode">
            <h5>Absensi</h5>
            <input required type="number" class="form-control mb-3 w-50" min="0" name="absen-target" placeholder="Target">
            <input required type="number" class="form-control mb-3 w-50" min="0" name="absen-pencapaian" placeholder="Pencapaian">
            <input required type="number" class="form-control mb-3 w-50" min="0" max="5" step="0.1" name="absen-poin" placeholder="Poin">
            <h5>Sales Reguler</h5>
            <input required type="number" class="form-control mb-3 w-50" min="0" name="reg-target" placeholder="Target">
            <input required type="number" class="form-control mb-3 w-50" min="0" name="reg-pencapaian" placeholder="Pencapaian">
            <input required type="number" class="form-control mb-3 w-50" min="0" max="30" step="0.1" name="reg-poin" placeholder="Poin">
            <h5>Sales Kategori</h5>
            <input required type="number" class="form-control mb-3 w-50" min="0" name="kat-target" placeholder="Target">
            <input required type="number" class="form-control mb-3 w-50" min="0" name="kat-pencapaian" placeholder="Pencapaian">
            <input required type="number" class="form-control mb-3 w-50" min="0" max="20" step="0.1" name="kat-poin" placeholder="Poin">
            <h5>Toko Aktif</h5>
            <input required type="number" class="form-control mb-3 w-50" min="0" name="toko-target" placeholder="Target">
            <input required type="number" class="form-control mb-3 w-50" min="0" name="toko-pencapaian" placeholder="Pencapaian">
            <input required type="number" class="form-control mb-3 w-50" min="0" max="15" step="0.1" name="toko-poin" placeholder="Poin">
            <h5>Penagihan</h5>
            <input required type="number" class="form-control mb-3 w-50" min="0" name="tagih-target" placeholder="Target">
            <input required type="number" class="form-control mb-3 w-50" min="0" name="tagih-pencapaian" placeholder="Pencapaian">
            <input required type="number" class="form-control mb-3 w-50" min="0" max="30" step="0.1" name="tagih-poin" placeholder="Poin">
            <button class="btn btn-primary" type="submit">Simpan KPI</button>
        </form>
    </div>
@endsection
