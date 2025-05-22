<?php
include('../../koneksi.php');
if (isset($_POST["action"])) {
    $action = $_POST["action"];
    if ($action == "cek_barang" && isset($_POST["barang_nama"])) {
        $nama_barang = $_POST["barang_nama"];
        $query_cek = mysqli_query($mysqli, "SELECT * FROM barang WHERE Nama_Barang = '$nama_barang'");
        echo (mysqli_num_rows($query_cek) > 0) ? "ADA" : "GA ADA";
        exit;
    }
    if ($action == "tambah_data") {
        $kategori_id = $_POST["kategori_id"];
        $barang_nama = $_POST["barang_nama"];
        $harga_beli = $_POST["harga_beli"];
        $harga_jual = $_POST["harga_jual"];
        $supplier_id = $_POST["supplier_id"];
        $stok = $_POST["stok"];
        $expired = $_POST["expired"];

        $query_tambah = mysqli_query($mysqli, "INSERT INTO barang (Nama_Barang, ID_Suplier, ID_Kategori, Expired, Harga_Jual, Harga_Beli, Stok,  newArrival_date) VALUES ('$barang_nama',$supplier_id, $kategori_id, '$expired' , $harga_jual, $harga_beli, $stok, NOW())");
        if ($query_tambah) {
            echo json_encode(['success' => 'Data berhasil ditambah!']);
        } else {
            echo json_encode(['error' => 'Data gagal ditambah!']);
        }
    }
    if ($action == "edit_data") {
        $barang_id = $_POST["barang_id"];
        $kategori_id = $_POST["kategori_id"];
        $barang_nama = $_POST["barang_nama"];
        $harga_beli = $_POST["harga_beli"];
        $harga_jual = $_POST["harga_jual"];
        $supplier_id = $_POST["supplier_id"];
        $stok = $_POST["stok"];
        $expired = $_POST["expired"];

        $query_edit = mysqli_query($mysqli, "UPDATE barang SET Nama_Barang = '$barang_nama', ID_Suplier = $supplier_id, ID_Kategori = $kategori_id, Expired = '$expired', Harga_Jual = $harga_jual, Harga_Beli = $harga_beli, Stok = $stok  WHERE ID_Barang = $barang_id");
        if ($query) {
            echo json_encode(['success' => 'Data berhasil diperbarui']);
        } else {
            echo json_encode(['error' => 'Data gagal diperbarui']);
        }
        exit;
    }

    if ($action == "edit") {
        $id_barang = $_POST["id_barang"];
        $query = mysqli_query($mysqli, "SELECT * FROM barang WHERE ID_Barang = $id_barang");
        if ($data = mysqli_fetch_assoc($query)) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }
        exit;
    }
}
