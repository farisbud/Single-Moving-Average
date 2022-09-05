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
                <li class="breadcrumb-item"><a href="#">Daftar Tanggal Penjualan</a></li>
                <li class="breadcrumb-item active">Penjualan</li>
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
                  <h3 class="card-title">Daftar Penjualan</h3>

                </div>
                <!-- /.card-header -->
                  {{-- success message --}}
                  <div id="success_message">

                  </div>

                <div class="card-body">
                    <table class="table table-striped table-sm text-center align-middle" id="detail_penjualan_table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Penjualan</th>
                                <th>perdiksi 3</th>
                                <th>error</th>
                                <th>error<sup style="font-size: 12px"> 2</sup></th>
                                <th>ape</th>
                                <th>perdiksi 5</th>
                                <th>error</th>
                                <th>error<sup style="font-size: 12px"> 2</sup></th>
                                <th>ape</th>
                                <th>perdiksi 7</th>
                                <th>error</th>
                                <th>error<sup style="font-size: 12px"> 2</sup></th>
                                <th>ape</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                {{-- edit modal --}}
                <div class="modal fade" id="showModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content" class="witdh: 200%;">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="update_penjualan" method="POST" enctype="multipart/form-data">
                            @csrf
                          <input type="hidden" id="id" name="id">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Roti:</label>
                              <select class="form-control" name="nama_roti" id="nama_roti">


                              </select>
                            <span class="text-danger error-text nama_roti_error"></span>
                          </div>

                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tanggal:</label>
                              <input type="date" class="form-control"  name="tanggal" id="tanggal">
                            <span class="text-danger error-text tanggal_error"></span>
                          </div>

                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Penjualan:</label>
                              <input type="text" class="form-control"  name="penjualan" id="penjualan">
                            <span class="text-danger error-text penjualan_error"></span>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="update_pnj_btn" class="btn btn-primary">Update</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
                {{-- / edit modal --}}
                {{-- delete modal --}}
                <div class="modal fade" id="showModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content" class="witdh: 200%;">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="delete" enctype="multipart/form-data" id="deletePnj">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="delID">
                              <h4>Apakah kamu yakin, ingin menghapus data <br> <center>Penjualan ?</center></h4>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" id="delete_pnj_btn" class="btn btn-danger">Hapus</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{--/ delete modal --}}
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


     function fetchPenDetail()
        {
            var url = window.location.pathname;
            var id = url.substring(url.lastIndexOf('/') + 1);
            $('#detail_penjualan_table').DataTable({
                serverSide : true,
                responsive : true,
                ajax : {
                    url : "/penjualan-detail/"+id,
                    type : "get",
                },
                columns : [
                    {
                    "data" : null, "sortable" : false,
                    render : function (data, type, row, meta)
                            {
                                return meta.row + meta.settings._iDisplayStart + 1
                            },
                    },
                    {data: "produk.nama_produk", name: "produk.nama_produk"},
                    {data: "penjualan", name : "penjualan" },
                    {data: "ma3", name: "ma3"},
                    {data: "err3", name: "err3"},
                    {data: "error3", name: "error3"},
                    {data: "ape3", name:"ape3"},
                    {data: "ma5", name: "ma5"},
                    {data: "err5", name: "err5"},
                    {data: "error5", name: "error5"},
                    {data: "ape5", name:"ape5"},
                    {data: "ma7", name: "ma7"},
                    {data: "err7", name: "err7"},
                    {data: "error7", name: "error7"},
                    {data: "ape7", name:"ape7"},
                    {data: "aksi", name:"aksi"},
                ],
            })
        }

    //   function fetchPenDetail()
    //   {
    //     var url = window.location.pathname;
    //     var id = url.substring(url.lastIndexOf('/') + 1);
    //     $.ajax({
    //       type: "get",
    //       url: "/penjualan-detail/show/" + id,
    //         success: function (response) {
    //           $("#show_all_penDetail").html(response);
    //           $("table").DataTable({
    //             "responsive": true,
    //             "lengthChange": false,
    //             "autoWidth": false,
    //             "bDestroy": true,

    //           });
    //         }
    //     });
    //   }

      fetchPenDetail();

      //edit modal kriteria

      $(document).on('click','.editPnj', function (e) {
        e.preventDefault();

        var id = $(this).attr('id');

        $("#showModalEdit").modal("show");

        $.ajax({
          type: "get",
          url: "/penjualan/" + id ,
          dataType: "JSON",
          success: function (response) {

              $("#id").val(id);
              if(response.produk){
                $("#nama_roti").empty();
               var produk_id = response.penjualan[0].produk_id;
                $.each(response.produk, function (key, value) {

                  if(value.id == produk_id){
                    $("#nama_roti").append('<option value="'+ value.id +'" selected>'+ value.nama_produk +'</option>');
                  }else{
                    $("#nama_roti").append('<option value="'+ value.id +'" >'+ value.nama_produk +'</option>');
                  }

                });
              }

              $('#tanggal').val(response.penjualan[0].tanggal);
              $('#penjualan').val(response.penjualan[0].penjualan);

          }

        });

      });

      //update penjualan

          $("#update_penjualan").submit(function (e) {
            e.preventDefault();

            $("#update_pnj_btn").prop('disabled', true);
            $("#update_pnj_btn").text("merubah....");
            const id = $("#id").val();

            const editProduk = new FormData(this);
            $.ajax({
              type: "post",
              url: "/penjualan/" + id,
              data: editProduk,
              dataType: "JSON",
              cache: false,
              contentType: false,
              processData: false,
              success: function (response) {

                if(response.status == 400){
                    $.each(response.errors, function (previx, val) {
                        $('span.' +previx + '_error').text(val[0]);
                    });
                    $("#update_pnj_btn").prop('disabled', false);
                    $("#update_pnj_btn").text('Update');
                }else{
                    $("#update_penjualan")[0].reset();
                    $("#success_message").addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $("#showModalEdit").modal('hide');
                    $("#update_pnj_btn").prop('disabled', false);
                    $("#update_pnj_btn").text('Update');

                    $("#detail_penjualan_table").DataTable().ajax.reload();

                }

              }
            });
            //console.log(editKriteria);
          });

          //modal hapus
          $(document).on('click','.deletePnj', function (e) {
            e.preventDefault();

            var id = $(this).attr("id");
            //console.log(id);
            $("#delID").val(id);

            $("#showModalDelete").modal("show");

          });
          //delete kriteria
          $("#deletePnj").submit(function (e) {
            e.preventDefault();

            $("#delete_pnj_btn").prop('disabled', true);
            $("#delete_pnj_btn").text("menghapus....");
            var id = $("#delID").val();

            $.ajax({
              type: "delete",
              url: "/penjualan/" + id,
              success: function (response) {
                $("#success_message").addClass("alert alert-success");
                $("#success_message").text(response.message);
                $("#showModalDelete").modal("hide");
                $("#delete_pnj_btn").prop('disabled', false);
                $("#delete_pnj_btn").text("Hapus");

                $("#detail_penjualan_table").DataTable().ajax.reload();

              }
            });

          });


    });



</script>
