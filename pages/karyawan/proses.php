<?php
include('../../koneksi.php');
if (isset($_POST["action"])) {
    $action = $_POST["action"];
    if ($action == "cek_karyawan" && isset($_POST["Nama"])) {
        $nama_barang = $_POST["Nama"];
        $query_cek = mysqli_query($mysqli, "SELECT * FROM karyawan WHERE Nama = '$Nama'");
        echo (mysqli_num_rows($query_cek) > 0) ? "ADA" : "GA ADA";
        exit;
    }
    if ($action == "tambah_data") {
        $Nama = $_POST["Nama"];
        $Jenis_kelamin = $_POST["Jenis_kelamin"];
        $Umur = $_POST["Umur"];
        $Tanggal_lahir = $_POST["Tanggal_lahir"];
        $No_telp = $_POST["No_telp"];
        $Alamat = $_POST["Alamat"];

        $query_tambah = mysqli_query($mysqli, "INSERT INTO karyawan (Nama, Jenis_kelamin, Umur, Tanggal_lahir, No_telp, Alamat) VALUES ('$Nama',$Jenis_kelamin, $Umur, '$Tanggal_lahir' , $No_telp, $Alamat, NOW())");
        if ($query_tambah) {
            echo json_encode(['success' => 'Data berhasil ditambah!']);
        } else {
            echo json_encode(['error' => 'Data gagal ditambah!']);
        }
    }
    if ($action == "edit_data") {
        $ID_Karyawan = $_POST["ID_Karyawan"];
        $Nama = $_POST["Nama"];
        $Jenis_kelamin = $_POST["Jenis_kelamin"];
        $Umur = $_POST["Umur"];
        $Tanggal_lahir = $_POST["Tanggal_lahir"];
        $No_telp = $_POST["No_telp"];
        $Alamat = $_POST["Alamat"];

        $query_edit = mysqli_query($mysqli, "UPDATE karyawan SET Nama = '$Nama', Jenis_kelamin = $Jenis_kelamin, Umur = $Umur, Tanggal_lahir = '$Tanggal_lahir', No_telp = $No_telp, Alamat = $Alamat  WHERE ID_Karyawan = $ID_Karyawan");
        if ($query_edit) {
            echo json_encode(['success' => 'Data berhasil diperbarui']);
        } else {
            echo json_encode(['error' => 'Data gagal diperbarui']);
        }
        exit;
    }

    if ($action == "edit") {
        $id_barang = $_POST["ID_Karyawan"];
        $query = mysqli_query($mysqli, "SELECT * FROM karyawan WHERE ID_Karyawan = $ID_Karyawan");
        if ($data = mysqli_fetch_assoc($query)) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }
        exit;
    }

    if ($action == "hapus_data" && isset($_POST["ID_Karyawan"])) {
        $id_barang = $_POST["ID_Karyawan"];
        $query = mysqli_query($mysqli, "DELETE FROM karyawan WHERE ID_Karyawan = $ID_Karyawan");
        if ($query) {
            echo json_encode(['success' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['error' => 'Maaf, barang ini tidak bisa dihapus karena telah dipakai dalam transaksi.']);
        }
        exit;
    }


}
