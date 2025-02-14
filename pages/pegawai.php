<?php
include '../koneksi/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai</title>
    <!-- Bootstrap Css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <!-- Style Css -->
    <link href="../css/styles.css" rel="stylesheet" />
</head>
<body class="bg-data">
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php require_once('_sidebar.php'); ?>

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
                                        <h4 class="mb-0">Kelola Pegawai</h4>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-3">
                                    <div class="col">
                                        <a href="tambah_pegawai.php" class="btn btn-primary" type="button" style="border: none; border-radius: 30px; background-color: grey;">
                                            Tambah Pegawai
                                        </a>
                                    </div>
                                    <div class="col-lg-4">
                                        <form method="GET" action="">
                                            <div class="input-group">
                                                <label for="search" class="form-label text-light mx-3 my-1 align-items-center">Search:</label>
                                                <input type="text" class="form-control" id="search" name="search" placeholder="Cari berdasarkan nama..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush text-light" id="pegawaiTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th><a href="?sort=id&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'id' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="text-light text-decoration-none">ID</a></th>
                                                <th><a href="?sort=nama&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'nama' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="text-light text-decoration-none">Nama</a></th>
                                                <th><a href="?sort=jenis_kelamin&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'jenis_kelamin' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="text-light text-decoration-none">Jenis Kelamin</a></th>
                                                <th><a href="?sort=alamat&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'alamat' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="text-light text-decoration-none">Alamat</a></th>
                                                <th><a href="?sort=telepon&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'telepon' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="text-light text-decoration-none">Telepon</a></th>
                                                <th><a href="?sort=nama_jabatan&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'nama_jabatan' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="text-light text-decoration-none">Jabatan</a></th>
                                                <th><a href="?sort=gaji&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'gaji' && isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC'; ?>" class="text-light text-decoration-none">Gaji</a></th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <?php
                                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                                            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
                                            $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
                                            $limit = 10; // Jumlah data per halaman
                                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $offset = ($page - 1) * $limit;

                                            $sql = "SELECT Pegawai.id, Pegawai.nama, Pegawai.jenis_kelamin, Pegawai.alamat, Pegawai.telepon, Jabatan.nama_jabatan, Pegawai.gaji 
                                                    FROM Pegawai 
                                                    JOIN Jabatan ON Pegawai.jabatan_id = Jabatan.id 
                                                    WHERE Pegawai.nama LIKE '%$search%'
                                                    ORDER BY $sort $order
                                                    LIMIT $limit OFFSET $offset";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                            <td>{$row['id']}</td>
                                                            <td>{$row['nama']}</td>
                                                            <td>{$row['jenis_kelamin']}</td>
                                                            <td>{$row['alamat']}</td>
                                                            <td>{$row['telepon']}</td>
                                                            <td>{$row['nama_jabatan']}</td>
                                                            <td>Rp. " . number_format($row['gaji'], 0, ',', '.') . "</td>
                                                            <td>
                                                                <a href='edit_pegawai.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                                                <a href='delete.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                                                            </td>
                                                        </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                // Hitung total data untuk pagination
                                $total_sql = "SELECT COUNT(*) as total FROM Pegawai WHERE Pegawai.nama LIKE '%$search%'";
                                $total_result = $conn->query($total_sql);
                                $total_row = $total_result->fetch_assoc();
                                $total = $total_row['total'];
                                $total_pages = ceil($total / $limit);

                                // Tampilkan pagination
                                echo "<nav aria-label='Page navigation'>
                                        <ul class='pagination justify-content-center'>
                                            <li class='page-item " . ($page == 1 ? 'disabled' : '') . "'>
                                                <a class='page-link' href='?page=" . ($page - 1) . "&search=$search&sort=$sort&order=$order' aria-label='Previous'>
                                                    <span aria-hidden='true'>«</span>
                                                </a>
                                            </li>";

                                for ($i = 1; $i <= $total_pages; $i++) {
                                    echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'>
                                            <a class='page-link' href='?page=$i&search=$search&sort=$sort&order=$order'>$i</a>
                                          </li>";
                                }

                                echo "<li class='page-item " . ($page == $total_pages ? 'disabled' : '') . "'>
                                        <a class='page-link' href='?page=" . ($page + 1) . "&search=$search&sort=$sort&order=$order' aria-label='Next'>
                                            <span aria-hidden='true'>»</span>
                                        </a>
                                      </li>
                                    </ul>
                                  </nav>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="../js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('search').addEventListener('input', function() {
    var searchValue = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '', true); // Kirim ke file yang sama
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Ambil data dari response dan perbarui tabel
            var response = JSON.parse(xhr.responseText);
            var tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = response.data;
        }
    };
    xhr.send('search=' + encodeURIComponent(searchValue));
});
</script>
</body>
</html>