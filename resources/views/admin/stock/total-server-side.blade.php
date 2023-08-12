@include('sweetalert::alert')

<div class="card">
    <div class="card-body">
        <table class="table table-responsive">
            <tbody>
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

<table id="stock-total-table" class="table table-bordered table-striped table-responsive"  width="100%" style="table-layout:fixed">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>No Barang</th>	
            <th>Nama barang</th>	
            <th>Tipe Barang</th>     
            <th>Merek</th>     
            <th>Jenis</th>              
            <th>Satuan</th>	
            <th>Stok</th>	                                                
            <th>Harga Beli</th>		    
            <th>Total Nilai</th>					
        </tr>
    </thead>
</table>


<script>
function filter_page() {
    var show = document.getElementById('show').value; 
    var url = window.location + '';
    var index = url.indexOf("?");

    if (index >= 0) {
        url = url.split('?')[0];
    }

    var newUrl = url + '?show=' + show;

    window.open(newUrl, '_self');
}
</script>

