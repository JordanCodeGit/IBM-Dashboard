<div class="table-responsive">
    <table class="table table-hover table-bordered" style="width: 110vw">
        <thead class="table-success text-center align-middle">
          <tr>
            <th scope="col" rowspan="2">#</th>
            <th scope="col" rowspan="2">Salesman</th>
            <th scope="col" rowspan="2">Periode</th>
            <th scope="col" colspan="4">Absensi</th>
            <th scope="col" colspan="4">Sales Reguler</th>
            <th scope="col" colspan="4">Sales Kategori</th>
            <th scope="col" colspan="4">Toko Aktif</th>
            <th scope="col" colspan="4">Penagihan</th>
            <th scope="col" rowspan="2">Total Poin</th>
          </tr>
          <tr>
            <th scope="col">Target</th>
            <th scope="col">Pencapaian</th>
            <th scope="col">%</th>
            <th scope="col">Poin</th>
            <th scope="col">Target</th>
            <th scope="col">Pencapaian</th>
            <th scope="col">%</th>
            <th scope="col">Poin</th>
            <th scope="col">Target</th>
            <th scope="col">Pencapaian</th>
            <th scope="col">%</th>
            <th scope="col">Poin</th>
            <th scope="col">Target</th>
            <th scope="col">Pencapaian</th>
            <th scope="col">%</th>
            <th scope="col">Poin</th>
            <th scope="col">Target</th>
            <th scope="col">Pencapaian</th>
            <th scope="col">%</th>
            <th scope="col">Poin</th>
          </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($kpi as $performa)
                <tr>
                    <th scope="row">{{$counter}}</th>
                    <td>{{$performa->salesman->nama}}</td>
                    <td>{{date('F', strtotime($performa->periode))}}</td>
                    <td>{{$performa->absensi->target}}</td>
                    <td>{{$performa->absensi->pencapaian}}</td>
                    <td>{{$performa->absensi->persentase * 100}}%</td>
                    <td>{{$performa->absensi->poin}}</td>
                    <td>Rp. {{number_format($performa->reguler->target)}}</td>
                    <td>Rp. {{number_format($performa->reguler->pencapaian)}}</td>
                    <td>{{$performa->reguler->persentase * 100}}%</td>
                    <td>{{$performa->reguler->poin}}</td>
                    <td>Rp. {{number_format($performa->kategori->target)}}</td>
                    <td>Rp. {{number_format($performa->kategori->pencapaian)}}</td>
                    <td>{{$performa->kategori->persentase * 100}}%</td>
                    <td>{{$performa->kategori->poin}}</td>
                    <td>{{$performa->toko->target}}</td>
                    <td>{{$performa->toko->pencapaian}}</td>
                    <td>{{$performa->toko->persentase * 100}}%</td>
                    <td>{{$performa->toko->poin}}</td>
                    <td>Rp. {{number_format($performa->penagihan->target)}}</td>
                    <td>Rp. {{number_format($performa->penagihan->pencapaian)}}</td>
                    <td>{{$performa->penagihan->persentase * 100}}%</td>
                    <td>{{$performa->penagihan->poin}}</td>
                    <td>{{$performa->total_poin}}</td>
                </tr>
                @php
                    $counter++;
                @endphp
            @endforeach
        </tbody>
      </table>
</div>
