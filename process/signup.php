<?php 
require_once "../config/koneksi.php";
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$no_telp = $_POST['telp'];
$pass = base64_encode($_POST['pass']);
$province_name = $_POST['province_name'];
$city_name = $_POST['city_name'];
$district_name = $_POST['district_name'];
$village_name = $_POST['village_name'];
$alamat = $_POST['alamat'];

$get_customer_code = mysqli_fetch_array(mysqli_query($koneksi, "SELECT max(id) maxid from customer"));
$last_num = ++$get_customer_code['maxid'];
$customer_code = "CS".sprintf('%04d',$last_num);
$insert_user = mysqli_query($koneksi,"INSERT into users(fullname,username,email,level,password) value('$fullname','$username','$email',2,'$pass')");
$id_user = mysqli_insert_id($koneksi);
$insert_customer = mysqli_query($koneksi,"INSERT into customer(kode_customer,customer_name,email,no_telp,provinsi,kota,kecamatan,kelurahan,alamat,id_user) values('$customer_code','$fullname','$email','$no_telp','$province_name','$city_name','$district_name','$village_name','$alamat','$id_user')");

$data = [
    'code' => '500',
    'title' => 'Error',
    'message' => 'Internal Server Error',
];

if ($insert_user && $insert_customer) {
    $data = [
        'code' => '200',
        'title' => 'Success',
        'message' => 'Registrasi berhasil'
    ];
}


echo json_encode($data);


?>