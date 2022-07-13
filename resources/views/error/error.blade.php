@include('adminLTE.header')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
   
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" role="button">
          <i class="fas fa-user mr-2"></i>
          {{ Auth::user()->name }}
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

@include('adminLTE.menu')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Daftar Tanggal Penjualan</li>
              </ol>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            {{-- success message --}}
            
            <div class="col-12">
              <!-- /.card -->
              <div class="col-md-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Error</h3>
                  </div>
                  <div id="success_message">

                  </div>
                  <form id="hitung" method="GET">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Daftar Roti</label>
                        <select class="form-control" name="nama_roti" id="nama_roti">

                        </select>
                        <span class="text-danger error-text nama_roti_error"></span>
                      </div>
                    </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="hitung_btn">Submit</button>
                        <a href="{{ Route('error') }}">
                          <button type="button" class="btn btn-warning">Reset</button>
                        </a>
                      </div>
                  </form>
                  </div>
                </div>
            
                <!-- /.card-header -->
                  {{-- success message --}}
                  <div class="card">
                    <div class="card-header">
                      <div class="d-flex justify-content-end mb-2 mr-2">
                        <button class="btn btn-warning" onclick="printElem('#print_page')" id="print_btn" type="submit">Print</button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    
                    <div class="card-body" id="print_page">
                      
                      <div id="show_tabel_hit">
                        <h1 class="text-center text-secondary my-5">Loading...</h1>
                      </div>
                    </div>
                   
                    <!-- /.card-body -->
                  </div>

                  
       
            
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('adminLTE.footer')
<script>
    
    $(document).ready(function () {
      

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $("#print_btn").prop('disabled',true);

      function fetchRoti()
      {
        $.ajax({
            type: "GET",
            url: "/get/pnj-pro",
            dataType: "JSON",
            success: function (response) {

              if(response){
                  $("#nama_roti").append('<option value="" disabled selected>-- Pilih Roti --</option>')
                $.each(response, function (key, value) { 
                  $("#nama_roti").append('<option value="'+ value.id +'">'+ value.nama_produk +'</option>');
                });
          
              }
                
            }
        });
      }

      fetchRoti();
      $("#hitung_btn").prop('disabled', false)
      //untuk hitung prediksi
      $("#hitung").submit(function (e) { 
        e.preventDefault();
       var id = $("#nama_roti").val()
       var pergerakan = $("#pergerakan").val();
       $("#hitung_btn").prop('disabled', true)
      //  console.log(pergerakan);

          $.ajax({
            type: "GET",
            data:{
              nama_roti:id,
              _token: '{{ csrf_token() }}'
            },
            url: "/error-table",
            beforeSend:function(){
              $(document).find('span.error-text').text('');
            },
            success: function (response) {

              if(response.status == 400){

                $.each(response.errors, function (previx, val) { 
                  $('span.' + previx + '_error').text(val[0]);
                });

              }else{
                $("#show_tabel_hit").html(response);
                $("#print_btn").prop('disabled',false);
              }

             
            }

          });
      });

    });

    function printElem(elem)
    {   
        Popup($('<div/>').append($(elem).clone()).html());
    }

    function Popup(data) 
    {
      var mywindow = window.open('', 'perhitungan', 'height=1000,width=1400');
        mywindow.document.write('<html><head><title>perhitungan</title>');
        mywindow.document.write('<meta charset="utf-8">');
        mywindow.document.write('<meta name="viewport" content="width=device-width, initial-scale=1">');
        mywindow.document.write('<meta name="csrf-token" content="{{ csrf_token() }}" />');
         mywindow.document.write('<link rel="stylesheet" href="{{ URL::asset('adminLTE/dist/css/adminlte.min.css') }}" type="text/css" />'); 
         mywindow.document.write('<link rel="stylesheet" href="{{ URL::asset('adminLTE/dist/css/print.css') }}" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
      //  mywindow.close();

        return true;
    }

   
    
</script>