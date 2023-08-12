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
                    <td width="10%"></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="align-middle" width="10%">Filter</td>
                    <td class="align-middle" width="1%">:</td>
                    <td width="5%">
                        <select name="caraBayar" id="caraBayar" class="form-control">
								<?php
									if($caraBayar == '4'){
								?>
									<option value="4" selected>Semua</option>
									<option value="1">Cash</option>
									<option value="2">Hutang</option>									
								<?php
									}
									elseif($caraBayar == '1'){
								?>
									<option value="4">Semua</option>
									<option value="1" selected>Cash</option>
									<option value="2">Hutang</option>									
								<?php
									}
									else
									{
										?>
									<option value="4">Semua</option>
									<option value="1">Cash</option>
									<option value="2" selected>Hutang</option>		
									<?php
									}
								?>
                        </select>                        
                    </td>
                    <td class="align-middle" width="1%"></td>
                    <td width="5%">
							<select name="status" id ="status" class="form-control">		
								<?php
									if($status == '4'){
								?>
									<option value="4" selected>Semua</option>
									<option value="1">Lunas</option>
									<option value="2">Belum</option>									
								<?php
									}
									elseif($status == '1'){
								?>
									<option value="4">Semua</option>
									<option value="1" selected>Lunas</option>
									<option value="2">Belum</option>										
								<?php
									}
									else
									{
										?>
									<option value="4">Semua</option>
									<option value="1">Lunas</option>
									<option value="2" selected>Belum</option>	
										<?php
									}
								?>
							</select>    

                    </td>
                    <td width="10%"><button onclick="filter_page()" class="btn btn-primary"><i class="fa fa-search"
                                aria-hidden="true"></i> Cari</button></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

<table id="receipt-purchasing-table" class="table table-bordered table-striped table-responsive" width="100%">
    <thead>
        <tr>
            <th width="40px">No</th>
            <th>No Nota</th>	
            <th>Supplier</th>	
            <th>Grand Total</th>							
            <th>Tanggal Nota</th>		    
            <th>Cara Bayar</th>			
            <th>Kasir</th>	
            <th>Status</th>	
            <th width="15%">Action</th>
        </tr>
    </thead>
</table>


<script>
function filter_page() {
    var start_date = document.getElementById('start_date').value;
    var end_date = document.getElementById('end_date').value;
    var status = document.getElementById('status').value;
    var caraBayar = document.getElementById('caraBayar').value;    
    var url = window.location + '';
    var index = url.indexOf("?");

    if (index >= 0) {
        url = url.split('?')[0];
    }

    var newUrl = url + '?start_date=' + start_date + '&end_date=' + end_date + '&status=' + status + '&caraBayar=' + caraBayar;

    window.open(newUrl, '_self');
}
</script>