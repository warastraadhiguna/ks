@include('sweetalert::alert')

<div class="card">
    <div class="card-body">
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <td class="align-middle" width="10%">Tanggal</td>
                    <td class="align-middle" width="1%">:</td>
                    <td width="5%"><input class="form-control" value="{{ $start_date }}" id="start_date" type="date" />
                    </td>
                    <td class="align-middle" width="1%">:</td>
                    <td width="5%"><input class="form-control" value="{{ $end_date }}" id="end_date" type="date" /></td>
                    <td width="10%"><button onclick="filter_page()" class="btn btn-primary"><i class="fa fa-search"
                                aria-hidden="true"></i> Cari</button></td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

<table id="example1" class="table table-bordered table-striped table-responsive" width="100%">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Data Nota</th>
            <th>Data Pembayaran</th>
            <th>Kasir</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($receipts as $receipt)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>No Nota</td>
                            <td>:</td>
                            <td>{{ $receipt->noNota }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Nota</td>
                            <td>:</td>
                            <td>{{ $receipt->tanggalNota }}</td>
                        </tr>
                        <tr>
                            <td>Cara Bayar</td>
                            <td>:</td>
                            <td>{{ $receipt->caraBayar == "1" ? "Cash" :  ($receipt->caraBayar == "2"? "Debit" : "CC")}}
                            </td>
                        </tr>
                        <tr>
                            <td>Member</td>
                            <td>:</td>
                            <td>{{ $receipt->namaShopHolder  }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td>{{ $receipt->totalSebelumDiskon }}</td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>:</td>
                            <td>{{ $receipt->diskon }}</td>
                        </tr>
                        <tr>
                            <td>Potongan</td>
                            <td>:</td>
                            <td>{{ $receipt->potongan }}</td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>:</td>
                            <td>{{ $receipt->grandTotal }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td class="align-middle">{{ $receipt->namaUser  }}</td>
            <td class="align-middle text-center">
                <a type="button" href="{{ URL::to('/admin/receipt/detail-sale/' . $receipt->noNota); }}" class="btn btn-info" title="Lihat Detail"><i class="fas fa-search" aria-hidden="true"></i></a>
                <a type="button"  href="{{ URL::to('/admin/receipt/return-sale/' . $receipt->noNota); }}" class="btn btn-warning" title="Lihat Retur"><i class="fas fa-sync" aria-hidden="true"></i></a>                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<script>
function filter_page() {
    var start_date = document.getElementById('start_date').value;
    var end_date = document.getElementById('end_date').value;
    var url = window.location + '';
    var index = url.indexOf("?");

    if (index >= 0) {
        url = url.split('?')[0];
    }

    var newUrl = url + '?start_date=' + start_date + '&end_date=' + end_date;

    window.open(newUrl, '_self');
}
</script>