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
		            <td>Supplier</td>            
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
		            <td><?php echo $receipt->caraBayar == 'Tunai'? $receipt->grandTotal  : NumberFormat($receipt->totalCicilan, 2);?></td>   		                       
		          </tr>      
		          <tr>
		            <td>Grand Total</td>            
		            <td><?php echo $receipt->grandTotal;?></td>    
		            <td>Kembali</td>            
		            <td><?php echo $receipt->kembalian;?></td>    		                        
		          </tr>  		
		          <tr>
		            <td>Status</td>            
		            <td><?php echo $receipt->isSelesai == "1"? "Lunas" : "Belum" ;?></td>    
		            <td>Sisa Hutang</td>            
		            <td><?php echo  $receipt->isSelesai == "1"? "00,00" : number_format($receipt->grandTotalAsli - $receipt->totalCicilan,0,",",".") . ',00';?></td>    		                        
		          </tr>                                     
		        </tbody>	      
		      </table>

		      <hr/>
			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-4">
					<h2 style="margin-top:0px">Detail Cicilan</h2>
				</div>
			</div>

			<table class="table table-bordered table-striped table-responsive" id="mytable">
				<thead>
					<tr>
						<th width="20px">No</th>
						<th>Tanggal</th>		
						<th>Nilai</th>							
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
							<td><?php echo $data->tanggal; ?></td>
							<td><?php echo $data->nilai; ?></td>						
						</tr>
					<?php
						$no++;
						}?>
				</tbody>		
			</table>       