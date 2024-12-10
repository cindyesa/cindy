<?php
include_once("../../../config/conn.php");
session_start();

// Validasi sesi login
if (!isset($_SESSION['login'])) {
    echo "<meta http-equiv='refresh' content='0; url=../auth/login.php'>";
    die();
}
$_SESSION['login'] = true;

$nama = $_SESSION['username'];
$akses = $_SESSION['akses'];

if ($akses != 'admin') {
    echo "<meta http-equiv='refresh' content='0; url=../..'>";
    die();
}
?>
<?php
$title = 'Poliklinik | Obat';
// Breadcrumb section
ob_start(); ?>
<ol class="breadcrumb float-sm-right">
  <li class="breadcrumb-item"><a href="<?= $base_admin; ?>">Home</a></li>
  <li class="breadcrumb-item active">Obat</li>
</ol>
<?php
$breadcrumb = ob_get_clean();
ob_flush();

// Title Section
ob_start(); ?>
Obat
<?php
$main_title = ob_get_clean();
ob_flush();

// Content section
ob_start();
?>
<form class="form col" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <?php
    $nama_obat = '';
    $kemasan = '';
    $harga = '';
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM obat WHERE id = :id");
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $nama_obat = htmlspecialchars($row['nama_obat'], ENT_QUOTES, 'UTF-8');
                $kemasan = htmlspecialchars($row['kemasan'], ENT_QUOTES, 'UTF-8');
                $harga = htmlspecialchars($row['harga'], ENT_QUOTES, 'UTF-8');
            } else {
                echo "<script>alert('Data tidak ditemukan'); window.location.href='index.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'); ?>">
    <?php
    }
    ?>
    <div class="row mt-3">
        <label for="nama_obat" class="form-label fw-bold">Nama Obat</label>
        <input type="text" class="form-control" name="nama_obat" id="nama_obat" placeholder="Nama Obat" value="<?php echo $nama_obat; ?>" required>
    </div>
    <div class="row mt-3">
        <label for="kemasan" class="form-label fw-bold">Kemasan</label>
        <input type="text" class="form-control" name="kemasan" id="kemasan" placeholder="Kemasan" value="<?php echo $kemasan; ?>" required>
    </div>
    <div class="row mt-3">
        <label for="harga" class="form-label fw-bold">Harga</label>
        <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" required>
    </div>
    <div class="row d-flex mt-3 mb-3">
        <button type="submit" class="btn btn-primary rounded-pill" style="width: 3cm;" name="simpan">Simpan</button>
    </div>
</form>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Obat</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Kemasan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $pdo->query("SELECT * FROM obat");
                $no = 1;
                while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($data['nama_obat'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($data['kemasan'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>Rp. <?php echo htmlspecialchars($data['harga'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a class="btn btn-success rounded-pill px-3" href="index.php?page=obat&id=<?php echo htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
                            <a class="btn btn-danger rounded-pill px-3" href="index.php?page=obat&id=<?php echo htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8'); ?>&aksi=hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
            $nama_obat = trim($_POST['nama_obat']);
            $kemasan = trim($_POST['kemasan']);
            $harga = intval($_POST['harga']);

            if (!empty($nama_obat) && !empty($kemasan) && $harga > 0) {
                try {
                    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
                        $stmt = $pdo->prepare("UPDATE obat SET nama_obat = :nama_obat, kemasan = :kemasan, harga = :harga WHERE id = :id");
                        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
                    } else {
                        $stmt = $pdo->prepare("INSERT INTO obat (nama_obat, kemasan, harga) VALUES (:nama_obat, :kemasan, :harga)");
                    }
                    $stmt->bindParam(':nama_obat', $nama_obat, PDO::PARAM_STR);
                    $stmt->bindParam(':kemasan', $kemasan, PDO::PARAM_STR);
                    $stmt->bindParam(':harga', $harga, PDO::PARAM_INT);
                    $stmt->execute();

                    echo "<script>alert('Data berhasil disimpan'); window.location.href='index.php';</script>";
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "<script>alert('Semua field wajib diisi.');</script>";
            }
        }

        if (isset($_GET['aksi']) && $_GET['aksi'] === 'hapus' && isset($_GET['id']) && is_numeric($_GET['id'])) {
            try {
                $stmt = $pdo->prepare("DELETE FROM obat WHERE id = :id");
                $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                $stmt->execute();

                echo "<script>alert('Data berhasil dihapus'); window.location.href='index.php';</script>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ?>
    </div>
</div>
<?php
$content = ob_get_clean();
ob_flush();
?>

<?php include '../../../layouts/index.php'; ?>
