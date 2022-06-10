<?php 
require_once "../config/koneksi.php";
$email = $_POST['email'];
$pass = base64_encode($_POST['pass']);

$user = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from users where (email='$email' or username='$email') and password='$pass'"));
$user['kode_customer'] = '';
if (isset($user['id'])) {
    if ($user['level']==2) {
        $get_customer = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from customer where id_user='".$user['id']."'"));
        $user['kode_customer'] = $get_customer['kode_customer'];
    }
    session_start();
    $_SESSION['username'] = $user['username'];
    $_SESSION['fullname'] = $user['fullname'];
	$_SESSION['email'] = $user['email'];
	$_SESSION['id'] = $user['id'];
	$_SESSION['kode_customer'] = $user['kode_customer'];
	$_SESSION['level'] = $user['level'];
	$_SESSION['status'] = "login";
	$_SESSION['greeting'] = 1;

    $data = [
        "code" => 200,
        "title" => "Login Success",
        "message" => "Redirecting to home page",
        "data" => [
            "level" => $user['level'],
        ],
    ];
}else{
    $data = [
        "code" => 500,
        "title" => "Login Failed",
        "message" => "Incorrect Username or Password",
    ];
}
echo json_encode($data);
?>