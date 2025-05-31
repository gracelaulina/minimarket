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
            $query_penjualan = "INSERT INTO penjualan 
            (ID_Karyawan, Tanggal, Metode_Pembayaran, Total, Diskon_Resi, Grandtotal) 
            VALUES ('$ID_Karyawan', '$Tanggal', '$Metode_Pembayaran', '$Total', '$Diskon_Resi', '$Grandtotal')";
            $insert_penjualan = mysqli_query($mysqli, $query_penjualan);

            if (!$insert_penjualan) {
                throw new Exception("Gagal insert penjualan: " . mysqli_error($mysqli));
            }

            $id_penjualan = mysqli_insert_id($mysqli);

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
    if ($action == "lihat_detail") {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            $stmt = mysqli_prepare($mysqli, "SELECT dp.*, b.Nama_Barang AS nama_barang 
                                         FROM detail_penjualan dp 
                                         LEFT JOIN barang b ON dp.ID_Barang = b.ID_Barang 
                                         WHERE dp.ID_Penjualan = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $harga = $row['Harga'];
                    $diskon = $row['Diskon'];
                    $qty = $row['Qty'];
                    $subtotal1 = $harga - ($harga * $diskon / 100);
                    $subtotal2 = $subtotal1 * $qty;

                    echo "<tr>
                        <td>{$row['nama_barang']}</td>
                        <td>Rp " . number_format($harga, 0, ',', '.') . "</td>
                        <td>{$diskon}%</td>
                        <td>Rp " . number_format($subtotal1, 0, ',', '.') . "</td>
                        <td>{$qty}</td>
                        <td>Rp " . number_format($subtotal2, 0, ',', '.') . "</td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-muted'>Tidak ada detail penjualan.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-danger'>ID tidak ditemukan.</td></tr>";
        }
    }
    if ($action == "edit_data") {
        $ID_Penjualan        = mysqli_real_escape_string($mysqli, $_POST['ID_Penjualan']);
        $ID_Karyawan         = mysqli_real_escape_string($mysqli, $_POST['ID_Karyawan']);
        $Tanggal             = mysqli_real_escape_string($mysqli, $_POST['Tanggal']);
        $Metode_Pembayaran   = mysqli_real_escape_string($mysqli, $_POST['Metode_Pembayaran']);
        $Total               = mysqli_real_escape_string($mysqli, $_POST['Total']);
        $Diskon_Resi         = mysqli_real_escape_string($mysqli, $_POST['Diskon_Resi']);
        $Grandtotal          = mysqli_real_escape_string($mysqli, $_POST['Grandtotal']);
        $delete_id           = isset($_POST['delete_id']) ? $_POST['delete_id'] : '';
        $detail              = json_decode($_POST['detail'], true);

        // Update penjualan
        $update_query = "UPDATE penjualan SET 
                        ID_Karyawan = ?, 
                        Tanggal = ?, 
                        Metode_Pembayaran = ?, 
                        Total = ?, 
                        Diskon_Resi = ?, 
                        Grandtotal = ?
                    WHERE ID_Penjualan = ?";
        $stmt = $mysqli->prepare($update_query);
        $stmt->bind_param("issdddi", $ID_Karyawan, $Tanggal, $Metode_Pembayaran, $Total, $Diskon_Resi, $Grandtotal, $ID_Penjualan);
        $stmt->execute();

        // Hapus detail jika ada
        if (!empty($delete_id)) {
            $delete_id = preg_replace('/[^0-9,]/', '', $delete_id); // Amankan input
            $mysqli->query("DELETE FROM detail_penjualan WHERE ID_Penjualan_Detail IN ($delete_id)");
        }

        // Simpan detail
        foreach ($detail as $item) {
            $ID_Detail = isset($item['ID_Penjualan_Detail']) ? $item['ID_Penjualan_Detail'] : null;
            $ID_Barang = $item['id_barang'];
            $Kategori  = $item['id_kategori'];
            $Harga     = $item['harga'];
            $Qty       = $item['qty'];
            $Diskon    = $item['diskon'];

            if (!empty($ID_Detail)) {
                // Update detail
                $stmt = $mysqli->prepare("UPDATE detail_penjualan SET 
                                        ID_Barang = ?, 
                                        ID_Kategori = ?, 
                                        Harga = ?, 
                                        Qty = ?, 
                                        Diskon = ? 
                                      WHERE ID_Penjualan_Detail = ?");
                $stmt->bind_param("iidiii", $ID_Barang, $Kategori, $Harga, $Qty, $Diskon, $ID_Detail);
            } else {
                // Insert detail baru
                $stmt = $mysqli->prepare("INSERT INTO detail_penjualan 
                                        (ID_Penjualan, ID_Barang, ID_Kategori, Harga, Qty, Diskon) 
                                      VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iiidii", $ID_Penjualan, $ID_Barang, $Kategori, $Harga, $Qty, $Diskon);
            }

            $stmt->execute();
        }

        echo json_encode([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'id_penjualan' => $ID_Penjualan
        ]);
        exit;
    }
    if ($action == "hapus_data") {
        $id_penjualan = $_POST["id_penjualan"];
        $query = mysqli_query($mysqli, "DELETE FROM detail_penjualan WHERE ID_Penjualan = $id_penjualan");
        $query2 = mysqli_query($mysqli, "DELETE FROM penjualan WHERE ID_Penjualan = $id_penjualan");

        if ($query2) {
            echo json_encode(['success' => 'Transaksi berhasil dihapus']);
        } else {
            echo json_encode(['error' => 'Maaf, gagal hapus transaksi.']);
        }
        exit;
    }
}
