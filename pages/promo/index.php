<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Promo Musiman</title>
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
    <style>
        .table-responsive {
            overflow-x: auto !important;
        }

        .table td,
        .table th {
            white-space: nowrap !important;
        }

        .padding-button {
            margin-right: 20px !important;
            min-width: 50px !important;
            height: 35px !important;
        }
    </style>

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
                        <h3 class="page-title"> Promo Musiman </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Promo Musiman</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="card-title">Data Promo</h4>
                                            <p class="card-description">Tabel Promo berisi data event promo dan detail promo per produk.</p>
                                        </div>
                                        <div class="col-lg-4 text-end">
                                            <a href="<?= $base_url ?>pages/promo/add.php" class="btn btn-gradient-primary btn-rounded btn-fw">
                                                <i class="fa fa-plus"></i> Tambah Promo
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Table wrapper -->
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="striped-table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Promo</th>
                                                    <th>Tanggal Awal</th>
                                                    <th>Tanggal Akhir</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $query_tabel = mysqli_query($mysqli, "SELECT * FROM promo_musiman");
                                                while ($promo = mysqli_fetch_array($query_tabel)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $no++ . "</td>";
                                                    echo "<td>" . $promo['Nama_Promo'] . "</td>";
                                                    echo "<td>" . $promo['Tanggal_Awal'] . "</td>";
                                                    echo "<td>" . $promo['Tanggal_Akhir'] . "</td>";
                                                    echo "<td>";
                                                    echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='details(" . $promo['ID_Promo_Musiman'] . ")'><i class='fa fa-eye'></i></button>";
                                                    if($promo['Status']=="Aktif"){
                                                    echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='unpost(" . $promo['ID_Promo_Musiman'] . ")'>Non-Aktifkan</button>";
                                                    }else{
                                                    echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='editData(" . $promo['ID_Promo_Musiman'] . ")'><i class='fa fa-edit'></i> Edit</button>";
                                                    echo "<button class='btn btn-xs btn-outline-danger btn-fw padding-button' onclick='hapus_data(" . $promo['ID_Promo_Musiman'] . ")' ><i class='fa fa-edit'></i> Hapus</button>";
                                                    echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='posting(" . $promo['ID_Promo_Musiman'] . ")'>Aktifkan</button>";
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
                </div>

                <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Promo</h5>
                                <button type="button" class="close" data-dismiss="modal" onclick="closeModal()" aria-label="Tutup">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Diskon (%)</th>
                                            <th>Harga setelah Diskon</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detailTableBody">
                                    </tbody>
                                </table>
                            </div>
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
        function Cetak_Resi(id) {
            window.open('<?= $base_url ?>pages/promo/cetak_resi.php?id=' + id, '_blank');
        }

        function closeModal() {
            $('#detailModal').modal('hide');
        }

        var dsState = "Input";

        function close_modal() {
            $('#exampleModalScrollable').modal('hide');

        }


        function hapus_data(ID_Promo) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Apakah promo mau dihapus?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= $base_url ?>pages/promo/proses.php",
                        data: {
                            ID_Promo: ID_Promo,
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
                                text: 'Maaf, Hapus gagal:).',
                            });
                        }
                    });
                }
            });
        }




        function details(idPromo) {
            $('#detailModal').modal('show');
            $('#detailTableBody').html('');

            $.ajax({
                url: '<?= $base_url ?>pages/promo/proses.php',
                type: 'POST',
                data: {
                    id: idPromo,
                    action: 'lihat_detail'
                },
                success: function(response) {
                    $('#detailTableBody').append(response);
                },
                error: function() {
                    $('#detailTableBody').append('<tr><td colspan="6" class="text-danger">Gagal mengambil data.</td></tr>');
                }
            });
        }

        function editData(id) {
            window.location.href = "<?= $base_url ?>pages/promo/edit.php?id_promo=" + id;
        }
        function unpost(id_Promo) {
        Swal.fire({
        title: 'Are you sure?',
        text: "Apakah promo mau di Non-Aktifkan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Non-Aktifkan!'
        }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "<?= $base_url ?>pages/promo/proses.php",
            data: {
              id_Promo: id_Promo,
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
                text: 'Maaf, barang ini tidak bisa di Non-Aktifkan.',
              });
            }
          });
        }
      });
    }

    function posting(id_Promo) {
      Swal.fire({
        title: 'Are you sure?',
        text: "Apakah promo mau diaktifkan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Aktifkan!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "<?= $base_url ?>pages/promo/proses.php",
            data: {
              id_Promo: id_Promo,
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