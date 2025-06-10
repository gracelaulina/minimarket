<?php
include('../../koneksi.php');
if (isset($_POST["action"])) {
    $action = $_POST["action"];
    if ($action == "cek_karyawan" && isset($_POST["Nama"])) {
        $Nama = $_POST["Nama"];
        $query_cek = mysqli_query($mysqli, "SELECT * FROM karyawan WHERE Nama = '$Nama'");
        echo (mysqli_num_rows($query_cek) > 0) ? "ADA" : "GA ADA";
        exit;
    }
    if ($action == "tambah_data") {
        $Nama           = mysqli_real_escape_string($mysqli, $_POST["Nama"]);
        $Jenis_Kelamin  = mysqli_real_escape_string($mysqli, $_POST["Jenis_Kelamin"]);
        $Tanggal_Lahir  = mysqli_real_escape_string($mysqli, $_POST["Tanggal_Lahir"]);
        $No_Telp        = mysqli_real_escape_string($mysqli, $_POST["No_Telp"]);
        $Alamat         = mysqli_real_escape_string($mysqli, $_POST["Alamat"]);

        $query_tambah = mysqli_query($mysqli, "INSERT INTO karyawan (Nama, Jenis_Kelamin, Tanggal_Lahir, No_Telp, Alamat) 
                                           VALUES ('$Nama', '$Jenis_Kelamin', '$Tanggal_Lahir', '$No_Telp', '$Alamat')");
        if ($query_tambah) {
            $ID_Karyawan = mysqli_insert_id($mysqli); // ambil ID Karyawan yang baru saja ditambahkan

            // Data hari dan jam kerja shift default
            $hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

            foreach ($hari_list as $hari) {
                $Jam_Masuk  = date('Y-m-d') . ' 08:00:00';
                $Jam_Keluar = date('Y-m-d') . ' 17:00:00';

                $stmt = $mysqli->prepare("INSERT INTO shift (ID_Karyawan, Hari, Jam_Masuk, Jam_Keluar) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("isss", $ID_Karyawan, $hari, $Jam_Masuk, $Jam_Keluar);
                $stmt->execute();
            }

            echo json_encode(['success' => 'Data berhasil ditambah dan shift diatur!']);
        } else {
            echo json_encode(['error' => 'Data gagal ditambah!']);
        }
    }

    if ($action == "edit_data") {
        $ID_Karyawan = $_POST["ID_Karyawan"];
        $Nama = $_POST["Nama"];
        $Jenis_Kelamin = $_POST["Jenis_Kelamin"];
        $Tanggal_Lahir = $_POST["Tanggal_Lahir"];
        $No_Telp = $_POST["No_Telp"];
        $Alamat = $_POST["Alamat"];

        $query_edit = mysqli_query($mysqli, "UPDATE karyawan SET Nama = '$Nama', Jenis_Kelamin = '$Jenis_Kelamin', Tanggal_Lahir = '$Tanggal_Lahir', No_Telp = '$No_Telp', Alamat = '$Alamat'  WHERE ID_Karyawan = $ID_Karyawan");
        if ($query_edit) {
            echo json_encode(['success' => 'Data berhasil diperbarui']);
        } else {
            echo json_encode(['error' => 'Data gagal diperbarui']);
        }
        exit;
    }

    if ($action == "edit") {
        $ID_Karyawan = $_POST["ID_Karyawan"];
        $query = mysqli_query($mysqli, "SELECT * FROM karyawan WHERE ID_Karyawan = $ID_Karyawan");
        if ($data = mysqli_fetch_assoc($query)) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }
        exit;
    }

    if ($action == "hapus_data" && isset($_POST["ID_Karyawan"])) {
        $ID_Karyawan = $_POST["ID_Karyawan"];
        $query_shift = mysqli_query($mysqli, "DELETE FROM shift WHERE ID_Karyawan = $ID_Karyawan");
        $query = mysqli_query($mysqli, "DELETE FROM karyawan WHERE ID_Karyawan = $ID_Karyawan");
        if ($query) {
            echo json_encode(['success' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['error' => 'Karyawan ini tidak dapat dihapus karena memiliki riwayat transaksi.']);
        }
        exit;
    }
}
