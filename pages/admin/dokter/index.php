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
Tambah / Edit Dokter
<?php
$main_title = ob_get_clean();
ob_flush();

// Content section
ob_start();
?>
<form class="form col" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <?php
    $nama = '';
    $alamat = '';
    $no_hp = '';
    $id_poli = 0;
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM dokter WHERE id = :id");
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $nama = $row['nama'];
                $alamat = $row['alamat'];
                $no_hp = $row['no_hp'];
                $id_poli = $row['id_poli'];
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
        <label for="nama" class="form-label fw-bold">Nama Dokter</label>
        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Dokter" value="<?php echo htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="row mt-3">
        <label for="alamat" class="form-label fw-bold">Alamat</label>
        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo htmlspecialchars($alamat, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="row mt-3">
        <label for="no_hp" class="form-label fw-bold">No HP</label>
        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No HP" value="<?php echo htmlspecialchars($no_hp, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>
    <div class="row mt-3">
        <label for="id_poli" class="form-label fw-bold">Poli</label>
        <select class="form-control" name="id_poli" id="id_poli" required>
            <?php
            $stmt = $pdo->query("SELECT * FROM poli");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($id_poli == $row['id']) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "' $selected>" . htmlspecialchars($row['nama_poli'], ENT_QUOTES, 'UTF-8') . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="row d-flex mt-3 mb-3">
        <button type="submit" class="btn btn-primary" style="width: 3cm;" name="simpan">Simpan</button>
    </div>
</form>

<div class="row d-flex mt-3 mb-3">
    <a href="<?= $base_admin . '/dokter' ?>">
        <button class="btn btn-secondary ml-2" style="width: 3cm;">Reset</button>
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dokter</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No. HP</th>
                    <th scope="col">Poli</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $pdo->query("SELECT * FROM dokter");
                $no = 1;
                while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($data['alamat'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($data['no_hp'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <?php
                            $id_poli = $data['id_poli'];
                            $stmt = $pdo->prepare("SELECT nama_poli FROM poli WHERE id = :id");
                            $stmt->bindParam(':id', $id_poli, PDO::PARAM_INT);
                            $stmt->execute();
                            $poli = $stmt->fetch(PDO::FETCH_ASSOC);
                            echo htmlspecialchars($poli['nama_poli'] ?? 'Tidak Diketahui', ENT_QUOTES, 'UTF-8');
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-success" href="index.php?page=obat&id=<?php echo htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8'); ?>">Ubah</a>
                            <a class="btn btn-danger" href="index.php?page=obat&id=<?php echo htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8'); ?>&aksi=hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
            $nama = trim($_POST['nama']);
            $alamat = trim($_POST['alamat']);
            $no_hp = trim($_POST['no_hp']);
            $id_poli = intval($_POST['id_poli']);

            if (!empty($nama) && !empty($alamat) && !empty($no_hp) && $id_poli > 0) {
                try {
                    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
                        $stmt = $pdo->prepare("UPDATE dokter SET nama = :nama, alamat = :alamat, no_hp = :no_hp, id_poli = :id_poli WHERE id = :id");
                        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
                    } else {
                        $stmt = $pdo->prepare("INSERT INTO dokter (nama, alamat, no_hp, id_poli) VALUES (:nama, :alamat, :no_hp, :id_poli)");
                    }
                    $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
                    $stmt->bindParam(':alamat', $alamat, PDO::PARAM_STR);
                    $stmt->bindParam(':no_hp', $no_hp, PDO::PARAM_STR);
                    $stmt->bindParam(':id_poli', $id_poli, PDO::PARAM_INT);
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
                $stmt = $pdo->prepare("DELETE FROM dokter WHERE id = :id");
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
