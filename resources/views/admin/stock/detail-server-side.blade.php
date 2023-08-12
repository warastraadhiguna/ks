@include('sweetalert::alert')

<div class="card">
    <div class="card-body">
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <td class="align-middle" width="10%">Tanggal</td>
                    <td class="align-middle" width="1%">:</td>
                    <td width="20%"><input class="form-control" value="{{ $start_date }}" id="start_date" type="date" />
                    </td>
                    <td class="align-middle" width="1%">-</td>
                    <td width="20%"><input class="form-control" value="{{ $end_date }}" id="end_date" type="date" /></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="align-middle">Tampilkan</td>
                    <td class="align-middle">:</td>
                    <td>
                        <select name="show" id="show" class="form-control">
                            <option value="1"{{ $show == "1"? "selected" : "" }}>Tampilkan Stok 0</option>
                            <option value="2" {{ $show == "2"? "selected" : "" }}>Tampilkan Stok > 0</option>
                            <option value="3"{{ $show == "3"? "selected" : "" }}>Tampilkan Stok Semua</option>                            
                        </select>
                    </td>
                    <td></td>
                    <td>
                        <button onclick="filter_page()" class="btn btn-primary"><i class="fa fa-search"
                                aria-hidden="true"></i> Cari</button>
                            </td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<table id="stock-detail-table" class="table table-bordered table-striped table-responsive" style="table-layout:fixed">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Tanggal Stok</th>
            <th>No Barang</th>	
            <th>Nama barang</th>	
            <th>Tipe Barang</th>								
            <th>Keterangan</th>	
            <th>Merek</th>								
            <th>Jenis</th>	            
            <th>Satuan</th>	
            <th>Stok</th>	                                                
            <th>Harga Beli</th>		    
            <th>Harga Jual</th>			
            <th>Tanggal Exp</th>		 
            <th>Note</th>	            
            <th>Admin</th>					
        </tr>
    </thead>
</table>


<script>
function filter_page() {
    var start_date = document.getElementById('start_date').value;
    var end_date = document.getElementById('end_date').value;
    var show = document.getElementById('show').value; 
    var url = window.location + '';
    var index = url.indexOf("?");

    if (index >= 0) {
        url = url.split('?')[0];
    }

    var newUrl = url + '?start_date=' + start_date + '&end_date=' + end_date+ '&show=' + show;

    window.open(newUrl, '_self');
}
</script>

