@include('sweetalert::alert')

<div class="card">
    <div class="card-body">
        <table class="table">
            <tbody>
                <tr>
                    <td class="align-middle">Tampilkan</td>
                    <td class="align-middle">:</td>
                    <td>
                        <input type="number"  id="limit" class="form-control" value="{{ $limit }}"/>                      
                    </td>                    
                    <td class="align-middle"></td>
                    <td>
                        <select name="show" id="show" class="form-control">
                            <option value="1"{{ $show == "1"? "selected" : "" }}>Tampilkan Stok 0</option>
                            <option value="2" {{ $show == "2"? "selected" : "" }}>Tampilkan Stok > 0</option>
                            <option value="3"{{ $show == "3"? "selected" : "" }}>Tampilkan Stok Semua</option>                            
                        </select>
                    </td>

                    <td>
                        <button onclick="filter_page()" class="btn btn-primary"><i class="fa fa-search"
                                aria-hidden="true"></i> Cari</button>
                            </td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<table id="example1" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Barang</th>			
            <th>Info Lain</th>		 		
        </tr>
    </thead>
    <tbody>
        @foreach($stocks as $stock)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>No</td>
                            <td>:</td>
                            <td>{{ $stock->noBarang }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $stock->namaBarang }}</td>
                        </tr>
                        <tr>
                            <td>Satuan</td>
                            <td>:</td>
                            <td>{{ $stock->namaSatuan  }}</td>
                        </tr>                        
                        <tr>
                            <td>Stok</td>
                            <td>:</td>
                            <td>{{ $stock->stok}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>Harga Beli</td>
                            <td>:</td>
                            <td>{{ $stock->hargaBeli }}</td>
                        </tr>
                        <tr>
                            <td>Total Nilai</td>
                            <td>:</td>
                            <td>{{ $stock->nilai }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>           
        </tr>
        @endforeach
    </tbody>
</table>


<script>
function filter_page() {
    var show = document.getElementById('show').value;
    var limit = document.getElementById('limit').value;    
    var url = window.location + '';
    var index = url.indexOf("?");

    if (index >= 0) {
        url = url.split('?')[0];
    }

    var newUrl = url + '?show=' + show+ '&limit=' + limit;

    window.open(newUrl, '_self');
}
</script>