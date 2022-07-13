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
                    <h3 class="card-title">Data Produk & Pergerakan</h3>
                    
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
                      </div>
                    </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="hitung_btn">Submit</button>
                        <a href="{{ Route('perhitungan') }}">
                          <button type="button" class="btn btn-warning">Reset</button>
                        </a>
                      </div>
                  </form>
                  </div>
                </div>
            
                <!-- /.card-header -->
                  {{-- success message --}}
                  
              <div id="show_tabel_hit">

              </div>

              {{-- modal prediksi --}}
              <div class="modal fade" id="showModalPrediksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content" class="witdh: 200%;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Prediksi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="prediksi" method="POST">
                        @csrf
                        <div class="card-body">
                          <input type="hidden" name="produk_id" id="produk">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Prediksi untuk tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                            <span class="text-danger error-text tanggal_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hasil pergerakan 3</label>
                            <input readonly type="number" class="form-control" min="0" id="hasil3" name="hasil3">
                            <span class="text-danger error-text hasil_error"></span>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Hasil pergerakan 5</label>
                          <input readonly type="number" class="form-control" min="0" id="hasil5" name="hasil5">
                          <span class="text-danger error-text hasil_error"></span>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Hasil pergerakan 7</label>
                        <input readonly type="number" class="form-control" min="0" id="hasil7" name="hasil7">
                        <span class="text-danger error-text hasil_error"></span>
                    </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="prediksi_btn">Simpan</button>
                          
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              {{-- /modal prediksi --}}
       
            
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
              id:id,
              _token: '{{ csrf_token() }}'
            },
            url: "/perhitungan-table",
          
            success: function (response) {
              $("#show_tabel_hit").html(response);
              const hasil3 = $("#prediksi3").val();
              const hasil5 = $("#prediksi5").val();
              const hasil7 = $("#prediksi7").val();
              const produk = $("#produk_id").val();

              $("#hasil3").val(hasil3);
              $("#hasil5").val(hasil5);
              $("#hasil7").val(hasil7);
              
              $("#produk").val(produk);
              $("#showModalPrediksi").modal("show");
            }

          });
      });
      //untuk hitung prediksi

     $("#prediksi").submit(function (e) { 
      e.preventDefault();
      $('#prediksi_btn').prop('disabled', true);
      // const gerak = $("#hidGerak").val();
      // const hasil = $("#hidHasil").val();

      const data = new FormData(this);

        $.ajax({
          type: "POST",
          url: "{{ Route("prediksi-add") }}",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function (response) {
              if(response.status == 400){
                  $.each(response.errors, function (previx, val) { 
                    $('span.' +previx + '_error').text(val[0]);
                  });
                  $('#prediksi_btn').prop('disabled', false);
              }else{
                   $("#prediksi")[0].reset();
                    $("#success_message").addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $("#showModalPrediksi").modal("hide");
  
              }
          }
        });
      
    
      
     });

  
  


    });

   
    
</script>