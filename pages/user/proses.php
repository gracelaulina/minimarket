<?php
include('../../koneksi.php');
if (isset($_POST["action"])) {
    $action = $_POST["action"];
    if ($action == "cek_user" && isset($_POST["ID_Karyawan"])) {
        $ID_Karyawan = $_POST["ID_Karyawan"];
        $query_cek = mysqli_query($mysqli, "SELECT * FROM user WHERE ID_Karyawan = '$ID_Karyawan'");
        echo (mysqli_num_rows($query_cek) > 0) ? "ADA" : "GA ADA";
        exit;
    }
    if ($action == "tambah_data") {
        $ID_Karyawan = $_POST["ID_Karyawan"];
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        $query_tambah = mysqli_query($mysqli, "INSERT INTO user (ID_Karyawan,username, password) VALUES ('$ID_Karyawan','$username', '$password')");
        if ($query_tambah) {
            echo json_encode(['success' => 'Data berhasil ditambah!']);
        } else {
            echo json_encode(['error' => 'Data gagal ditambah!']);
        }
    }
    if ($action == "edit_data") {
        $ID_Karyawan = $_POST["ID_Karyawan"];
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        $query_edit = mysqli_query($mysqli, "UPDATE user SET username = '$username', password = '$password' WHERE ID_Karyawan = $ID_Karyawan");
        if ($query_edit) {
            echo json_encode(['success' => 'Data berhasil diperbarui']);
        } else {
            echo json_encode(['error' => 'Data gagal diperbarui']);
        }
        exit;
    }

    if ($action == "edit") {
        $ID_Karyawan = $_POST["ID_Karyawan"];
        $query = mysqli_query($mysqli, "SELECT * FROM user WHERE ID_Karyawan = $ID_Karyawan");
        if ($data = mysqli_fetch_assoc($query)) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }
        exit;
    }

    if ($action == "hapus_data" && isset($_POST["ID_Karyawan"])) {
        $ID_Karyawan = $_POST["ID_Karyawan"];
        $query = mysqli_query($mysqli, "DELETE FROM user WHERE ID_Karyawan = $ID_Karyawan");
        if ($query) {
            echo json_encode(['success' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['error' => 'Maaf, user ini tidak bisa dihapus karena telah terlibat dalam transaksi.']);
        }
        exit;
    }
}
