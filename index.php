<?php
session_start();
include 'koneksi/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: pages/dashboard.php");
    } else {
        echo "<div class='alert alert-danger'>Login failed</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Font Awesome untuk ikon mata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-color">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card bg-dark" style="width: 400px;">
            <div class="card-body">
                <h5 class="card-title text-center text-light">Login</h5>
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label text-light">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-light">Password:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="input-group-text" id="password-toggle" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const icon = document.getElementById('password-toggle').querySelector('i');
            
            // Toggle password visibility
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.add('fa-eye');
                icon.classList.remove('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.add('fa-eye-slash');
                icon.classList.remove('fa-eye');
            }
        }
    </script>
</body>
</html>