<?php
session_start();
include('../config/koneksi.php');
$id = $_SESSION['id'];
$level = $_SESSION['level'];

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = base64_encode($_POST['password']);

$update = mysqli_query($koneksi,"UPDATE users set fullname = '$fullname', email = '$email', username = '$username', password = '$password' where id='$id'");

if ($level == 2) {
    $kode_customer = $_SESSION['kode_customer'];
    $update_customer = mysqli_query($koneksi,"UPDATE customer set customer_name = '$username', email = '$email' where kode_customer='$kode_customer'");
}

$data = [
        "code" => "500",
        "message" => "Profile gagal di update"
    ];

if ($update) {
    $data = [
        "code" => "200",
        "message" => "Profile berhasil di update"
    ];

    $_SESSION['username'] = $username;
    $_SESSION['fullname'] = $fullname;
	$_SESSION['email'] = $email;
}

echo json_encode($data);


?>