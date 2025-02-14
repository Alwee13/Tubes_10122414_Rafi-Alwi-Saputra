<?php
include '../koneksi/db.php';

if (isset($_POST['tambahPegawai'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon'];
    $jabatan_id = $_POST['jabatan_id'];
    $gaji = $_POST['gaji']; // Ambil nilai gaji dari form

    $sql = "INSERT INTO Pegawai (nama, jenis_kelamin, alamat, telepon, jabatan_id, gaji) VALUES ('$nama', '$jenis_kelamin', '$alamat', '$telepon', $jabatan_id, $gaji)";

    if ($conn->query($sql) === TRUE) {
        header("Location: pegawai.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
</head>
<body class="bg-data">
<div class="container-fluid">
    <div class="row">
        <?php require_once('_sidebar.php'); ?>
        <main class="col-md-10 ms-auto px-4">
            <div id="pegawai">
                <div class="container-md bg-dark text-light rounded-4 mt-3">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row py-3">
                            <div class="col-lg-12 text-light">
                                <h5>Tambah Pegawai</h5>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4">Nama</div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4">Jenis Kelamin</div>
                            <div class="col-lg-4">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki _laki" value="L" required>
                                <label class="form-check-label" for="laki_laki">Laki-laki</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" required>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4">Alamat</div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4">Telepon</div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="telepon" name="telepon" required>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4">Jabatan</div>
                            <div class="col-lg-8">
                                <select class="form-control" id="jabatan_id" name="jabatan_id" required>
                                    <?php
                                    $sql = "SELECT * FROM Jabatan";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='{$row['id']}'>{$row['nama_jabatan']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4">Gaji</div>
                            <div class="col-lg-8">
                                <input type="number" class="form-control" id="gaji" name="gaji" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end py-3">
                            <button type="button" class="btn text-decoration-none text-light" onclick="window.location.href='pegawai.php';">Batal</button>
                            <input type="submit" name="tambahPegawai" class="btn btn-primary" value="Tambah" style="border: none; border-radius: 30px; background-color: grey;">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>