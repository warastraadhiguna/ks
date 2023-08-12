






  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ URL::to('/'); }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::to('/'); }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::to('/'); }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ URL::to('/'); }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Summernote -->
<script src="{{ URL::to('/'); }}/plugins/summernote/summernote-bs4.min.js"></script>
{{-- <script src="{{ URL::to('/'); }}/dist/js/demo.js"></script> --}}
<script src="{{ URL::to('/'); }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ URL::to('/'); }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{ URL::to('/'); }}/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

  })
</script>
<script>
  $(function () {
    $("#example1").DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],"responsive": true, "lengthChange": true, "autoWidth": true,
      "buttons": ["copy", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'print',
            'pdfHtml5'
        ],
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": false,        
    } );
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })    
  });
 

</script>


@if(Request::is('admin/stock/detail')) 
<script>
    $(function() {
        $('#stock-detail-table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,          
            responsive: true,      
            autoWidth: true,
            
            // ajax: '{!! route('stock.detail') !!}', // memanggil route yang menampilkan data json
            ajax: {
                "url": "{!! route('stock.detail') !!}",
                "data": function(data) {
                    data.start_date = '{!! $start_date !!}';
                    data.end_date = '{!! $end_date !!}';
                    data.show = '{!! $show !!}"';                                        
                },
            },                
            columns: [
                { // mengambil & menampilkan kolom sesuai tabel database
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false                        
                },
                {
                    data: 'tanggalStok',
                    name: 'tanggalStok',
                    orderable: false,                    
                    searchable: false                              
                },                
                {
                    data: 'noBarang',
                    name: 'noBarang'
                },
                {
                    data: 'namaBarang',
                    name: 'namaBarang'
                },       
                {
                    data: 'typeBarang',
                    name: 'typeBarang'
                },  
                {
                    data: 'catatan',
                    name: 'catatan'
                },  
                {
                    data: 'namaMerek',
                    name: 'namaMerek'
                },  
                {
                    data: 'namaJenisBarang',
                    name: 'namaJenisBarang'
                },                                                                  
                {
                    data: 'namasatuan',
                    name: 'namasatuan',
                    orderable: false,
                    searchable: false                              
                },   
                {
                    data: 'stok',
                    name: 'stok',
                    orderable: false,
                    searchable: false                               
                },                                                                            
                {
                    data: 'hargaBeli',
                    name: 'hargaBeli',
                    orderable: false,
                    searchable: false                             
                },
                {
                    data: 'hargaJual',
                    name: 'hargaJual',
                    orderable: false,
                    searchable: false                             
                },     
                {
                    data: 'tglExpired',
                    name: 'tglExpired',
                    orderable: false,
                    searchable: false                             
                },       
                {
                    data: 'note',
                    name: 'note',
                    orderable: false,
                    searchable: false                             
                }, 
                {
                    data: 'namaUser',
                    name: 'namaUser',
                    orderable: false,
                    searchable: false                             
                },                                                                
            ],           
            dom   : 'Bfrtip',
            buttons : ["copy", "excel", "pdf", "print"],                  
        });
    });
</script>
@endif

@if(Request::is('admin/stock/total')) 
<script>
    $(function() {
        $('#stock-total-table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,          
            responsive: true,      
            autoWidth: true,
            ajax: {
                "url": "{!! route('stock.total') !!}",
                "data": function(data) {
                    data.show = '{!! $show !!}';                                        
                },
            },             
            columns: [
                { // mengambil & menampilkan kolom sesuai tabel database
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false                        
                },
                {
                    data: 'noBarang',
                    name: 'noBarang'
                },
                {
                    data: 'namaBarang',
                    name: 'namaBarang'
                },       
                {
                    data: 'typeBarang',
                    name: 'typeBarang'
                },  
                {
                    data: 'namaMerek',
                    name: 'namaMerek'
                },  
                {
                    data: 'namaJenisBarang',
                    name: 'namaJenisBarang'
                },                                                  
                {
                    data: 'namaSatuan',
                    name: 'namaSatuan',
                    orderable: false,
                    searchable: false                              
                },   
                {
                    data: 'sumStok',
                    name: 'sumStok',
                    orderable: false,
                    searchable: false                               
                },                         
                {
                    data: 'hargaBeli',
                    name: 'hargaBeli',
                    orderable: false,
                    searchable: false                             
                },
                {
                    data: 'nilai',
                    name: 'nilai',
                    orderable: false,
                    searchable: false                             
                },                                                                
            ],           
            dom   : 'Bfrtip',
            buttons : ["copy", "excel", "pdf", "print"],                  
        });
    });
</script>
@endif

@if(Request::is('admin/receipt/sale')) 
<script>
    $(function() {
        $('#receipt-sale-table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,          
            responsive: true,      
            autoWidth: true,
            ajax: {
                "url": "{!! route('receipt.sale') !!}",
                "data": function(data) {
                    data.start_date = '{!! $start_date !!}';
                    data.end_date = '{!! $end_date !!}"';                       
                },
            },             
            columns: [
                { // mengambil & menampilkan kolom sesuai tabel database
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false                        
                },
                {
                    data: 'noNota',
                    name: 'noNota'
                },
                {
                    data: 'tanggalNota',
                    name: 'tanggalNota',
                    orderable: false,
                    searchable: false                      
                },       
                {
                    data: 'totalSebelumDiskon',
                    name: 'totalSebelumDiskon',
                    orderable: false,
                    searchable: false                              
                },   
                {
                    data: 'diskon',
                    name: 'diskon',
                    orderable: false,
                    searchable: false                               
                },                                                                            
                {
                    data: 'potongan',
                    name: 'potongan',
                    orderable: false,
                    searchable: false                             
                },
                {
                    data: 'grandTotal',
                    name: 'grandTotal',
                    orderable: false,
                    searchable: false                             
                },                                                   
                {
                    data: 'caraBayar',
                    name: 'caraBayar',
                    orderable: false,
                    searchable: false,
                    render : function(data){
                        var status = "CC";
                        if(data == 1)
                        {
                            status = "Cash";	
                        }
                        else if(data == 2)
                        {
                            status = "Debit";	
                        }
                        return status;
                    }                                                    
                },              
                {
                    data: 'namaUser',
                    name: 'namaUser',
                    orderable: false,                          
                },     
                {
                    data: 'namaShopHolder',
                    name: 'namaShopHolder',
                    orderable: false,                          
                },          
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false                             
                },                                      
            ],           
            dom   : 'Bfrtip',
            buttons : ["copy", "excel", "pdf", "print"],                  
        });
    });
</script>
@endif

@if(Request::is('admin/receipt/sale-product-resume')) 
<script>
    $(function() {
        $('#receipt-sale-product-resume-table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,          
            responsive: true,      
            autoWidth: true,
            ajax: {
                "url": "{!! route('receipt.sale.product.resume') !!}",
                "data": function(data) {
                    data.start_date = '{!! $start_date !!}"';
                    data.end_date = '{!! $end_date !!}"';                       
                },
            },             
            columns: [
                { // mengambil & menampilkan kolom sesuai tabel database
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false                        
                },
                {
                    data: 'noBarang',
                    name: 'noBarang'
                },
                {
                    data: 'namaBarang',
                    name: 'namaBarang',                   
                },       
                {
                    data: 'qty',
                    name: 'qty',
                    orderable: false,
                    searchable: false                              
                },   
                {
                    data: 'hargaProduk',
                    name: 'hargaProduk',
                    orderable: false,
                    searchable: false                               
                },               
                {
                    data: 'total',
                    name: 'total',
                    orderable: false,
                    searchable: false                             
                },                                 
            ],           
            dom   : 'Bfrtip',
            buttons : ["copy", "excel", "pdf", "print"],                  
        });
    });
</script>
@endif

@if(Request::is('admin/receipt/purchasing')) 
<script>
    $(function() {
        $('#receipt-purchasing-table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,          
            responsive: true,      
            autoWidth: true,
            ajax: {
                "url": "{!! route('receipt.purchasing') !!}",
                "data": function(data) {
                    data.start_date = '{!! $start_date !!}';
                    data.end_date = '{!! $end_date !!}';           
                    data.caraBayar = '{!! $caraBayar !!}';
                    data.status = '{!! $status !!}';                                   
                },
            },             
            columns: [
                { // mengambil & menampilkan kolom sesuai tabel database
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false                        
                },
                {
                    data: 'noNota',
                    name: 'noNota'
                },
                {
                    data: 'namaShopHolder',
                    name: 'namaShopHolder'
                },                
                {
                    data: 'grandTotal',
                    name: 'grandTotal',    
                    orderable: false,
                    searchable: false,                      
                    className: 'text-right'               
                },       
                {
                    data: 'tanggalNota',
                    name: 'tanggalNota',
                    orderable: false,
                    searchable: false                              
                },   
                // {
                //     data: 'totalSebelumDiskon',
                //     name: 'totalSebelumDiskon',
                //     orderable: false,
                //     searchable: false                               
                // },               
                // {
                //     data: 'diskon',
                //     name: 'diskon',
                //     orderable: false,
                //     searchable: false                             
                // },              
                // {
                //     data: 'potongan',
                //     name: 'potongan',
                //     orderable: false,
                //     searchable: false                             
                // },        
                {
                    data: 'caraBayar',
                    name: 'caraBayar',
                    orderable: false,
                    searchable: false,
                    render : function(data){
                        var caraBayar = "Hutang";
                        if(data == 1)
                        {
                            caraBayar = "Cash";	
                        }
                        return caraBayar;
                    }                                                   
                },   
                {
                    data: 'namaUser',
                    name: 'namaUser',                         
                },   
                {
                    data: 'isSelesai',
                    name: 'isSelesai',    
                    orderable: false,
                    searchable: false,
                    render : function(data){
                        var status = "Belum";
                        if(data == 1)
                        {
                            status = "Selesai";	
                        }
                        return status;
                    }   
                },
                {
                    data: 'action',
                    name: 'action',       
                    orderable: false,
                    searchable: false,
                    className: 'text-center'                                                                 
                },  
            ],           
            dom   : 'Bfrtip',
            buttons : ["copy", "excel", "pdf", "print"],                  
        });
    });
</script>
@endif
</body>
</html>


