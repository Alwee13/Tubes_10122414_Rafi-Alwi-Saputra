<?php
include '../koneksi/db.php';

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM jabatan WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the same page after deletion
        header("Location: jabatan.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jabatan</title>
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
            <div class="row py-3 align-items-center">
            </div>
            <div id="kelola_admin">
                <div class="container-md bg-dark rounded-4">
                    <div class="row text-light">
                        <div class="col-xl-12 mb-5 mb-xl-0">
                            <div class="card border-0">
                                <div class="row align-items-center py-3">
                                    <div class="col">
                                        <h4 class="mb-0">Kelola Jabatan</h4>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col">
                                        <a href="tambah_jabatan.php" class="btn btn-primary" type="button" style="border: none; border-radius: 30px; background-color: grey;">
                                        Tambah Jabatan
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush text-light">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Jabatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT jabatan.id, jabatan.nama_jabatan
                                                    FROM jabatan ";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                            <td>{$row['id']}</td>
                                                            <td>{$row['nama_jabatan']}</td>
                                                            <td>
                                                                <a href='edit_jabatan.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                                                <a href='jabatan.php?action=delete&id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                                                            </td>
                                                        </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>