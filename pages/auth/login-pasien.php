<?php
session_start();
include_once("../../config/conn.php");

if (isset($_SESSION['login'])) {
  echo "<meta http-equiv='refresh' content='0; url=../..'>";
  die();
}

if (isset($_POST['klik'])) {
  $username = stripslashes($_POST['nama']);
  $password = $_POST['alamat'];

  // Cek apakah username terdaftar
  $cek_username = $pdo->prepare("SELECT * FROM pasien WHERE nama = :nama");
  $cek_username->bindParam(':nama', $username, PDO::PARAM_STR);
  try {
    $cek_username->execute();
    if ($cek_username->rowCount() == 1) {
      $baris = $cek_username->fetch(PDO::FETCH_ASSOC);
      // Verifikasi password
      if ($password == $baris['alamat']) {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $baris['id'];
        $_SESSION['username'] = $baris['nama'];
        $_SESSION['no_rm'] = $baris['no_rm'];
        $_SESSION['akses'] = 'pasien';
        echo "<meta http-equiv='refresh' content='0; url=../pasien/index.php'>";
        die();
      }
    }
  } catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
    echo "<meta http-equiv='refresh' content='0;'>";
    die();
  }
  $_SESSION['error'] = 'Nama dan Password Tidak Cocok';
  echo "<meta http-equiv='refresh' content='0;'>";
  die();
}
?>

<!DOCTYPE html>
<html lang="id-ID">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik | Masuk</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-image: linear-gradient(to bottom right, #11B69F, #0e9785);
      font-family: 'Arial', sans-serif;
    }
    .container {
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      display: flex;
      overflow: hidden;
      width: 850px;
      max-width: 100%;
    }
    .left-box {
      background-color: #11B69F;
      color: white;
      text-align: center;
      padding: 60px 20px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .right-box {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 40px 30px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .left-box h1 {
      font-size: 32px;
      margin-bottom: 20px;
      font-weight: bold;
    }
    .left-box p {
      font-size: 16px;
    }
    .form-control {
      padding: 12px 15px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 50px;
    }
    .btn-primary {
      background-color: #11B69F;
      color: white;
      padding: 15px;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
      font-weight: bold;
      transition: 0.3s;
    }
    .btn-primary:hover {
      background-color: #0e9785;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .alert {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      border-radius: 10px;
      padding: 10px;
      text-align: center;
      margin-bottom: 15px;
    }
    .form-check a {
      color: #11B69F;
      text-decoration: underline;
    }
    .form-check a:hover {
      color: #0e9785;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="left-box">
    <h1>BK-Poliklinik</h1>
    <p>Login untuk mengakses layanan kami</p>
  </div>
  <div class="right-box">
    <?php if (isset($_SESSION['error'])) { ?>
      <div class="alert"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php } ?>
    <form method="POST">
      <input type="text" name="nama" class="form-control" placeholder="Username" required />
      <input type="password" name="alamat" class="form-control" placeholder="Password" required />
      <div class="form-check mb-4">
        <label class="form-check-label" for="agreeTerms">
          Belum punya akun? <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/cindy/pages/auth/register.php">Daftar</a>
        </label>
      </div>
      <button type="submit" name="klik" class="btn-primary">Masuk</button>
    </form>
  </div>
</div>
</body>
</html>
