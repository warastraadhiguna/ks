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

<table id="receipt-sale-table" class="table table-bordered table-striped table-responsive" width="100%">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>No Nota</th>		
            <th>Tanggal Nota</th>		    
            <th>Total</th>			
            <th>Diskon</th>		 
            <th>Potongan</th>		
            <th>Grand Total</th>		    
            <th>Cara Bayar</th>			
            <th>Kasir</th>	
            <th>Member</th>		
            <th width="15%">Action</th>
        </tr>
    </thead>
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