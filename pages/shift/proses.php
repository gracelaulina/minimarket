<?php
include('../../koneksi.php');
if (isset($_POST["action"])) {
    $action = $_POST["action"];
    if ($action == "cek_shift" && isset($_POST["Hari"])) {
        $nama_barang = $_POST["Hari"];
        $query_cek = mysqli_query($mysqli, "SELECT * FROM shift WHERE Hari = '$Hari'");
        echo (mysqli_num_rows($query_cek) > 0) ? "ADA" : "GA ADA";
        exit;
    }
    if ($action == "tambah_data") {
        $Jam_masuk = $_POST["Jam_masuk"];
        $Jam_keluar = $_POST["Jam_keluar"];

        $query_tambah = mysqli_query($mysqli, "INSERT INTO shift (Hari, Jam_masuk, Jam_keluar) VALUES ('$Hari',$Jam_masuk, $Jam_keluar, NOW())");
        if ($query_tambah) {
            echo json_encode(['success' => 'Data berhasil ditambah!']);
        } else {
            echo json_encode(['error' => 'Data gagal ditambah!']);
        }
    }
    if ($action == "edit_data") {
        $ID_Karyawan = $_POST["ID_Karyawan"];
        $Jam_masuk = $_POST["Jam_masuk"];
        $Jam_keluar = $_POST["Jam_keluar"];

        $query_edit = mysqli_query($mysqli, "UPDATE shift SET Hari = '$Hari', Jam_masuk = $Jam_masuk, Jam_keluar = $Jam_keluar WHERE ID_Karyawan = $ID_Karyawan");
        if ($query_edit) {
            echo json_encode(['success' => 'Data berhasil diperbarui']);
        } else {
            echo json_encode(['error' => 'Data gagal diperbarui']);
        }
        exit;
    }

    if ($action == "edit") {
        $id_barang = $_POST["ID_Karyawan"];
        $query = mysqli_query($mysqli, "SELECT * FROM shift WHERE ID_Karyawan = $ID_Karyawan");
        if ($data = mysqli_fetch_assoc($query)) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }
        exit;
    }

    if ($action == "hapus_data" && isset($_POST["ID_Karyawan"])) {
        $id_barang = $_POST["ID_Karyawan"];
        $query = mysqli_query($mysqli, "DELETE FROM shift WHERE ID_Karyawan = $ID_Karyawan");
        if ($query) {
            echo json_encode(['success' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['error' => 'Maaf, barang ini tidak bisa dihapus karena telah dipakai dalam transaksi.']);
        }
        exit;
    }


}
