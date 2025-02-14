<?php
include '../koneksi/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pegawai</title>
    <!-- Bootstrap Css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <!-- Style Css -->
    <link href="../css/styles.css" rel="stylesheet" />
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-data">
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php require_once('_sidebar.php'); ?>

        <!-- Main content -->
        <main class="col-md-10 ms-auto px-4">
            <div class="row py-3 align-items-center">
                <div class="col">
                    <h4 class="mb-0 text-light">Dashboard Pegawai</h4>
                </div>
            </div>
            <div id="dashboard_pegawai">
                <div class="container-md bg-dark rounded-4">
                    <div class="row text-light">
                        <div class="col-xl-12 mb-5 mb-xl-0">
                            <div class="card border-0">
                                <div class="row align-items-center py-3">
                                    <div class="col">
                                        <h4 class="mb-0">Jumlah Pegawai Berdasarkan Jabatan</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                    // Query untuk mengambil jumlah pegawai dan gaji berdasarkan jabatan
                                    $sql = "SELECT Jabatan.nama_jabatan, COUNT(Pegawai.id) AS jumlah_pegawai, AVG(Pegawai.gaji) AS rata_gaji 
                                            FROM Pegawai 
                                            JOIN Jabatan ON Pegawai.jabatan_id = Jabatan.id 
                                            GROUP BY Jabatan.nama_jabatan";
                                    $result = $conn->query($sql);

                                    $labels = [];
                                    $data = [];
                                    $rataGaji = [];
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $labels[] = $row['nama_jabatan'];
                                            $data[] = $row['jumlah_pegawai'];
                                            $rataGaji[] = $row['rata_gaji'];
                                            echo '<div class="col-md-4 mb-4">
                                                    <div class="card bg-secondary text-light">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-center">' . $row['nama_jabatan'] . '</h5>
                                                            <p class="card-text text-center">' . $row['jumlah_pegawai'] . '</p>
                                                            <p class="card-text text-center">Rata-rata Gaji: ' . number_format($row['rata_gaji'], 2) . '</p>
                                                        </div>
                                                    </div>
                                                  </div>';
                                        }
                                    } else {
                                        echo '<div class="col">
                                                <div class="alert alert-warning" role="alert">
                                                    Tidak ada data ditemukan.
                                                </div>
                                              </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Batang -->
            <div class="container-md bg-dark rounded-4 mt-4">
                <div class="row text-light">
                    <div class="col-lg-4 mb-5 mb-xl-0">
                        <div class="card border-0">
                            <div class="row align-items-center py-3">
                                <div class="col">
                                    <h4 class="mb-0">Grafik Batang - Jumlah Pegawai Berdasarkan Jabatan</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5 mb-xl-0">
                        <div class="card border-0">
                            <div class="row align-items-center py-3">
                                <div class="col">
                                    <h4 class="mb-0">Grafik Lingkaran - Jumlah Pegawai Berdasarkan Jabatan</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5 mb-xl-0">
                        <div class="card border-0">
                            <div class="row align-items-center py-3">
                                <div class="col">
                                    <h4 class="mb-0">Grafik Garis - Tren Rata-rata Gaji dari Waktu ke Waktu</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    // Data untuk grafik
    const labels = <?php echo json_encode($labels); ?>;
    const data = <?php echo json_encode($data); ?>;
    const rataGaji = <?php echo json_encode($rataGaji); ?>;

    // Grafik Batang
    const barChart = new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pegawai',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Grafik Lingkaran
    const pieChart = new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pegawai',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        }
    });

    // Grafik Garis
    const ctxLine = document.getElementById('lineChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tren Rata-rata Gaji',
                    data: rataGaji,
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                }
            }
        }
    });
</script>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>