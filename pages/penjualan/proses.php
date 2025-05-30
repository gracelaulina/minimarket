<?php
include("../../base_url.php");
include('../../koneksi.php');

if (isset($_POST["action"])) {
    $action = $_POST["action"];

    if ($action == "autocomplete") {
        $term = mysqli_real_escape_string($mysqli, $_POST["term"]);
        $query_cek = mysqli_query($mysqli, "
            SELECT b.*
            FROM barang b 
            WHERE b.Nama_Barang LIKE '%$term%' AND b.Status = 'Aktif'
        ");

        $result = [];
        while ($row = mysqli_fetch_assoc($query_cek)) {
            $result[] = [
                'label'     => $row['Nama_Barang'],
                'value'     => $row['Nama_Barang'],
                'ID_Barang' => $row['ID_Barang'],
                'kategori'  => $row['ID_Kategori'],
                'harga'     => $row['Harga_Jual'],
                'diskon'    => $row['Diskon'],
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    if ($action == "tambah_data") {
        $ID_Karyawan        = mysqli_real_escape_string($mysqli, $_POST['ID_Karyawan']);
        $Tanggal            = mysqli_real_escape_string($mysqli, $_POST['Tanggal']);
        $Metode_Pembayaran  = mysqli_real_escape_string($mysqli, $_POST['Metode_Pembayaran']);
        $Total              = mysqli_real_escape_string($mysqli, $_POST['Total']);
        $Diskon_Resi        = mysqli_real_escape_string($mysqli, $_POST['Diskon_Resi']);
        $Grandtotal         = mysqli_real_escape_string($mysqli, $_POST['Grandtotal']);
        $detail             = json_decode($_POST['detail'], true);


        try {
            $mysqli->begin_transaction();

            // Insert penjualan
            $query_penjualan = "INSERT INTO penjualan 
            (ID_Karyawan, Tanggal, Metode_Pembayaran, Total, Diskon_Resi, Grandtotal) 
            VALUES ('$ID_Karyawan', '$Tanggal', '$Metode_Pembayaran', '$Total', '$Diskon_Resi', '$Grandtotal')";
            $insert_penjualan = mysqli_query($mysqli, $query_penjualan);

            if (!$insert_penjualan) {
                throw new Exception("Gagal insert penjualan: " . mysqli_error($mysqli));
            }

            $id_penjualan = mysqli_insert_id($mysqli);

            // Insert detail penjualan
            foreach ($detail as $item) {
                $id_barang   = mysqli_real_escape_string($mysqli, $item['id_barang']);
                $id_kategori = mysqli_real_escape_string($mysqli, $item['id_kategori']);
                $harga       = mysqli_real_escape_string($mysqli, $item['harga']);
                $diskon      = mysqli_real_escape_string($mysqli, $item['diskon']);
                $qty         = mysqli_real_escape_string($mysqli, $item['qty']);

                $query_detail = "INSERT INTO detail_penjualan 
                (ID_Penjualan, ID_Barang, ID_Kategori, Harga, Diskon, Qty)
                VALUES ('$id_penjualan', '$id_barang', '$id_kategori', '$harga', '$diskon', '$qty')";
                $insert_detail = mysqli_query($mysqli, $query_detail);

                if (!$insert_detail) {
                    throw new Exception("Gagal insert detail: " . mysqli_error($mysqli));
                }
            }

            $mysqli->commit();
            echo 'success';
        } catch (Exception $e) {
            $mysqli->rollback();
            http_response_code(500);
            echo 'Gagal menyimpan data: ' . $e->getMessage();
        }
    }
}
