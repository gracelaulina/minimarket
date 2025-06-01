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
                'harga'     => $row['Harga_Jual']
                        ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    if ($action == "tambah_data") {
        $Nama_Promo    = mysqli_real_escape_string($mysqli, $_POST['Nama_Promo']);
        $Tanggal_Awal  = mysqli_real_escape_string($mysqli, $_POST['Tanggal_Awal']);
        $Tanggal_Akhir = mysqli_real_escape_string($mysqli, $_POST['Tanggal_Akhir']);
        $detail        = json_decode($_POST['detail'], true);


        try {
            $mysqli->begin_transaction();
            $query_pembelian = "INSERT INTO promo_musiman 
            (Nama_Promo, Tanggal_Awal, Tanggal_Akhir, Status) 
            VALUES ('$Nama_Promo','$Tanggal_Awal', '$Tanggal_Akhir', 'Aktif')";
            $insert_promo = mysqli_query($mysqli, $query_pembelian);

            if (!$insert_promo) {
                throw new Exception("Gagal insert promo: " . mysqli_error($mysqli));
            }

            $ID_Promo_Musiman = mysqli_insert_id($mysqli);

            foreach ($detail as $item) {
                $id_barang   = mysqli_real_escape_string($mysqli, $item['id_barang']);
                $harga       = mysqli_real_escape_string($mysqli, $item['harga']);
                $diskon      = mysqli_real_escape_string($mysqli, $item['diskon']);

                $query_detail = "INSERT INTO detail_promo_musiman
                (ID_Promo_Musiman, ID_Barang, Harga, Diskon)
                VALUES ('$ID_Promo_Musiman', '$id_barang', '$harga', '$diskon')";
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
    if ($action == "lihat_detail") {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            $stmt = mysqli_prepare($mysqli, "SELECT p.*, b.Nama_Barang FROM detail_promo_musiman p LEFT JOIN barang b ON p.ID_Barang = b.ID_Barang  WHERE p.ID_Promo_Musiman = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $harga = $row['Harga'];
                    $diskon = $row['Diskon'];
                    $harga_disc = $harga - ($harga * $diskon / 100);
                    echo "<tr>
                        <td>{$row['Nama_Barang']}</td>
                        <td>Rp " . number_format($harga, 0, ',', '.') . "</td>
                        <td>{$diskon}%</td>
                        <td>Rp " . number_format($harga_disc, 0, ',', '.') . "</td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-muted'>Tidak ada detail promo.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-danger'>ID tidak ditemukan.</td></tr>";
        }
    }
    if ($action == "edit_data") {
        $Nama_Promo    = mysqli_real_escape_string($mysqli, $_POST['Nama_Promo']);
        $Tanggal_Awal  = mysqli_real_escape_string($mysqli, $_POST['Tanggal_Awal']);
        $Tanggal_Akhir = mysqli_real_escape_string($mysqli, $_POST['Tanggal_Akhir']);
        $delete_id           = isset($_POST['delete_id']) ? $_POST['delete_id'] : '';
        $ID_Promo_Musiman    = mysqli_real_escape_string($mysqli, $_POST['ID_Promo_Musiman']);
        $detail              = json_decode($_POST['detail'], true);



        // Update promo 
        $update_query = "UPDATE promo_musiman SET 
                        Nama_Promo = ?, 
                        Tanggal_Awal = ?, 
                        Tanggal_Akhir = ? 
                    WHERE ID_Promo_Musiman = ?";
        $stmt = $mysqli->prepare($update_query);
        $stmt->bind_param("sssi", $Nama_Promo, $Tanggal_Awal, $Tanggal_Akhir, $ID_Promo_Musiman);
        $stmt->execute();

        // Hapus detail jika ada
        if (!empty($delete_id)) {
            $delete_id = preg_replace('/[^0-9,]/', '', $delete_id); // Amankan input
            $mysqli->query("DELETE FROM detail_promo_musiman WHERE ID_Detail_Promo_Musiman IN ($delete_id)");
        }

        // Simpan detail
        foreach ($detail as $item) {
            $ID_Detail_Promo_Musiman = isset($item['ID_Detail_Promo_Musiman']) ? $item['ID_Detail_Promo_Musiman'] : null;
            $ID_Barang = $item['id_barang'];
            $Harga     = $item['harga'];
            $Diskon    = $item['diskon'];

            if (!empty($ID_Detail_Promo_Musiman)) {
                // Update detail
                $stmt = $mysqli->prepare("UPDATE detail_promo_musiman SET 
                                        ID_Barang = ?, 
                                        Harga = ?, 
                                        Diskon = ? 
                                      WHERE ID_Detail_Promo_Musiman = ?");
                $stmt->bind_param("idii", $ID_Barang, $Harga, $Diskon, $ID_Detail_Promo_Musiman);
            } else {
                // Insert detail baru
                $stmt = $mysqli->prepare("INSERT INTO detail_promo_musiman 
                                        (ID_Promo_Musiman, ID_Barang, Harga, Diskon) 
                                      VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iidi", $ID_Promo_Musiman, $ID_Barang, $Harga,$Diskon);
            }

            $stmt->execute();
        }

        echo json_encode([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'ID_Promo_Musiman' => $ID_Promo_Musiman
        ]);
        exit;
    }
    if ($action == "hapus_data") {
        $ID_Promo = $_POST["ID_Promo"];
        $query = mysqli_query($mysqli, "DELETE FROM detail_promo_musiman WHERE ID_Promo_Musiman = $ID_Promo");
        $query2 = mysqli_query($mysqli, "DELETE FROM promo_musiman WHERE ID_Promo_Musiman = $ID_Promo");

        if ($query2) {
            echo json_encode(['success' => 'promo berhasil dihapus']);
        } else {
            echo json_encode(['error' => 'Maaf, gagal hapus promo.']);
        }
        exit;
    }
}
