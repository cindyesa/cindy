<?php
session_start();
include_once("../../config/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = htmlspecialchars($_POST['nama']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $no_ktp = htmlspecialchars($_POST['no_ktp']);
  $no_hp = htmlspecialchars($_POST['no_hp']);

  // Cek apakah pasien sudah terdaftar berdasarkan nomor KTP
  $check_pasien = $conn->prepare("SELECT id, nama, no_rm FROM pasien WHERE no_ktp = ?");
  $check_pasien->bind_param("s", $no_ktp);
  $check_pasien->execute();
  $result_check_pasien = $check_pasien->get_result();

  if ($result_check_pasien->num_rows > 0) {
    $row = $result_check_pasien->fetch_assoc();
    if ($row['nama'] != $nama) {
      echo "<script>alert('Nama pasien tidak sesuai dengan nomor KTP yang terdaftar.');</script>";
      echo "<meta http-equiv='refresh' content='0; url=register.php'>";
      die();
    }
    $_SESSION['signup'] = true;
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $nama;
    $_SESSION['no_rm'] = $row['no_rm'];
    $_SESSION['akses'] = 'pasien';

    echo "<meta http-equiv='refresh' content='0; url=../pasien'>";
    die();
  }

  // Mendapatkan nomor pasien terakhir
  $get_rm = $conn->prepare("SELECT MAX(SUBSTRING(no_rm, 8)) AS last_queue_number FROM pasien");
  $get_rm->execute();
  $result_rm = $get_rm->get_result();
  $lastQueueNumber = $result_rm->num_rows > 0 ? ($result_rm->fetch_assoc()['last_queue_number'] ?: 0) : 0;

  $tahun_bulan = date("Ym");
  $newQueueNumber = $lastQueueNumber + 1;
  $no_rm = $tahun_bulan . "-" . str_pad($newQueueNumber, 3, '0', STR_PAD_LEFT);

  $insert = $conn->prepare("INSERT INTO pasien (nama, alamat, no_ktp, no_hp, no_rm) VALUES (?, ?, ?, ?, ?)");
  $insert->bind_param("sssss", $nama, $alamat, $no_ktp, $no_hp, $no_rm);

  if ($insert->execute()) {
    $_SESSION['signup'] = true;
    $_SESSION['id'] = $insert->insert_id;
    $_SESSION['username'] = $nama;
    $_SESSION['no_rm'] = $no_rm;
    $_SESSION['akses'] = 'pasien';

    echo "<meta http-equiv='refresh' content='0; url=../pasien'>";
    die();
  } else {
    echo "Error: " . $insert->error;
  }

  $insert->close();
  $check_pasien->close();
  $get_rm->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik | Registrasi</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <style>
    body {
      background: linear-gradient(to bottom right, #11B69F, #0e9785);
      font-family: 'Arial', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .register-box {
      background-color: white;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      padding: 30px;
      width: 400px;
      animation: fadeIn 0.5s ease-in-out;
    }
    .register-box h1 {
      font-size: 28px;
      color: #11B69F;
      text-align: center;
      margin-bottom: 20px;
    }
    .form-control {
      border: 1px solid #ccc;
      border-radius: 30px;
      padding: 12px 15px;
      margin-bottom: 15px;
    }
    .btn-primary {
      background-color: #11B69F;
      color: white;
      border: none;
      border-radius: 30px;
      padding: 12px 20px;
      width: 100%;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn-primary:hover {
      background-color: #0a8d72;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .form-footer {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }
    .form-footer a {
      color: #11B69F;
      text-decoration: underline;
    }
    .form-footer a:hover {
      color: #0e9785;
    }
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
<div class="register-box">
  <h1>BK-Poliklinik</h1>
  <form action="" method="post">
    <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" required>
    <input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
    <input type="number" class="form-control" placeholder="No KTP" name="no_ktp" required>
    <input type="number" class="form-control" placeholder="No HP" name="no_hp" required>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="terms" name="terms" value="agree" required>
      <label class="form-check-label" for="terms">Saya setuju dengan <a href="#">syarat & ketentuan</a></label>
    </div>
    <button type="submit" class="btn-primary">Daftar</button>
    <div class="form-footer">
      Sudah memiliki akun? <a href="login-pasien.php">Login</a>
    </div>
  </form>
</div>
</body>
</html>
