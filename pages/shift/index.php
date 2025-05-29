 <!DOCTYPE html>
 <html lang="en">

 <head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Shift</title>
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
                         <h3 class="page-title">Shift </h3>
                         <nav aria-label="breadcrumb">
                             <ol class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                 <li class="breadcrumb-item active" aria-current="page">Shift</li>
                             </ol>
                         </nav>
                     </div>
                     <div class="row">
                         <div class="col-lg-12 grid-margin stretch-card">
                             <div class="card">
                                 <div class="card-body">
                                     <div class="row">
                                         <div class="col-lg-8">
                                             <h4 class="card-title">Data Shift</h4>
                                             <p class="card-description"> Tabel Shift menyimpan data jadwal kerja karyawan, seperti hari dan jam masuk serta keluar, guna memudahkan penjadwalan, pengaturan rotasi kerja, dan memastikan efisiensi operasional perusahaan.
                                             </p>
                                         </div>
                                     </div>
                                     <table class="table table-striped" id="striped-table">
                                         <thead>
                                             <tr>
                                                 <th>No.</th>
                                                 <th>Nama Karyawan</th>
                                                 <th>Aksi</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php
                                                $result = mysqli_query($mysqli, "SELECT * FROM karyawan");
                                                $no = 1;
                                                while ($supplier = mysqli_fetch_array($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $no++ . "</td>";
                                                    echo "<td>" . $supplier['Nama'] . "</td>";
                                                    echo "<td>";
                                                    echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='hapus_data(" . $supplier['ID_Karyawan'] . ")' ><i class='fa fa-eye'></i> Shift</button>";

                                                    echo "<button class='btn btn-xs btn-outline-primary btn-fw padding-button' onclick='editData(" . $supplier['ID_Karyawan'] . ")'><i class='fa fa-edit'></i> Edit</button>";
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
                                 <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Karyawan</h5>
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
                                                 <label for="Nama">Nama Karyawan</label>
                                                 <input type="hidden" name="ID_Karyawan" id="ID_Karyawan">
                                                 <input type="text" class="form-control" id="Nama" name="Nama" placeholder="Masukkan nama karyawan">
                                                 <div class="invalid-feedback Nama-ada inv-Nama">
                                                     &nbsp;
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                 <label for="Jenis_Kelamin">Jenis Kelamin</label>
                                                 <select name="Jenis_Kelamin" id="Jenis_Kelamin" class="form-control">
                                                     <option value="">Pilih jenis kelamin</option>
                                                     <option value="Perempuan">Perempuan</option>
                                                     <option value="Laki-Laki">Laki-Laki</option>
                                                 </select>
                                                 <div class="invalid-feedback Jenis_Kelamin-ada inv-Jenis_Kelamin">
                                                     &nbsp;
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                 <label for="Tanggal_Lahir">Tanggal Lahir</label>
                                                 <input type="date" class="form-control" id="Tanggal_Lahir" name="Tanggal_Lahir" placeholder="Masukkan tanggal lahir">
                                                 <div class="invalid-feedback Tanggal_Lahir-ada inv-Tanggal_Lahir">
                                                     &nbsp;
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <label for="No_Telp">No Telp</label>
                                                 <input type="number" class="form-control" id="No_Telp" name="No_Telp" placeholder="Masukkan No.Telp">
                                                 <div class="invalid-feedback No_Telp-ada inv-No_Telp">
                                                     &nbsp;
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                 <label for="Alamat">Alamat</label>
                                                 <textarea class="form-control" id="Alamat" name="Alamat" placeholder="Masukkan alamat" rows="5"></textarea>
                                                 <div class="invalid-feedback Alamat-ada inv-Alamat">
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
             $('#ID_Karyawan').val('');
             $('#Nama').val('');
             $('#Jenis_Kelamin').val('');
             $('#Tanggal_Lahir').val('');
             $('#No_Telp').val('');
             $('#Alamat').val('');
             dsState = "Input";

             $("#exampleModalScrollableTitle").text('Tambah Karyawan');
             $("#exampleModalScrollable").modal('show');
         }

         function editData(ID_Karyawan) {
             dsState = "Edit";
             $.ajax({
                 type: "POST",
                 url: "<?= $base_url ?>pages/karyawan/proses.php",
                 data: {
                     ID_Karyawan: ID_Karyawan,
                     action: 'edit'
                 },
                 dataType: "json",
                 success: function(result) {
                     $('#ID_Karyawan').val(result.ID_Karyawan);
                     $('#Nama').val(result.Nama);
                     $('#Jenis_Kelamin').val(result.Jenis_Kelamin);
                     $('#Tanggal_Lahir').val(result.Tanggal_Lahir);
                     $('#Alamat').val(result.Alamat);
                     $('#No_Telp').val(result.No_Telp);


                     $("#exampleModalScrollableTitle").text('Edit Karyawan');
                     $("#exampleModalScrollable").modal('show');
                 },
                 error: function(xhr, status, error) {
                     console.error("Gagal mengambil data Karyawan:", error);
                     alert("Gagal mengambil data Karyawan.");
                 }
             });
         }

         function simpandata() {
             const Nama = $.trim($("#Nama").val());
             const Jenis_Kelamin = $.trim($("#Jenis_Kelamin").val());
             const Tanggal_Lahir = $.trim($("#Tanggal_Lahir").val());
             const Alamat = $.trim($("#Alamat").val());
             const No_Telp = $.trim($("#No_Telp").val());


             if (Nama === "") {
                 $(".inv-Nama").html("Nama Karyawan tidak boleh kosong!");
                 $('#Nama').addClass('is-invalid');
                 setTimeout(() => {
                     $('.inv-Nama').hide(300);
                 }, 3000);
                 return;
             }
             if (Jenis_Kelamin === "") {
                 $(".inv-Jenis_Kelamin").html("Jenis Kelamin tidak boleh kosong!");
                 $('#Jenis_Kelamin').addClass('is-invalid');
                 setTimeout(() => {
                     $('.inv-Jenis_Kelamin').hide(300);
                 }, 3000);
                 return;
             }
             if (Tanggal_Lahir === "") {
                 $(".inv-Tanggal_Lahir").html("Tanggal Lahir tidak boleh kosong!");
                 $('#Tanggal_Lahir').addClass('is-invalid');
                 setTimeout(() => {
                     $('.inv-Tanggal_Lahir').hide(300);
                 }, 3000);
                 return;
             }
             const today = new Date();
             const inputDate = new Date(Tanggal_Lahir);

             // Bandingkan hanya tanggal (tanpa jam)
             today.setHours(0, 0, 0, 0);
             inputDate.setHours(0, 0, 0, 0);

             if (inputDate >= today) {
                 $(".inv-Tanggal_Lahir").html("Tanggal Lahir tidak boleh hari ini atau lebih baru!");
                 $('#Tanggal_Lahir').addClass('is-invalid');
                 setTimeout(() => {
                     $('.inv-Tanggal_Lahir').hide(300);
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
             if (No_Telp === "") {
                 $(".inv-No_Telp").html("No Telp tidak boleh kosong!");
                 $('#No_Telp').addClass('is-invalid');
                 setTimeout(() => {
                     $('.inv-No_Telp').hide(300);
                 }, 3000);
                 return;
             }

             if (dsState === "Input") {
                 $.ajax({
                     type: "POST",
                     url: "<?= $base_url ?>pages/karyawan/proses.php",
                     data: {
                         Nama: Nama,
                         action: "cek_karyawan"
                     },
                     success: function(result) {
                         if (result === "ADA") {
                             $('.Nama-ada').html("Nama Karyawan sudah tersedia!");
                             $('.Nama-ada').show();
                         } else {
                             $('.Nama-ada').hide();
                             // ajax simpan data
                             $.ajax({
                                 type: "POST",
                                 url: "<?= $base_url ?>pages/karyawan/proses.php",
                                 data: {
                                     Nama: Nama,
                                     Jenis_Kelamin: Jenis_Kelamin,
                                     Tanggal_Lahir: Tanggal_Lahir,
                                     Alamat: Alamat,
                                     No_Telp: No_Telp,
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
                     url: "<?= $base_url ?>pages/karyawan/proses.php",
                     data: {
                         Nama: Nama,
                         Jenis_Kelamin: Jenis_Kelamin,
                         Tanggal_Lahir: Tanggal_Lahir,
                         Alamat: Alamat,
                         No_Telp: No_Telp,
                         ID_Karyawan: $("#ID_Karyawan").val(),
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
                 text: "Apakah Karyawan mau Dihapus?",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Yes, Hapus!'
             }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajax({
                         type: "POST",
                         url: "<?= $base_url ?>pages/karyawan/proses.php",
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
                                 text: 'Maaf, karyawan ini tidak bisa dihapus karena telah dipakai dalam transaksi.',
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