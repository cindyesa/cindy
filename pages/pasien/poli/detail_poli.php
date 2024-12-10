<?php
include_once("../../../config/conn.php");
session_start();

if (!isset($_SESSION['login'])) {
  echo "<meta http-equiv='refresh' content='0; url=../auth/login.php'>";
  die();
}

$nama = $_SESSION['username'];
$akses = $_SESSION['akses'];

if ($akses != 'pasien') {
  echo "<meta http-equiv='refresh' content='0; url=../..'>";
  die();
}

$id_pasien = $_SESSION['id']; // ID pasien diambil dari session
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>History Poli Pasien</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #eef2f7;
      font-family: 'Arial', sans-serif;
    }
    .container {
      margin-top: 30px;
      padding: 25px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .header-title {
      text-align: center;
      margin-bottom: 30px;
      color: #0056b3;
      font-weight: bold;
      font-size: 24px;
    }
    table {
      margin-top: 20px;
      border-collapse: collapse;
    }
    th {
      background-color: #0056b3;
      color: white;
      text-align: center;
      font-size: 16px;
    }
    td {
      text-align: center;
      vertical-align: middle;
      padding: 10px;
    }
    tr:hover {
      background-color: #f1f8ff; /* Warna hover untuk baris */
      transition: all 0.3s ease-in-out;
    }
    .btn-back {
      display: block;
      width: 150px;
      margin: 20px auto;
      background-color: #0056b3;
      color: white;
      border-radius: 25px;
      padding: 10px;
      font-weight: bold;
      text-align: center;
    }
    .btn-back:hover {
      background-color: #004494;
      transition: background-color 0.3s ease;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="header-title">History Poli Pasien</h2>
    <a href="<?= $base_pasien; ?>" class="btn btn-back">Kembali ke Home</a>
    <?php
    try {
        $query = $pdo->prepare("SELECT 
                                    p.nama AS nama_pasien,
                                    pr.tgl_periksa,
                                    pr.catatan,
                                    pr.biaya_periksa,
                                    d.nama AS nama_dokter,
                                    dpo.keluhan,
                                    GROUP_CONCAT(o.nama_obat SEPARATOR ', ') AS obat
                                FROM periksa pr
                                LEFT JOIN daftar_poli dpo ON pr.id_daftar_poli = dpo.id
                                LEFT JOIN jadwal_periksa jp ON dpo.id_jadwal = jp.id
                                LEFT JOIN dokter d ON jp.id_dokter = d.id
                                LEFT JOIN pasien p ON dpo.id_pasien = p.id
                                LEFT JOIN detail_periksa dp ON pr.id = dp.id_periksa
                                LEFT JOIN obat o ON dp.id_obat = o.id
                                WHERE dpo.id_pasien = :id_pasien
                                GROUP BY pr.id
                                ORDER BY pr.tgl_periksa DESC");
        $query->bindParam(':id_pasien', $id_pasien, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() == 0) {
            echo "<div class='alert alert-warning mt-4 text-center'>Tidak ada riwayat yang ditemukan.</div>";
        } else {
            echo '<table class="table table-bordered table-hover text-center">';
            echo '<thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pasien</th>
                      <th>Nama Dokter</th>
                      <th>Keluhan</th>
                      <th>Catatan</th>
                      <th>Obat</th>
                      <th>Biaya Periksa</th>
                      <th>Tanggal Periksa</th>
                    </tr>
                  </thead>';
            echo '<tbody>';
            $no = 1;
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>" . htmlspecialchars($row['nama_pasien']) . "</td>
                        <td>" . htmlspecialchars($row['nama_dokter']) . "</td>
                        <td>" . htmlspecialchars($row['keluhan']) . "</td>
                        <td>" . htmlspecialchars($row['catatan']) . "</td>
                        <td>" . htmlspecialchars($row['obat']) . "</td>
                        <td>Rp " . number_format($row['biaya_periksa'], 0, ',', '.') . "</td>
                        <td>" . htmlspecialchars($row['tgl_periksa']) . "</td>
                      </tr>";
                $no++;
            }
            echo '</tbody>';
            echo '</table>';
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
    ?>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
