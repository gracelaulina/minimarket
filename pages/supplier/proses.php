<?php
include('../../koneksi.php');
if (isset($_POST["action"])) {
    $action = $_POST["action"];
    if ($action == "cek_supplier" && isset($_POST["Nama_Perusahaan"])) {
        $Nama_Perusahaan = $_POST["Nama_Perusahaan"];
        $query_cek = mysqli_query($mysqli, "SELECT * FROM supplier WHERE Nama_Perusahaan = '$Nama_Perusahaan'");
        echo (mysqli_num_rows($query_cek) > 0) ? "ADA" : "GA ADA";
        exit;
    }
    if ($action == "tambah_data") {
        $Nama_Perusahaan = $_POST["Nama_Perusahaan"];
        $Email = $_POST["Email"];
        $Telepon = $_POST["Telepon"];
        $Alamat = $_POST["Alamat"];
        $Website = $_POST["Website"];

        $query_tambah = mysqli_query($mysqli, "INSERT INTO supplier (Nama_Perusahaan, Email, Telepon, Alamat, Website) VALUES ('$Nama_Perusahaan','$Email', '$Telepon', '$Alamat' , '$Website')");
        if ($query_tambah) {
            echo json_encode(['success' => 'Data berhasil ditambah!']);
        } else {
            echo json_encode(['error' => 'Data gagal ditambah!']);
        }
    }
    if ($action == "edit_data") {
        $ID_Supplier = $_POST["ID_Supplier"];
        $Nama_Perusahaan = $_POST["Nama_Perusahaan"];
        $Email = $_POST["Email"];
        $Telepon = $_POST["Telepon"];
        $Alamat = $_POST["Alamat"];
        $Website = $_POST["Website"];

        $query_edit = mysqli_query($mysqli, "UPDATE supplier SET Nama_Perusahaan = '$Nama_Perusahaan', Email = '$Email', Telepon = '$Telepon', Alamat = '$Alamat', Website = '$Website'  WHERE ID_Supplier = $ID_Supplier");
        if ($query_edit) {
            echo json_encode(['success' => 'Data berhasil diperbarui']);
        } else {
            echo json_encode(['error' => 'Data gagal diperbarui']);
        }
        exit;
    }

    if ($action == "edit") {
        $ID_Supplier = $_POST["ID_Supplier"];
        $query = mysqli_query($mysqli, "SELECT * FROM supplier WHERE ID_Supplier = $ID_Supplier");
        if ($data = mysqli_fetch_assoc($query)) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }
        exit;
    }

    if ($action == "hapus_data" && isset($_POST["ID_Supplier"])) {
        $ID_Supplier = $_POST["ID_Supplier"];
        $query = mysqli_query($mysqli, "DELETE FROM supplier WHERE ID_Supplier = $ID_Supplier");
        if ($query) {
            echo json_encode(['success' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['error' => 'Maaf, supplier ini tidak bisa dihapus karena telah dipakai dalam transaksi.']);
        }
        exit;
    }
}
