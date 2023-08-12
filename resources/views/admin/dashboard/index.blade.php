<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body bg-primary">
                Selamat data {{  auth()->user()->name }} di halaman admin 😊
            </div>
        </div>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="80px">No</th>
            <th>Jenis Info</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Total Penjualan Hari Ini</td>
            <td class="text-right">{{ NumberFormat($totalPenjualanHariIni) }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Total Modal Hari Ini</td>
            <td class="text-right">{{ NumberFormat($totalPembelianHariIni)}}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Total Laba Hari Ini</td>
            <td class="text-right">
                {{ NumberFormat($totalPenjualanHariIni - $totalPembelianHariIni)}}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Margin Laba Hari Ini</td>
            <td class="text-right">
                {{ $totalPenjualanHariIni == 0? "0": NumberFormat(100*(($totalPenjualanHariIni - $totalPembelianHariIni)/$totalPenjualanHariIni),3)}}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Total Nota Hari Ini</td>
            <td class="text-right">{{ NumberFormat($totalNotaHariIni)}}</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Total Stok Hari Ini</td>
            <td class="text-right">{{ NumberFormat($totalStokHariIni)}}</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Total Hutang Hari Ini</td>
            <td class="text-right">{{ NumberFormat($totalHutangHariIni)}}</td>
        </tr>
        <tr>
            <td>8</td>
            <td>Leverage Hari Ini</td>
            <td class="text-right">
                {{ NumberFormat($totalHutangHariIni / $totalStokHariIni * 100, 2)}}%</td>
        </tr>
    </tbody>

    </tbody>
</table>