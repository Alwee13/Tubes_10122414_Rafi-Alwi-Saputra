<?php
include '../koneksi/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $jabatan_id = $_POST['jabatan_id'];

    $sql = "UPDATE Pegawai SET nama='$nama', jenis_kelamin='$jenis_kelamin', alamat='$alamat', telepon='$telepon', jabatan_id=$jabatan_id WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: pegawai.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>