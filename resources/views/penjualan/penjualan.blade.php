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
            <div class="col-12">
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Daftar Tanggal Penjualan</h3>
                  <div class="col-6 col-sm-4 col-md mb-3 mb-xl-0 text-right">
                    <button class="btn btn-primary" id="modalPen" type="button">Tambah Penjualan</button>
                  </div>
                </div>
                <!-- /.card-header -->
                  {{-- success message --}}
                  <div id="success_message">

                  </div>
                <div class="card-body">
                {{-- <div class="card-body" id="show_all_penjualan"> --}}
                  {{-- <h1 class="text-center text-secondary my-5">Loading...</h1> --}}
                  <table class="table table-striped table-sm text-center align-middle" id="penjualan_table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jumlah Penjualan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
                  {{-- modal add--}}
                  <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content" class="witdh: 200%;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="add_pnj" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Nama Roti:</label>
                                <select class="form-control" name="nama_roti" id="nama_roti">


                                </select>
                              <span class="text-danger error-text nama_roti_error"></span>
                            </div>

                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Tanggal:</label>
                                <input type="date" class="form-control"  name="tanggal">
                              <span class="text-danger error-text tanggal_error"></span>
                            </div>

                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Penjualan:</label>
                                <input type="text" class="form-control"  name="penjualan">
                              <span class="text-danger error-text penjualan_error"></span>
                            </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" id="add_pnj_btn" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                  {{-- / add modal --}}

                <!-- /.card-body -->
              </div>
              <!-- /.card -->
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

        function tablePenjualan()
        {
            $('#penjualan_table').DataTable({
                serverSide : true,
                responsive : true,
                ajax : {
                    url : "{{ route('penjualan') }}",
                    type : 'GET',
                },
                columns :[
                    {
                    "data" : null, "sortable" : false,
                    render : function (data, type, row, meta)
                            {
                                return meta.row + meta.settings._iDisplayStart + 1
                            },
                    },
                    {
                    //mengganti format tanggal datatables
                    data : 'tanggal' , name : 'tanggal',
                        render: function (data, type, row) {
                            return moment(new Date(data).toString()).format('DD/MM/YYYY');
                        }
                    },
                    {
                         data : 'sum', name : 'sum'
                    },
                    {
                        data : 'aksi', name : 'aksi',
                    }
                ],


            })
        }
        tablePenjualan()


      //menampilkan produk roti
      function fetchProduk(){

        $.ajax({
          type: "get",
          url: "/get/nama_produk",
          dataType: "JSON",
          success: function (response) {

              if(response.produk){
                $("#nama_roti").empty();
                $("#nama_roti").append('<option disabled selected value=""> -- pilih produk -- </option>')
                $.each(response.produk, function (key, value) {
                    $("#nama_roti").append('<option value="'+ value.id +'">'+ value.nama_produk +'</option>');

                });
              }
          }
        });

      }

    //   tablePenjualan();

       //tampil modal kriteria
       $("#modalPen").click(function (e) {
        e.preventDefault();

        $("#showModal").modal("show");
        fetchProduk();
      });

        //add Penjualan
        $("#add_pnj").submit(function (e) {
        e.preventDefault();
        $("#add_pnj_btn").prop('disabled', true);
        $("#add_pnj_btn").text('menyimpan...');

        const dataPnj = new FormData(this);
          $.ajax({
            type: "post",
            url: "{{ Route("penjualan-add") }}",
            data: dataPnj,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(){
              $(document).find('span.error-text').text('');
            },
              success: function (response) {
               // console.log(response)
               if(response.status == 400 ){
                    $.each(response.errors, function (previx, val) {
                        $('span.' +previx + '_error').text(val[0]);
                    });
                  $("#add_pnj_btn").prop('disabled', false);
                  $("#add_pnj_btn").text('Submit');
               }else{
                  $("#add_pnj")[0].reset();
                  $("#success_message").addClass("alert alert-success");
                  $("#success_message").text(response.message);
                  $("#showModal").modal("hide");
                  $("#add_pnj_btn").prop('disabled', false);
                  $("#add_pnj_btn").text("Submit");

                  tablePenjualan();
               }
              }
          });
      });




    });



</script>
