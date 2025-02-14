<?php
$host = 'localhost';
$db = 'MySQL_IF-11_Kepegawaian';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>