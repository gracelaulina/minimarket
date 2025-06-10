<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Penjualan</title>
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

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
    <?php include('../../koneksi.php');
    $id_penjualan = $_GET['id_penjualan'];
    $query_data = mysqli_query($mysqli, "SELECT * FROM penjualan WHERE ID_Penjualan = $id_penjualan");
    $data = mysqli_fetch_assoc($query_data);
    ?>
    <div class="container-scroller">

        <!-- header -->
        <?php include('../../header.php'); ?>
        <!-- tutup header -->

        <div class="container-fluid page-body-wrapper">
            <!-- navbar -->
            <!-- tutup navbar -->
            <!-- partial -->
            <div class="main-panel w-100">
                <div class="content-wrapper ">
                    <div class="page-header">
                        <h3 class="page-title"> Tambah Penjualan </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                <li class="breadcrumb-item"><a href="#">Penjualan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Penjualan</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row align-items-center mb-3">
                                        <div class="col-lg-4">
                                            <label for="ID_Karyawan" class="card-description mb-0">Nama Karyawan</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="ID_Karyawan" id="ID_Karyawan" class="form-control">
                                                <option value="">Pilih Karyawan</option>
                                                <?php
                                                $query_karyawan = mysqli_query($mysqli, "SELECT * FROM karyawan");
                                                while ($karyawan = mysqli_fetch_array($query_karyawan)) {
                                                    $selected = ($karyawan['ID_Karyawan'] == $data['ID_Karyawan']) ? 'selected' : '';
                                                    echo "<option value='" . $karyawan['ID_Karyawan'] . "' $selected>" . $karyawan['Nama'] . "</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="row align-items-center mb-3">
                                        <div class="col-lg-4">
                                            <label for="Tanggal" class="card-description mb-0">Tanggal</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" name="Tanggal" id="Tanggal" class="form-control" value="<?= $data['Tanggal'] ?>">
                                            <input type="hidden" name="ID_Penjualan" id="ID_Penjualan" class="form-control" value="<?= $data['ID_Penjualan'] ?>">
                                            <input type="hidden" name="delete_id" id="delete_id">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mb-3">
                                        <div class="col-lg-4">
                                            <label for="Metode_Pembayaran" class="card-description mb-0">Metode Pembayaran</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="Metode_Pembayaran" id="Metode_Pembayaran" class="form-control">
                                                <option value="">Pilih Metode Pembayaran</option>
                                                <?php
                                                $metodes = ['Debet', 'QRIS', 'Tunai'];
                                                foreach ($metodes as $metode) {
                                                    $selected = ($data['Metode_Pembayaran'] == $metode) ? 'selected' : '';
                                                    echo "<option value='$metode' $selected>$metode</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row align-items-center mb-3">
                                        <div class="col-lg-4">
                                            <label for="Total" class="card-description mb-0">Total</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" name="Total" id="Total" class="form-control" value="<?= $data['Total'] ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mb-3">
                                        <div class="col-lg-4">
                                            <label for="Diskon_Resi" class="card-description mb-0">Diskon Resi</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" name="Diskon_Resi" id="Diskon_Resi" class="form-control" placeholder="Masukan Diskon Resi (Rp)" value="<?= $data['Diskon_Resi'] ?>">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mb-3">
                                        <div class="col-lg-4">
                                            <label for="Grandtotal" class="card-description mb-0">Grantotal</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" name="Grandtotal" id="Grandtotal" class="form-control" value="<?= $data['Grandtotal'] ?>" readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="tabel_detail" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Diskon</th>
                                                <th>Subtotal 1 (Harga - Diskon)</th>
                                                <th>Qty</th>
                                                <th>Subtotal 2 (Subtotal 1 * Qty)</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $query_data_detail = mysqli_query($mysqli, "SELECT pd.*, b.Nama_Barang AS nama_barang FROM detail_penjualan pd LEFT JOIN barang b ON pd.ID_Barang = b.ID_Barang WHERE pd.ID_Penjualan = $id_penjualan");
                                            while ($detail = mysqli_fetch_array($query_data_detail)) {
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><input type="hidden" class="form-control ID_Penjualan_Detail" name="ID_Penjualan_Detail[]" value="<?= $detail['ID_Penjualan_Detail'] ?>">
                                                        <input type="text" class="form-control nama-barang" name="nama_barang[]" value="<?= $detail['nama_barang'] ?>">
                                                        <input type="hidden" class="form-control id_kategori" name="id_kategori[]" value="<?= $detail['ID_Kategori'] ?? '' ?>">
                                                        <input type="hidden" class="form-control id_barang" name="id_barang[]" value="<?= $detail['ID_Barang'] ?>">
                                                    </td>
                                                    <td><input type="number" class="form-control harga" name="harga[]" value="<?= $detail['Harga'] ?>" readonly></td>
                                                    <td><input type="number" class="form-control diskon" name="diskon[]" value="<?= $detail['Diskon'] ?>" min="0" max="100"></td>
                                                    <td>
                                                        <?php
                                                        $harga = $detail['Harga'];
                                                        $diskon = $detail['Diskon'];
                                                        $subtotal1 = $harga - ($harga * $diskon / 100);
                                                        ?>
                                                        <input type="number" class="form-control subtotal1" name="subtotal1[]" value="<?= $subtotal1 ?>" readonly>
                                                    </td>
                                                    <td><input type="number" class="form-control qty" name="qty[]" value="<?= $detail['Qty'] ?>" min="1">
                                                        <input type="hidden" class="form-control qty_draf" name="qty_draf[]" value="<?= $detail['Qty'] ?>" min="1">
                                                    </td>
                                                    <td><input type="number" class="form-control subtotal2" name="subtotal2[]" value="<?= $subtotal1 * $detail['Qty'] ?>" readonly></td>
                                                    <td><button class="btn btn-danger btn-sm" name="delete[]" onclick=" hapus_detail(<?= $detail['ID_Penjualan_Detail'] ?>)" type="button">Hapus</button></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary" id="tambahItem">Tambah Item</button>
                                    <button id="btnSave" class="btn btn-primary">Simpan</button>
                                    <button id="btnCancel" class="btn btn-danger">Batal</button>
                                </div>
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
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let counter = 1;

        $('#tambahItem').on('click', function() {
            const row = $(`
            <tr>
                <td>${counter++}</td>
                <td>
                    <input type="hidden" class="form-control ID_Penjualan_Detail" name="ID_Penjualan_Detail[]">
                    <input type="text" class="form-control nama-barang" name="nama_barang[]">
                    <input type="hidden" class="form-control id_kategori" name="id_kategori[]">
                    <input type="hidden" class="form-control id_barang" name="id_barang[]">
                </td>
                <td><input type="number" class="form-control harga" name="harga[]" readonly></td>
                <td><input type="number" class="form-control diskon" name="diskon[]" value="0" min="0" max="100"></td>
                <td><input type="number" class="form-control subtotal1" name="subtotal1[]" readonly></td>
                <td><input type="number" class="form-control qty" name="qty[]" value="1" min="1"></td>
                <td><input type="number" class="form-control subtotal2" name="subtotal2[]" readonly></td>
                <td><button class="btn btn-danger btn-sm hapusBaris">Hapus</button></td>
            </tr>
        `);

            $('#tabel_detail tbody').append(row);

            row.find('.nama-barang').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '<?= $base_url ?>pages/penjualan/proses.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            term: request.term,
                            action: 'autocomplete'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    const barang = ui.item;
                    const parentRow = $(this).closest('tr');

                    // Cek duplikat ID Barang
                    const idDipilih = barang.ID_Barang;
                    let isDuplicate = false;
                    $('.id_barang').each(function() {
                        if ($(this).val() == idDipilih) {
                            isDuplicate = true;
                            return false;
                        }
                    });

                    if (isDuplicate) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Barang sudah ditambahkan',
                            text: 'Pilih barang lain.',
                            toast: true,
                            timer: 2000,
                            position: 'top-end',
                            showConfirmButton: false
                        });
                        $(this).val('');
                        return false;
                    }

                    const harga = parseFloat(barang.harga) || 0;
                    const diskon = parseFloat(barang.diskon) || 0;
                    const qty = parseFloat(parentRow.find('.qty').val()) || 1;

                    const subtotal1 = harga - (harga * diskon / 100);
                    const subtotal2 = subtotal1 * qty;

                    parentRow.find('.id_kategori').val(barang.kategori);
                    parentRow.find('.id_barang').val(barang.ID_Barang);
                    parentRow.find('.harga').val(harga);
                    parentRow.find('.diskon').val(diskon);
                    parentRow.find('.subtotal1').val(subtotal1);
                    parentRow.find('.subtotal2').val(subtotal2);

                    updateTotal(); // Update total setelah pilih barang
                },
                minLength: 1
            });
        });

        // Realtime update diskon & qty
        $('#tabel_detail').on('input', '.diskon, .qty', function() {
            const parentRow = $(this).closest('tr');
            const harga = parseFloat(parentRow.find('.harga').val()) || 0;
            const diskon = parseFloat(parentRow.find('.diskon').val()) || 0;
            let qty = parseFloat(parentRow.find('.qty').val());

            if (qty < 1 || isNaN(qty)) {
                qty = 1;
                parentRow.find('.qty').val(1);
            }

            const subtotal1 = harga - (harga * diskon / 100);
            const subtotal2 = subtotal1 * qty;

            parentRow.find('.subtotal1').val(subtotal1);
            parentRow.find('.subtotal2').val(subtotal2);

            updateTotal(); // Update total setelah edit qty/diskon
        });

        // Hapus baris
        $('#tabel_detail').on('click', '.hapusBaris', function() {
            $(this).closest('tr').remove();
            updateNomor();
            updateTotal(); // Update total setelah hapus
        });

        // Update nomor urut
        function updateNomor() {
            $('#tabel_detail tbody tr').each(function(index) {
                $(this).find('td:first').text(index + 1);
            });
            counter = $('#tabel_detail tbody tr').length + 1;
        }

        $('#Diskon_Resi').on('input', function() {
            const grandtotal = parseFloat($('#Grandtotal').val()) || 0;
            let diskonResi = parseFloat($(this).val()) || 0;

            if (diskonResi > grandtotal) {
                Swal.fire('Peringatan', 'Diskon resi tidak boleh lebih besar dari Grand Total.', 'warning');
                $(this).val(0);
            }

            updateTotal();
        });


        function updateTotal() {
            let total = 0;
            $('.subtotal2').each(function() {
                const val = parseFloat($(this).val()) || 0;
                total += val;
            });
            let diskon_resi = 0;
            diskon_resi = $('#Diskon_Resi').val();
            let grandtotal = total - diskon_resi;

            $('#Total').val(total);
            $('#Grandtotal').val(grandtotal);

        }
        $('#btnSave').on('click', function(e) {
            e.preventDefault();

            const ID_Karyawan = parseInt($('#ID_Karyawan').val()) || 0;
            const Tanggal = $('#Tanggal').val();
            const Metode_Pembayaran = $('#Metode_Pembayaran').val();
            const Total = parseFloat($('#Total').val()) || 0;
            const Diskon_Resi = parseFloat($('#Diskon_Resi').val()) || 0;
            const Grandtotal = parseFloat($('#Grandtotal').val()) || 0;
            const delete_id = $('#delete_id').val();
            const ID_Penjualan = $('#ID_Penjualan').val();

            // Validasi wajib isi
            if (ID_Karyawan === 0) {
                alert("Isi Karyawan")
                Swal.fire('Peringatan', 'Silakan pilih karyawan.', 'warning');
                return;
            }

            if (!Metode_Pembayaran || Metode_Pembayaran == '') {
                Swal.fire('Peringatan', 'Silakan pilih metode pembayaran.', 'warning');
                return;
            }

            // Validasi diskon tidak boleh lebih dari grandtotal
            if (Diskon_Resi > Grandtotal) {
                Swal.fire('Peringatan', 'Diskon resi tidak boleh lebih besar dari Grandtotal.', 'warning');
                return;
            }

            // Ambil detail barang
            const detail = [];
            $('#tabel_detail tbody tr').each(function() {
                const ID_Penjualan_Detail = $(this).find('.ID_Penjualan_Detail').val();
                const id_barang = $(this).find('.id_barang').val();
                const id_kategori = $(this).find('.id_kategori').val();
                const harga = parseFloat($(this).find('.harga').val()) || 0;
                const diskon = parseFloat($(this).find('.diskon').val()) || 0;
                const qty = parseInt($(this).find('.qty').val()) || 0;
                const qty_draf = parseInt($(this).find('.qty_draf').val()) || 0;


                if (id_barang) {
                    detail.push({
                        ID_Penjualan_Detail,
                        id_barang,
                        id_kategori,
                        harga,
                        diskon,
                        qty,
                        qty_draf
                    });
                }
            });

            if (detail.length === 0) {
                Swal.fire('Gagal', 'Tambahkan minimal 1 barang.', 'error');
                return;
            }

            // Kirim data ke server
            $.ajax({
                url: '<?= $base_url ?>pages/penjualan/proses.php',
                method: 'POST',
                data: {
                    ID_Karyawan,
                    Tanggal,
                    Metode_Pembayaran,
                    Total,
                    Diskon_Resi,
                    Grandtotal,
                    ID_Penjualan,
                    delete_id,
                    detail: JSON.stringify(detail),
                    action: 'edit_data'
                },
                success: function(res) {
                    try {
                        const json = typeof res === 'string' ? JSON.parse(res) : res;

                        if (json.success) {
                            Swal.fire('Berhasil', json.message, 'success').then(() => {
                                window.location.href = '<?= $base_url ?>pages/penjualan/index.php';
                            });
                        } else {
                            Swal.fire('Gagal', json.message || 'Terjadi kesalahan saat menyimpan.', 'error');
                        }
                    } catch (err) {
                        Swal.fire('Gagal', 'Respons server tidak valid.', 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Gagal', xhr.responseText || 'Terjadi kesalahan saat menyimpan.', 'error');
                }
            });
        });


        $('#btnCancel').on('click', function() {
            window.location.href = '<?= $base_url ?>pages/penjualan/index.php';
        });

        function hapus_detail(id) {
            // Cari elemen baris yang mengandung tombol delete dengan atribut name="delete[]" dan nilai yang sesuai dengan id
            let row = $('button[name="delete[]"][onclick*="' + id + '"]').closest('tr');

            if (row.length) {
                // Tambahkan ID yang dihapus ke input delete_id
                let deleteIdInput = $('#delete_id');
                let currentIds = deleteIdInput.val();

                // Jika sudah ada ID yang dihapus, tambahkan koma sebelum menambahkan ID baru
                if (currentIds) {
                    currentIds += ',';
                }

                deleteIdInput.val(currentIds + id);

                // Menghapus baris dari DOM
                row.remove();
                updateTotal();


                console.log('Data dengan ID ' + id + ' telah dihapus.');
            } else {
                console.log('Data dengan ID ' + id + ' tidak ditemukan.');
            }
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