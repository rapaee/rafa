<?php
include 'koneksi.php';
session_start();
if (isset($_SESSION['username'])) {
    header("Location:index.html");
    exit();
}
 
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
    var_dump($password);
 
    $sql = "SELECT * FROM login WHERE email='$email' AND password = '$password'";
    $result = mysqli_query($koneksi, $sql);
 
    if ($result->num_rows > 0) {    
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location:index.html");
        exit();
    } else {
        echo "<script>alert('Email atau password Anda salah. Silakan coba lagi!')</script>";
    }
}
?>