<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kategori</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<body>
  <?php include('../../koneksi.php') ?>
  <div class="container-scroller">

    <!-- header -->
    <?php include('../../header.php'); ?>
    <!-- tutup header -->

    <div class="container-fluid page-body-wrapper">
      <!-- navbar -->
      <?php include('../../navbar.php'); ?>
      <!-- tutup navbar -->
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Tabel Barang </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Barang</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-8">
                      <h4 class="card-title">Data Barang</h4>
                      <p class="card-description">Tabel barang berisi data barang yang akan dijual.
                      </p>
                    </div>
                    <div class="col-lg-4" style="float:right;">
                      <button class="btn btn-gradient-primary btn-rounded btn-fw" type="button" onclick="tambahData()"><i class="fa fa-plus"></i> Tambah Barang</button>
                    </div>
                  </div>
                  <table class="table table-striped" id="striped-table">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Nama Barang</th>
                        <th>Nama Supplier</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Diskon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_modal()">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Form tambah barang -->
              <form method="post" target="_self" name="formku" id="formku" class="eventInsForm">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="barang-nama">Nama Kategori</label>
                    <select name="kategori-id" id="kategori-id" class="form-control">
                        <option value="">Pilih Kategori</option>
                    </select>
                    <div class="invalid-feedback barang-nama-ada inv-barang-nama">
                      &nbsp;
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="barang-nama">Nama Barang</label>
                    <input type="hidden" name="barang-id" id="barang-id">
                    <input type="text" class="form-control" id="barang-nama" name="barang-nama" placeholder="Masukkan nama barang">
                    <div class="invalid-feedback barang-nama-ada inv-barang-nama">
                      &nbsp;
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="barang-nama">Nama Supplier</label>
                    <select name="supplier-id" id="supplier-id" class="form-control">
                        <option value="">Pilih Supplier</option>
                    </select>
                    <div class="invalid-feedback supplier-nama-ada inv-supplier-nama">
                      &nbsp;
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="harga-beli-nama">Harga Beli</label>
                    <input type="number" name="harga_beli" id="harga_beli" class="form-control">
                    <div class="invalid-feedback harga_beli-nama-ada inv-harga_beli-nama">
                      &nbsp;
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="harga-jual-nama">Harga Jual</label>
                    <input type="number" name="harga_jual" id="harga_jual" class="form-control">
                    <div class="invalid-feedback harga_jual-nama-ada inv-harga_jual-nama">
                      &nbsp;
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="stok-nama">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control">
                    <div class="invalid-feedback stok-nama-ada inv-stok-nama">
                      &nbsp;
                    </div>
                  </div>
                  
                
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close_modal()">Batal</button>
                  <button type="button" class="btn btn-primary" name="save-data" onclick="simpandata()">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>


        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->

  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- jQuery (required by DataTables) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    var dsState = "Input";

    function close_modal() {
      $('#exampleModalScrollable').modal('hide');

    }

    function tambahData() {
      $('#kategori-id').val('');
      $('#kategori-nama').val('');
      dsState = "Input";

      $("#exampleModalScrollableTitle").text('Tambah Barang');
      $("#exampleModalScrollable").modal('show');
    }

    function editData(id_kategori) {
      dsState = "Edit";
      $.ajax({
        type: "POST",
        url: "<?= $base_url ?>pages/kategori/proses.php",
        data: {
          id_kategori: id_kategori,
          action: 'edit'
        },
        dataType: "json",
        success: function(result) {
          $('#kategori-nama').val(result.Nama_Kategori);
          $('#kategori-id').val(result.ID_Kategori);

          $("#exampleModalScrollableTitle").text('Edit Kategori');
          $("#exampleModalScrollable").modal('show');
        },
        error: function(xhr, status, error) {
          console.error("Gagal mengambil data kategori:", error);
          alert("Gagal mengambil data kategori.");
        }
      });
    }

    function simpandata() {
      const nama = $.trim($("#kategori-nama").val());

      if (nama === "") {
        $(".inv-kategori-nama").html("Nama tidak boleh kosong!");
        $('#kategori-nama').addClass('is-invalid');
        setTimeout(() => {
          $('.inv-kategori-nama').hide(300);
        }, 3000);
        return;
      }

      if (dsState === "Input") {
        $.ajax({
          type: "POST",
          url: "<?= $base_url ?>pages/kategori/proses.php",
          data: {
            nama_kategori: nama,
            action: "cek_kategori"
          },
          success: function(result) {
            if (result === "ADA") {
              $('.kategori-nama-ada').html("Nama kategori sudah tersedia!");
              $('.kategori-nama-ada').show();
            } else {
              $('.kategori-nama-ada').hide();
              // ajax simpan data
              $.ajax({
                type: "POST",
                url: "<?= $base_url ?>pages/kategori/proses.php",
                data: {
                  nama_kategori: nama,
                  action: "tambah_data"
                },
                dataType: "json",
                success: function(response) {
                  $('#exampleModalScrollable').modal('hide');
                  if (response.success) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil',
                      text: response.success,
                      timer: 2000,
                      showConfirmButton: false
                    }).then(() => {
                      location.reload();
                    });
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'Gagal',
                      text: response.error || "Terjadi kesalahan.",
                    });
                  }
                },
                error: function() {
                  Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal menyimpan data.',
                  });
                }
              });
            }
          }
        });
      } else {
        // ajax edit data
        $.ajax({
          type: "POST",
          url: "<?= $base_url ?>pages/kategori/proses.php",
          data: {
            nama_kategori: nama,
            id_kategori: $("#kategori-id").val(),
            action: "edit_data"
          },
          dataType: "json",
          success: function(response) {
            $('#exampleModalScrollable').modal('hide');
            if (response.success) {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.success,
                timer: 2000,
                showConfirmButton: false
              }).then(() => {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: response.error || "Terjadi kesalahan.",
              });
            }
          },
          error: function() {
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: 'Gagal menyimpan data.',
            });
          }
        });
      }
    }

    function hapus_data(id_kategori) {
      Swal.fire({
        title: 'Are you sure?',
        text: "Apakah Kategori mau Dihapus?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "<?= $base_url ?>pages/kategori/proses.php",
            data: {
              id_kategori: id_kategori,
              action: "hapus_data"
            },
            dataType: "json",
            success: function(response) {
              if (response.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: response.success,
                  timer: 2000,
                  showConfirmButton: false
                }).then(() => {
                  location.reload();
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Gagal',
                  text: response.error || "Terjadi kesalahan.",
                });
              }
            },
            error: function() {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Maaf, produk ini tidak bisa dihapus karena telah dipakai dalam transaksi.',
              });
            }
          });
        }
      });
    }

    function unpost(id_kategori) {
      Swal.fire({
        title: 'Are you sure?',
        text: "Apakah Kategori mau di Non-Aktifkan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Non-Aktifkan!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "<?= $base_url ?>pages/kategori/proses.php",
            data: {
              id_kategori: id_kategori,
              action: "unpost"
            },
            dataType: "json",
            success: function(response) {
              if (response.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: response.success,
                  timer: 2000,
                  showConfirmButton: false
                }).then(() => {
                  location.reload();
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Gagal',
                  text: response.error || "Terjadi kesalahan.",
                });
              }
            },
            error: function() {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Maaf, produk ini tidak bisa di Non-Aktifkan.',
              });
            }
          });
        }
      });
    }

    function posting(id_kategori) {
      Swal.fire({
        title: 'Are you sure?',
        text: "Apakah Kategori mau di Aktifkan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Aktifkan!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "<?= $base_url ?>pages/kategori/proses.php",
            data: {
              id_kategori: id_kategori,
              action: "posting"
            },
            dataType: "json",
            success: function(response) {
              if (response.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: response.success,
                  timer: 2000,
                  showConfirmButton: false
                }).then(() => {
                  location.reload();
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Gagal',
                  text: response.error || "Terjadi kesalahan.",
                });
              }
            },
            error: function() {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Maaf, produk ini tidak bisa di Aktifkan.',
              });
            }
          });
        }
      });
    }
  </script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


  <script>
    $(document).ready(function() {
      $('#striped-table').DataTable();
    });
  </script>

  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/misc.js"></script>
  <script src="../../assets/js/settings.js"></script>
  <script src="../../assets/js/todolist.js"></script>
  <script src="../../assets/js/jquery.cookie.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
</body>

</html>