			<div class="receipt" style="margin-bottom: 10px">
				<div class="col-md-4">
					<h2 style="margin-top:0px">Info Penjualan</h2>
				</div>
			</div>

		      <table class="table table-bordered table-striped" width="100%">
		        <tbody>
		          <tr>
		            <td>No Nota</td>            
		            <td><?php echo $receipt->noNota;?></td>                
		            <td>Cara Bayar</td>            
		            <td><?php echo $receipt->caraBayar;?></td>    		             
		          </tr>
		          <tr>
		            <td>Tanggal </td>            
		            <td><?php echo $receipt->tanggalNota;?></td>     
		            <td>Kasir</td>            
		            <td><?php echo $receipt->namaUser;?></td>    		                         
		          </tr>
		          <tr>
		            <td>Total</td>            
		            <td><?php echo $receipt->totalSebelumDiskon;?></td>         
		            <td>Member</td>            
		            <td><?php echo $receipt->namaShopHolder;?></td>    		                   
		          </tr>
		          <tr>
		            <td>Diskon</td>            
		            <td><?php echo $receipt->diskon;?></td>    
		            <td>Keterangan</td>            
		            <td><?php echo $receipt->keterangan;?></td>    		                         
		          </tr>          
		          <tr>
		            <td>Potongan</td>            
		            <td><?php echo $receipt->potongan;?></td>     
		            <td>Bayar</td>            
		            <td><?php echo $receipt->bayar;?></td>    		                       
		          </tr>      
		          <tr>
		            <td>Grand Total</td>            
		            <td><?php echo $receipt->grandTotal;?></td>    
		            <td>Kembali</td>            
		            <td><?php echo $receipt->kembalian;?></td>    		                        
		          </tr>  		                 
		        </tbody>	      
		      </table>

		      <hr/>
			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-4">
					<h2 style="margin-top:0px">Detail Penjualan</h2>
				</div>
			</div>

			<table class="table table-bordered table-striped" id="mytable">
				<thead>
					<tr>
						<th width="20px">No</th>
						<th>Kode Barang</th>		
						<th>Nama Barang</th>		    
						<th>Qty</th>		
						<th>Satuan</th>									
						<th>Harga</th>		 
						<th>Subtotal</th>	
					</tr>
				</thead>	
				<tbody>
					<?php 
						$no = 1;
						foreach($details as $data) 
							{
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data->noBarang; ?></td>
							<td><?php echo $data->namaBarang; ?></td>
							<td><?php echo $data->qtyTampil; ?></td>
							<td><?php echo $data->namaSatuan; ?></td>							
							<td><?php echo number_format($data->hargaJualSatuan,0,",",".");?></td>
							<td><?php echo number_format($data->qtyTampil * $data->hargaJualSatuan,0,",","."); ?></td>
						</tr>
					<?php
						$no++;
						}?>
				</tbody>		
			</table>              