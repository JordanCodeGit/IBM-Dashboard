<h3>Daily Sales Data</h3>
@if ($count == 0)
    <p class="text-secondary">There is no new data today.</p>
@endif
@php
    // Find the Transaksi with the most Transaksi_Barang
    $maxTransaksi = $count ? $daily->sortByDesc(fn($t) => $t->transaksi_barang->count())->first() : null;

    // Get the maximum count of Transaksi_Barang
    $maxCount = $maxTransaksi ? $maxTransaksi->transaksi_barang->count() : 0;
@endphp
<div class="table-responsive mb-4">
    <table class="table table-hover" style="width: {{$maxCount == 0 ? 'initial' : (100 * $maxCount).'vw'}}">
        <thead class="table-primary">
            <tr>
                <th scope="col">ID Transaksi</th>
                <th scope="col">Salesman</th>
                <th scope="col">Tanggal</th>
                @for ($i = 1; $i <= $maxCount; $i++)
                    <th scope="col">Kode Barang {{$i}}</th>
                    <th scope="col">Nama Barang {{$i}}</th>
                    <th scope="col">Kuantitas Barang {{$i}}</th>
                    <th scope="col">Harga Barang {{$i}}</th>
                    <th scope="col">Pengajuan Harga {{$i}}?</th>
                    <th scope="col">Pengajuan Harga {{$i}}</th>
                    <th scope="col">Total Harga Barang {{$i}}</th>
                    <th scope="col">Keterangan Barang {{$i}}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($daily as $transaksi)
                <tr>
                    <th scope="row">{{$transaksi->kode_transaksi}}</th>
                    <td>{{$transaksi->salesman->nama}}</td>
                    <td>{{$transaksi->tanggal}}</td>
                    @foreach ($transaksi->transaksi_barang as $transaksi_barang)
                        <td>{{$transaksi_barang->barang->kode_barang}}</td>
                        <td>{{$transaksi_barang->barang->nama}}</td>
                        <td>{{$transaksi_barang->kuantitas}}</td>
                        <td>Rp. {{$transaksi_barang->barang->harga}},-</td>
                        @if ($transaksi_barang->negosiasi)
                            <td>Ya</td>
                            <td>Rp. {{$transaksi_barang->harga_nego}},-</td>
                        @else
                            <td>Tidak</td>
                            <td>-</td>
                        @endif
                        <td>{{$transaksi_barang->total}}</td>
                        <td>{{$transaksi_barang->keterangan == '' ? '-' : $transaksi_barang->keterangan}}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$daily->appends(['tab' => 'daily'])->links()}}
