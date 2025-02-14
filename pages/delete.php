<?php
include '../koneksi/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus data dari database
    $sql = "DELETE FROM pegawai WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Pegawai berhasil dihapus!'); window.location.href='pegawai.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pegawai.'); window.history.back();</script>";
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Akses tidak valid!'); window.location.href='pegawai.php';</script>";
}
?>