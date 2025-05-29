<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Supplier</title>
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
                        <h3 class="page-title">Supplier </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Supplier</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="card-title">Data Supplier</h4>
                                            <p class="card-description"> Tabel Supplier menampilkan daftar supplier yang tersedia beserta informasi terkait untuk memudahkan pengelolaan pemasok dan distribusi produk.
                                            </p>
                                        </div>
                                        <div class="col-lg-4" style="float:right;">
                                            <button class="btn btn-gradient-primary btn-rounded btn-fw" type="button" onclick="tambahData()"><i class="fa fa-plus"></i> Tambah Supplier</button>
                                        </div>
                                    </div>
                                    <table class="table table-striped" id="striped-table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Supplier</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                                <th>Website</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($mysqli, "SELECT * FROM supplier");
                                            $no = 1;
                                            while ($supplier = mysqli_fetch_array($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $no++ . "</td>";
                                                echo "<td>" . $supplier['Nama_Perusahaan'] . "</td>";
                                                echo "<td>" . $supplier['Email'] . "</td>";
                                                echo "<td>" . $supplier['Telepon'] . "</td>";
                                                echo "<td>" . $supplier['Alamat'] . "</td>";
                                                echo "<td>" . $supplier['Website'] . "</td>";
                                                echo "<td>";
                                                echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='editData(" . $supplier['ID_Supplier'] . ")'><i class='fa fa-edit'></i> Edit</button>";
                                                echo "<button class='btn btn-xs btn-outline-danger btn-fw padding-button' onclick='hapus_data(" . $supplier['ID_Supplier'] . ")' ><i class='fa fa-edit'></i> Hapus</button>";
                                                echo "</td>";
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
                                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Supplier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_modal()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- Form tambah kategori -->
                            <form method="post" target="_self" name="formku" id="formku" class="eventInsForm">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Nama_Perusahaan">Nama Supplier</label>
                                                <input type="hidden" name="ID_Supplier" id="ID_Supplier">
                                                <input type="text" class="form-control" id="Nama_Perusahaan" name="Nama_Perusahaan" placeholder="Masukkan nama supplier">
                                                <div class="invalid-feedback Nama_Perusahaan-ada inv-Nama_Perusahaan">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input type="email" class="form-control" id="Email" name="Email" placeholder="Masukkan Email">
                                                <div class="invalid-feedback Email-ada inv-Email">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Telepon">Telepon</label>
                                                <input type="number" class="form-control" id="Telepon" name="Telepon" placeholder="Masukkan No Telp">
                                                <div class="invalid-feedback Telepon-ada inv-Telepon">
                                                    &nbsp;
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Alamat">Alamat</label>
                                                <textarea class="form-control" id="Alamat" name="Alamat" placeholder="Masukkan alamat" rows="5"></textarea>
                                                <div class="invalid-feedback Alamat-ada inv-Alamat">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Website">Website</label>
                                                <input type="text" class="form-control" id="Website" name="Website" placeholder="Masukkan alamat website">
                                                <div class="invalid-feedback Website-ada inv-Website">
                                                    &nbsp;
                                                </div>
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
            $('#ID_Supplier').val('');
            $('#Nama_Perusahaan').val('');
            $('#Email').val('');
            $('#Telepon').val('');
            $('#Alamat').val('');
            $('#Website').val('');

            dsState = "Input";

            $("#exampleModalScrollableTitle").text('Tambah Supplier');
            $("#exampleModalScrollable").modal('show');
        }

        function editData(ID_Supplier) {
            dsState = "Edit";
            $.ajax({
                type: "POST",
                url: "<?= $base_url ?>pages/supplier/proses.php",
                data: {
                    ID_Supplier: ID_Supplier,
                    action: 'edit'
                },
                dataType: "json",
                success: function(result) {
                    $('#ID_Supplier').val(result.ID_Supplier);
                    $('#Nama_Perusahaan').val(result.Nama_Perusahaan);
                    $('#Email').val(result.Email);
                    $('#Telepon').val(result.Telepon);
                    $('#Alamat').val(result.Alamat);
                    $('#Website').val(result.Website);


                    $("#exampleModalScrollableTitle").text('Edit Supplier');
                    $("#exampleModalScrollable").modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("Gagal mengambil data supplier:", error);
                    alert("Gagal mengambil data supplier.");
                }
            });
        }

        function simpandata() {
            const Nama_Perusahaan = $.trim($("#Nama_Perusahaan").val());
            const Email = $.trim($("#Email").val());
            const Telepon = $.trim($("#Telepon").val());
            const Alamat = $.trim($("#Alamat").val());
            const Website = $.trim($("#Website").val());


            if (Nama_Perusahaan === "") {
                $(".inv-Nama_Perusahaan").html("Nama Supplier tidak boleh kosong!");
                $('#Nama_Perusahaan').addClass('is-invalid');
                setTimeout(() => {
                    $('.inv-Nama_Perusahaan').hide(300);
                }, 3000);
                return;
            }
            if (Email === "") {
                $(".inv-Email").html("Email tidak boleh kosong!");
                $('#Email').addClass('is-invalid');
                setTimeout(() => {
                    $('.inv-Email').hide(300);
                }, 3000);
                return;
            }
            if (Telepon === "") {
                $(".inv-Telepon").html("Telepon tidak boleh kosong!");
                $('#Telepon').addClass('is-invalid');
                setTimeout(() => {
                    $('.inv-Telepon').hide(300);
                }, 3000);
                return;
            }
            if (Alamat === "") {
                $(".inv-Alamat").html("Alamat tidak boleh kosong!");
                $('#Alamat').addClass('is-invalid');
                setTimeout(() => {
                    $('.inv-Alamat').hide(300);
                }, 3000);
                return;
            }
            if (Website === "") {
                $(".inv-Website").html("Website tidak boleh kosong!");
                $('#Website').addClass('is-invalid');
                setTimeout(() => {
                    $('.inv-Website').hide(300);
                }, 3000);
                return;
            }

            if (dsState === "Input") {
                $.ajax({
                    type: "POST",
                    url: "<?= $base_url ?>pages/supplier/proses.php",
                    data: {
                        Nama_Perusahaan: Nama_Perusahaan,
                        action: "cek_supplier"
                    },
                    success: function(result) {
                        if (result === "ADA") {
                            $('.Nama_Perusahaan-ada').html("Nama Supplier sudah tersedia!");
                            $('.Nama_Perusahaan-ada').show();
                        } else {
                            $('.Nama_Perusahaan-ada').hide();
                            // ajax simpan data
                            $.ajax({
                                type: "POST",
                                url: "<?= $base_url ?>pages/supplier/proses.php",
                                data: {
                                    Nama_Perusahaan: Nama_Perusahaan,
                                    Email: Email,
                                    Telepon: Telepon,
                                    Alamat: Alamat,
                                    Website: Website,
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
                    url: "<?= $base_url ?>pages/supplier/proses.php",
                    data: {
                        Nama_Perusahaan: Nama_Perusahaan,
                        Email: Email,
                        Telepon: Telepon,
                        Alamat: Alamat,
                        Website: Website,
                        ID_Supplier: $("#ID_Supplier").val(),
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

        function hapus_data(ID_Supplier) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Apakah Supplier mau Dihapus?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= $base_url ?>pages/supplier/proses.php",
                        data: {
                            ID_Supplier: ID_Supplier,
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
                                text: 'Maaf, kategori ini tidak bisa dihapus karena telah dipakai dalam transaksi.',
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