<?php
include("../../base_url.php");
include('../../koneksi.php');

if (isset($_POST["action"])) {
    $action = $_POST["action"];

    if ($action == "edit" && isset($_POST["id_kategori"])) {
        $id_kategori = $_POST["id_kategori"];
        $query = mysqli_query($mysqli, "SELECT * FROM kategori WHERE ID_Kategori = $id_kategori");
        if ($data = mysqli_fetch_assoc($query)) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }
        exit;
    }

    if ($action == "cek_kategori" && isset($_POST['nama_kategori'])) {
        $nama_kategori = $_POST["nama_kategori"];
        $query_cek = mysqli_query($mysqli, "SELECT * FROM kategori WHERE Nama_Kategori = '$nama_kategori'");
        echo (mysqli_num_rows($query_cek) > 0) ? "ADA" : "GA ADA";
        exit;
    }

    if ($action == "tambah_data" && isset($_POST['nama_kategori'])) {
        $nama_kategori = $_POST["nama_kategori"];
        $query = mysqli_query($mysqli, "INSERT INTO kategori (Nama_Kategori) VALUES ('$nama_kategori')");
        if ($query) {
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        } else {
            echo json_encode(['error' => 'Data gagal ditambahkan']);
        }
        exit;
    }

    if ($action == "edit_data" && isset($_POST['nama_kategori'], $_POST["id_kategori"])) {
        $nama_kategori = $_POST["nama_kategori"];
        $id_kategori = $_POST["id_kategori"];
        $query = mysqli_query($mysqli, "UPDATE kategori SET Nama_Kategori = '$nama_kategori' WHERE ID_Kategori = $id_kategori");
        if ($query) {
            echo json_encode(['success' => 'Data berhasil diperbarui']);
        } else {
            echo json_encode(['error' => 'Data gagal diperbarui']);
        }
        exit;
    }

    if ($action == "hapus_data" && isset($_POST["id_kategori"])) {
        $id_kategori = $_POST["id_kategori"];
        $query = mysqli_query($mysqli, "DELETE FROM kategori WHERE ID_Kategori = $id_kategori");

        if ($query) {
            echo json_encode(['success' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['error' => 'Maaf, produk ini tidak bisa dihapus karena telah dipakai dalam transaksi.']);
        }
        exit;
    }
        if ($action == "unpost" && isset($_POST["id_kategori"])) {
        $id_kategori = $_POST["id_kategori"];
        $query = mysqli_query($mysqli, "UPDATE kategori SET Status ='Non-Aktif' WHERE ID_Kategori = $id_kategori");
        if ($query) {
            echo json_encode(['success' => 'Data berhasil di Non-Aktifkan']);
        } else {
            echo json_encode(['error' => 'Data gagal di Non-Aktifkan']);
        }
        exit;
    }
    if ($action == "posting" && isset($_POST["id_kategori"])) {
        $id_kategori = $_POST["id_kategori"];
        $query = mysqli_query($mysqli, "UPDATE kategori SET Status ='Aktif' WHERE ID_Kategori = $id_kategori");
        if ($query) {
            echo json_encode(['success' => 'Data berhasil di Aktifkan']);
        } else {
            echo json_encode(['error' => 'Data gagal di Aktifkan']);
        }
        exit;
    }

}