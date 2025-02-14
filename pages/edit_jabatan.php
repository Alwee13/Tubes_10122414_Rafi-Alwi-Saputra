<?php include '../koneksi/db.php'; 
$id = $_GET['id'];
$sql = "SELECT * FROM Jabatan WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($_POST['UpdateJabatan'])) {
    $nama_jabatan = $_POST['nama_jabatan'];

    $sql = "UPDATE Jabatan SET nama_jabatan ='$nama_jabatan' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: jabatan.php");
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
    <title>Update Jabatan</title>
    <!-- Bootstrap Css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Style Css -->
    <link href="../css/styles.css" rel="stylesheet" />
</head>
<body class="bg-data">
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php
        require_once('_sidebar.php');
        ?>
        <!-- Main content -->
        <main class="col-md-10 ms-auto px-4">
            <div id="pegawai">
                <div class="container-md bg-dark text-light rounded-4 mt-3">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row py-3">
                            <div class="col-lg-12 text-light">
                                <h5>Edit Jabatan</h5>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4">
                                Nama Jabatan
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="<?php echo $row['nama_jabatan']; ?>" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end py-3">
                            <button type="button" class="btn text-decoration-none text-light" onclick="window.location.href='jabatan.php';">Batal</button>
                            <input type="submit" name="UpdateJabatan" class="btn btn-primary" value="Update" style="border: none; border-radius: 30px; background-color: grey;">
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
