<?php
include('../../koneksi.php');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = mysqli_query($mysqli, "SELECT p.*, k.Nama as Nama_Karyawan 
                                FROM penjualan p 
                                JOIN karyawan k ON p.ID_Karyawan = k.ID_Karyawan 
                                WHERE p.ID_Penjualan = $id");
$data = mysqli_fetch_assoc($query);

// Ambil detail barang
$query_detail = mysqli_query($mysqli, "SELECT d.*, b.Nama_Barang 
                                       FROM detail_penjualan d 
                                       JOIN barang b ON d.ID_Barang = b.ID_Barang 
                                       WHERE d.ID_Penjualan = $id");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Resi Penjualan</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            width: 280px;
            margin: 0 auto;
            padding: 10px;
            line-height: 1.2;
            color: #000;
        }

        h2 {
            text-align: center;
            margin: 0 0 10px 0;
            font-size: 14px;
            letter-spacing: 2px;
        }

        p {
            margin: 4px 0;
        }

        .separator {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        th,
        td {
            padding: 4px 6px;
            border: none;
            font-size: 11px;
        }

        thead th {
            border-bottom: 1px solid #000;
            text-align: left;
        }

        tbody td:nth-child(2),
        /* Harga */
        tbody td:nth-child(3),
        /* Qty */
        tbody td:nth-child(5)

        /* Subtotal */
            {
            text-align: right;
        }

        tbody td:nth-child(4) {
            /* Diskon % */
            text-align: center;
        }

        .total-row td {
            border-top: 1px solid #000;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>

<body onload="window.print()">
    <h2>RESI PENJUALAN</h2>
    <p><strong>ID:</strong> <?= $data['ID_Penjualan'] ?></p>
    <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i', strtotime($data['Tanggal'])) ?></p>
    <p><strong>Karyawan:</strong> <?= $data['Nama_Karyawan'] ?></p>

    <div class="separator"></div>

    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Disc%</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            while ($row = mysqli_fetch_assoc($query_detail)) {
                $subtotal = ($row['Harga'] - ($row['Harga'] * $row['Diskon'] / 100)) * $row['Qty'];
                $total += $subtotal;
                echo "<tr>
                        <td>{$row['Nama_Barang']}</td>
                        <td>Rp " . number_format($row['Harga'], 0, ',', '.') . "</td>
                        <td>{$row['Qty']}</td>
                        <td>{$row['Diskon']}%</td>
                        <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                    </tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4">Total</td>
                <td>Rp <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="4">Diskon Resi</td>
                <td>Rp <?= number_format($data['Diskon_Resi'], 0, ',', '.') ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="4">Grand Total</td>
                <td>Rp <?= number_format($data['Grandtotal'], 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="separator"></div>

    <p style="text-align:center;">*** TERIMA KASIH ***</p>

</body>

</html>