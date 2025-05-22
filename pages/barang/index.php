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
                      <?php
                      $no = 1;
                      $query_tabel = mysqli_query($mysqli, "SELECT b.*, k.Nama_Kategori AS Nama_Kategori, s.Nama_Perusahaan AS Nama_Supplier FROM barang b LEFT JOIN kategori k ON b.ID_Kategori = k.ID_Kategori LEFT JOIN supplier s ON b.ID_Supplier = s.ID_Supplier");
                      while ($barang = mysqli_fetch_array($query_tabel)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $barang['Nama_Kategori'] . "</td>";
                        echo "<td>" . $barang['Nama_Barang'] . "</td>";
                        echo "<td>" . $barang['Nama_Supplier'] . "</td>";
                        echo "<td class='text-end'>" . number_format($barang['Harga_Beli']) . "</td>";
                        echo "<td class='text-end'>" . number_format($barang['Harga_Jual']) . "</td>";
                        echo "<td class='text-end'>" . number_format($barang['Stok']) . "</td>";
                        echo "<td class='text-end'>" . $barang['Diskon'] . "</td>";
                        echo "<td>";
                        if ($barang['Status'] == "Aktif") {
                          echo "<label class='badge badge-success'>" . $barang['Status'] . "</label>";
                        } else {
                          echo "<label class='badge badge-danger'>" . $barang['Status'] . "</label>";
                        }
                        echo "</td>";
                        echo "<td>";
                        if ($barang['Status'] == 'Aktif') {
                          echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='unpost(" . $barang['ID_Barang'] . ")'>Non-Aktifkan</button>";
                        } else {
                          echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='editData(" . $barang['ID_Barang'] . ")'><i class='fa fa-edit'></i> Edit</button>";
                          echo "<button class='btn btn-xs btn-outline-danger btn-fw padding-button' onclick='hapus_data(" . $barang['ID_Barang'] . ")' ><i class='fa fa-edit'></i> Hapus</button>";
                          echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='posting(" . $barang['ID_Barang'] . ")'>Aktifkan</button>";
                        }
                        echo "</td>";
                        echo "</tr>";
                      }
                      ?>
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
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="kategori-id">Nama Kategori</label>
                      <select name="kategori-id" id="kategori-id" class="form-control">
                        <option value="">Pilih Kategori</option>
                        <?php
                        $query_kategori = mysqli_query($mysqli, "SELECT * FROM kategori");
                        while ($kategori = mysqli_fetch_array($query_kategori)) {
                          echo "<option value=" . $kategori['ID_Kategori'] . ">" . $kategori['Nama_Kategori'] . "</option>";
                        }
                        ?>
                      </select>
                      <div class="invalid-feedback kategori-id-ada inv-kategori-id">
                        &nbsp;
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="barang-nama">Nama Barang</label>
                      <input type="hidden" name="barang-id" id="barang-id">
                      <input type="text" class="form-control" id="barang-nama" name="barang-nama" placeholder="Masukkan nama barang">
                      <div class="invalid-feedback barang-nama-ada inv-barang-nama">
                        &nbsp;
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="harga-beli">Harga Beli</label>
                      <input type="number" name="harga_beli" id="harga_beli" class="form-control" placeholder="Masukkan Harga Beli">
                      <div class="invalid-feedback harga_beli-ada inv-harga_beli">
                        &nbsp;
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="harga-jual">Harga Jual</label>
                      <input type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Masukkan Harga Jual">
                      <div class="invalid-feedback harga_jual-ada inv-harga_jual">
                        &nbsp;
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="supplier-id">Nama Supplier</label>
                      <select name="supplier-id" id="supplier-id" class="form-control">
                        <option value="">Pilih Supplier</option>
                        <?php
                        $query_supplier = mysqli_query($mysqli, "SELECT * FROM supplier");
                        while ($supplier = mysqli_fetch_array($query_supplier)) {
                          echo "<option value=" . $supplier['ID_Supplier'] . ">" . $supplier['Nama_Perusahaan'] . "</option>";
                        }
                        ?>
                      </select>
                      <div class="invalid-feedback supplier-id-ada inv-supplier-id">
                        &nbsp;
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="stok">Stok</label>
                      <input type="number" name="stok" id="stok" class="form-control" placeholder="Masukkan Stok Awal">
                      <div class="invalid-feedback stok-ada inv-stok">
                        &nbsp;
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="expired">Expired</label>
                      <input type="date" name="expired" id="expired" class="form-control">
                      <div class="invalid-feedback expired-ada inv-expired">
                        &nbsp;
                      </div>
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
      $('#barang-id').val('');
      $('#barang-nama').val('');
      $('#harga_beli').val('');
      $('#harga_jual').val('');
      $('#supplier-id').val('');
      $('#stok').val('');
      $('#expired').val('');

      dsState = "Input";

      $("#exampleModalScrollableTitle").text('Tambah Barang');
      $("#exampleModalScrollable").modal('show');
    }

    function editData(id_barang) {
      dsState = "Edit";
      $.ajax({
        type: "POST",
        url: "<?= $base_url ?>pages/barang/proses.php",
        data: {
          id_barang: id_barang,
          action: 'edit'
        },
        dataType: "json",
        success: function(result) {
          $('#kategori-id').val(result.ID_Kategori);
          $('#barang-id').val(result.ID_Barang);
          $('#barang-nama').val(result.Nama_Barang);
          $('#harga_beli').val(result.Harga_Beli);
          $('#harga_jual').val(result.Harga_Jual);
          $('#supplier-id').val(result.ID_Supplier);
          $('#stok').val(result.Stok);
          $('#expired').val(result.Expired);
          $("#exampleModalScrollableTitle").text('Edit Barang');
          $("#exampleModalScrollable").modal('show');
        },
        error: function(xhr, status, error) {
          console.error("Gagal mengambil data barang:", error);
          alert("Gagal mengambil data barang.");
        }
      });
    }

    function simpandata() {
      const kategori_id = $.trim($("#kategori-id").val());
      const barang_nama = $.trim($("#barang-nama").val());
      const harga_beli = $.trim($("#harga_beli").val());
      const harga_jual = $.trim($("#harga_jual").val());
      const supplier_id = $.trim($("#supplier-id").val());
      const stok = $.trim($("#stok").val());
      const expired = $.trim($("#expired").val());

      if (nama === "") {
        $(".inv-kategori-id").html("Kategori tidak boleh kosong!");
        $('#kategori-id').addClass('is-invalid');
        setTimeout(() => {
          $('.inv-kategori-id').hide(300);
        }, 3000);
        return;
      }
      if (barang_nama === "") {
        $(".inv-barang-nama").html("Nama Barang tidak boleh kosong!");
        $('#barang-nama').addClass('is-invalid');
        setTimeout(() => {
          $('.inv-barang-nama').hide(300);
        }, 3000);
        return;
      }
      if (harga_beli === "") {
        $(".inv-harga_beli").html("Harga Beli tidak boleh kosong!");
        $('#harga_beli').addClass('is-invalid');
        setTimeout(() => {
          $('.inv-harga_beli').hide(300);
        }, 3000);
        return;
      }
      if (harga_jual === "") {
        $(".inv-harga_jual").html("Harga Jual tidak boleh kosong!");
        $('#harga_jual').addClass('is-invalid');
        setTimeout(() => {
          $('.inv-harga_jual').hide(300);
        }, 3000);
        return;
      }
      if (supplier_id === "") {
        $(".inv-supplier_id").html("Supplier tidak boleh kosong!");
        $('#supplier_id').addClass('is-invalid');
        setTimeout(() => {
          $('.inv-supplier_id').hide(300);
        }, 3000);
        return;
      }
      if (stok === "") {
        $(".inv-stok").html("Stok tidak boleh kosong!");
        $('#stok').addClass('is-invalid');
        setTimeout(() => {
          $('.inv-stok').hide(300);
        }, 3000);
        return;
      }
      if (expired === "") {
        $(".inv-expired").html("Expired tidak boleh kosong!");
        $('#expired').addClass('is-invalid');
        setTimeout(() => {
          $('.inv-expired').hide(300);
        }, 3000);
        return;
      }


      if (dsState === "Input") {
        $.ajax({
          type: "POST",
          url: "<?= $base_url ?>pages/barang/proses.php",
          data: {
            barang_nama: barang_nama,
            action: "cek_barang"
          },
          success: function(result) {
            if (result === "ADA") {
              $('.barang-nama-ada').html("Nama Barang sudah tersedia!");
              $('.barang-nama-ada').show();
            } else {
              $('.barang-nama-ada').hide();
              // ajax simpan data
              $.ajax({
                type: "POST",
                url: "<?= $base_url ?>pages/barang/proses.php",
                data: {
                  kategori_id: kategori_id,
                  barang_nama: barang_nama,
                  harga_beli: harga_beli,
                  harga_jual: harga_jual,
                  supplier_id: supplier_id,
                  stok: stok,
                  expired: expired,
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
          url: "<?= $base_url ?>pages/barang/proses.php",
          data: {
            barang_id: $("#barang-id").val(),
            kategori_id: kategori_id,
            barang_nama: barang_nama,
            harga_beli: harga_beli,
            harga_jual: harga_jual,
            supplier_id: supplier_id,
            stok: stok,
            expired: expired,
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