<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User</title>
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
                        <h3 class="page-title">User </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="card-title">Data User</h4>
                                            <p class="card-description"> Tabel ini menyimpan data akun pengguna, yaitu username dan password yang digunakan untuk login ke sistem. Dengan adanya tabel ini, setiap pengguna bisa memiliki akses pribadi dan terjaga keamanannya saat menggunakan aplikasi.
                                            </p>
                                        </div>
                                        <div class="col-lg-4" style="float:right;">
                                            <button class="btn btn-gradient-primary btn-rounded btn-fw" type="button" onclick="tambahData()"><i class="fa fa-plus"></i> Tambah User</button>
                                        </div>
                                    </div>
                                    <table class="table table-striped" id="striped-table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Karyawan</th>
                                                <th>Username</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($mysqli, "SELECT u.*, k.Nama AS nama_karyawan  FROM user u LEFT JOIN karyawan k ON u.ID_Karyawan = k.ID_Karyawan");
                                            $no = 1;
                                            while ($user = mysqli_fetch_array($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $no++ . "</td>";
                                                echo "<td>" . $user['nama_karyawan'] . "</td>";
                                                echo "<td>" . $user['username'] . "</td>";

                                                echo "<td>";
                                                echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='editData(" . $user['ID_Karyawan'] . ")'><i class='fa fa-edit'></i> Edit</button>";
                                                echo "<button class='btn btn-xs btn-outline-danger btn-fw padding-button' onclick='hapus_data(" . $user['ID_Karyawan'] . ")' ><i class='fa fa-edit'></i> Hapus</button>";
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
                                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_modal()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- Form tambah kategori -->
                            <form method="post" target="_self" name="formku" id="formku" class="eventInsForm">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="ID_Karyawan">Nama User</label>
                                        <select name="ID_Karyawan" id="ID_Karyawan" class="form-control">
                                            <option value="">Pilih Karyawan</option>
                                            <?php
                                            $query_karyawan = mysqli_query($mysqli, "SELECT * FROM karyawan");
                                            while ($karyawan = mysqli_fetch_array($query_karyawan)) {
                                                echo "<option value=" . $karyawan['ID_Karyawan'] . ">" . $karyawan['Nama'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback ID_Karyawan-ada inv-ID_Karyawan">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Masukan username">
                                        <div class="invalid-feedback username-ada inv-username">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan password">
                                        <div class="invalid-feedback password-ada inv-password">
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
            $('#ID_Karyawan').val('');
            $('#username').val('');
            $('#password').val('');
            dsState = "Input";

            $("#exampleModalScrollableTitle").text('Tambah User');
            $("#exampleModalScrollable").modal('show');
        }

        function editData(ID_Karyawan) {
            dsState = "Edit";
            $.ajax({
                type: "POST",
                url: "<?= $base_url ?>pages/user/proses.php",
                data: {
                    ID_Karyawan: ID_Karyawan,
                    action: 'edit'
                },
                dataType: "json",
                success: function(result) {
                    $('#ID_Karyawan').val(result.ID_Karyawan);
                    $('#username').val(result.username);
                    $('#password').val(result.password);
                    $("#exampleModalScrollableTitle").text('Edit User');
                    $("#exampleModalScrollable").modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("Gagal mengambil data user:", error);
                    alert("Gagal mengambil data kategori.");
                }
            });
        }

        function simpandata() {
            const ID_Karyawan = $.trim($("#ID_Karyawan").val());
            const username = $.trim($("#username").val());
            const password = $.trim($("#password").val());


            if (ID_Karyawan === "") {
                $(".inv-ID_Karyawan").html("Karyawan tidak boleh kosong!");
                $('#ID_Karyawan').addClass('is-invalid');
                setTimeout(() => {
                    $('.inv-ID_Karyawan').hide(300);
                }, 3000);
                return;
            }
            if (username === "") {
                $(".inv-username").html("username tidak boleh kosong!");
                $('#username').addClass('is-invalid');
                setTimeout(() => {
                    $('.inv-username').hide(300);
                }, 3000);
                return;
            }
            if (password === "") {
                $(".inv-password").html("password tidak boleh kosong!");
                $('#password').addClass('is-invalid');
                setTimeout(() => {
                    $('.inv-password').hide(300);
                }, 3000);
                return;
            }

            if (dsState === "Input") {
                $.ajax({
                    type: "POST",
                    url: "<?= $base_url ?>pages/user/proses.php",
                    data: {
                        ID_Karyawan: ID_Karyawan,
                        action: "cek_user"
                    },
                    success: function(result) {
                        if (result === "ADA") {
                            $('.ID_Karyawan-ada').html("Karyawan sudah punya akses!");
                            $('.ID_Karyawan-ada').show();
                        } else {
                            $('.ID_Karyawan-ada').hide();
                            // ajax simpan data
                            $.ajax({
                                type: "POST",
                                url: "<?= $base_url ?>pages/user/proses.php",
                                data: {
                                    ID_Karyawan: ID_Karyawan,
                                    username: username,
                                    password: password,
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
                    url: "<?= $base_url ?>pages/user/proses.php",
                    data: {
                        ID_Karyawan: ID_Karyawan,
                        username: username,
                        password: password,
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


        function hapus_data(ID_Karyawan) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Apakah User mau Dihapus?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= $base_url ?>pages/user/proses.php",
                        data: {
                            ID_Karyawan: ID_Karyawan,
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
                                text: 'Maaf, user ini tidak bisa dihapus karena telah terlibat dalam transaksi.',
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