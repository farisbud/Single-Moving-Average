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
                <li class="breadcrumb-item active">Produk</li>
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
                  <h3 class="card-title">Daftar Produk</h3>
                  <div class="col-6 col-sm-4 col-md mb-3 mb-xl-0 text-right">
                    <button class="btn btn-primary" id="addProduk" type="button">Tambah Produk</button>    
                  </div>
                </div>
                <!-- /.card-header -->
                  {{-- success message --}}
                  <div id="success_message">
                    
                  </div>
                
                <div class="card-body" id="show_all_produk">
                  <h1 class="text-center text-secondary my-5">Loading...</h1>
                    
                </div>
                {{-- modal add--}}
                <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content" class="witdh: 200%;">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="add_produk" method="POST" enctype="multipart/form-data">
                          @csrf
                         
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Produk:</label>
                              <input type="text" class="form-control"  name="nama_produk">
                            <span class="text-danger error-text nama_produk_error"></span>
                          </div>
                            <span class="text-danger error-text type_error"></span>
                          
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="add_produk_btn" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
                {{-- / add modal --}}
                {{-- edit modal --}}
                <div class="modal fade" id="showModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content" class="witdh: 200%;">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="update_produk" method="POST" enctype="multipart/form-data">
                            @csrf
                          <input type="hidden" id="id" name="id">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama produk:</label>
                              <input type="text" class="form-control" id="nama_produk" name="nama_produk">
                            <span class="text-danger error-text nama_produk_error"></span>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="update_produk_btn" class="btn btn-primary">Update</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="delete" enctype="multipart/form-data" id="deletePro">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="delID">
                              <h4>Apakah kamu yakin, ingin menghapus data <br> <center>Produk Roti??</center></h4>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" id="delete_produk_btn" class="btn btn-danger">Hapus</button>
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

      function fetchProduk()
      {
        $.ajax({
          type: "get",
          url: "{{ route("produk-table") }}",
            success: function (response) {
              $("#show_all_produk").html(response);
              $("table").DataTable({
                "responsive": true,
                "lengthChange": false, 
                "autoWidth": false,
                "bDestroy": true,

              });
            }
        });
      }

      fetchProduk();

      //tampil modal Produk
      $("#addProduk").click(function (e) { 
        e.preventDefault();

        $("#showModal").modal("show");
        
      });

      //add Produk
      $("#add_produk").submit(function (e) { 
        e.preventDefault();
        $("#add_produk_btn").prop('disabled', true);
        $("#add_produk_btn").text('menyimpan...');

        const dataProduk = new FormData(this);
          $.ajax({
            type: "post",
            url: "{{ Route("produk-add") }}",
            data: dataProduk,
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
                  $("#add_produk_btn").prop('disabled', false);
                  $("#add_produk_btn").text('Submit');
               }else{
                  $("#add_produk")[0].reset();
                  $("#success_message").addClass("alert alert-success");
                  $("#success_message").text(response.message);
                  $("#showModal").modal("hide");
                  $("#add_produk_btn").prop('disabled', false);
                  $("#add_produk_btn").text("Submit");

                  fetchProduk();
               }
              }
          });
      });

      //edit modal Produk

      $(document).on('click','.editPro', function (e) { 
        e.preventDefault();
        
        var id = $(this).attr('id');
        //console.log(id);

        $("#showModalEdit").modal("show");

        $.ajax({
          type: "get",
          url: "/produk/" + id ,
          dataType: "JSON",
          success: function (response) {
              $("#id").val(id);
              $("#nama_produk").val(response.nama_produk);
              //console.log(response.type);
          }

        });
      
      });

      //update Produk

          $("#update_produk").submit(function (e) { 
            e.preventDefault();

            $("#update_produk_btn").prop('disabled', true);
            $("#update_produk_btn").text("merubah....");
            const id = $("#id").val();

            const editProduk = new FormData(this);
            $.ajax({
              type: "post",
              url: "/produk/" + id,
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
                    $("#update_produk_btn").prop('disabled', false);
                    $("#update_produk_btn").text('Update');
                }else{
                    $('#update_produk')[0].reset();
                    $("#success_message").addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $("#showModalEdit").modal('hide');
                    $("#update_produk_btn").prop('disabled', false);
                    $("#update_produk_btn").text('Update');
                    
                    fetchProduk();
                }
                
              }
            });
            //console.log(editProduk);
          });

          //modal hapus
          $(document).on('click','.deletePro', function (e) { 
            e.preventDefault();

            var id = $(this).attr("id");
            //console.log(id);
            $("#delID").val(id);

            $("#showModalDelete").modal("show");

          });
          //delete Produk
          $("#deletePro").submit(function (e) { 
            e.preventDefault();
            
            $("#delete_produk_btn").prop('disabled', true);
            $("#delete_produk_btn").text("menghapus....");
            var id = $("#delID").val();
            
            $.ajax({
              type: "delete",
              url: "/produk/" + id,
              success: function (response) {
                $("#success_message").addClass("alert alert-success");
                $("#success_message").text(response.message);
                $("#showModalDelete").modal("hide");
                $("#delete_produk_btn").prop('disabled', false);
                $("#delete_produk_btn").text("Hapus");

                fetchProduk();
              }
            });
            
          });


    });

   
    
</script>