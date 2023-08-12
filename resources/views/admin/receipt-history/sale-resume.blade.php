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

<table class="table table-bordered table-striped" id="mytable">
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
    <td>Total Penjualan</td>            
    <td class="text-right"><?php echo number_format($totalPenjualanHariIni,0,",",".") ;?></td>                 
    </tr>
    <tr>
    <td>2</td>
    <td>Total Modal</td>            
    <td class="text-right"><?php echo number_format($totalPembelianHariIni,0,",",".") ;?></td>                 
    </tr>          
    <tr>
    <td>3</td>
    <td>Total Laba</td>            
    <td class="text-right"><?php echo number_format($totalPenjualanHariIni - $totalPembelianHariIni,0,",",".") ;?></td>                 
    </tr>   
    <tr>
    <td>4</td>
    <td>Margin Laba</td>            
    <td class="text-right">
    <?php 
        if($totalPenjualanHariIni == 0) echo 0;
        else echo number_format(100*(($totalPenjualanHariIni - $totalPembelianHariIni)/$totalPenjualanHariIni),3,",",".") . "%";
        
    ?></td>                 
    </tr>   
    <tr>
    <td>5</td>
    <td>Total Nota</td>            
    <td class="text-right"><?php echo number_format($totalNotaHariIni,0,",",".") ;?></td>                 
    </tr>  		  
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