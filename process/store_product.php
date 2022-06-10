<?php 
include '../config/koneksi.php';
$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$size = $_POST['size'];
$satuan = $_POST['satuan'];
$price = $_POST['price'];

if (empty($id)) {
    $query = mysqli_query($koneksi,"INSERT INTO product(title,description,size,price,satuan) VALUES('$title', '$description','$size','$price','$satuan')");
    $id = mysqli_insert_id($koneksi);
}else{
    $query = mysqli_query($koneksi,"UPDATE product set title='$title', description='$description', size='$size', satuan='$satuan', price = $price where id='$id'");
}

   if(!empty($_FILES['img']['name'])){
	$ekstensi_diperbolehkan	= array('png','jpg');
	$nama = $_FILES['img']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['img']['size'];
	$file_tmp = $_FILES['img']['tmp_name'];	
		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		    if($ukuran < 1044070){			
			move_uploaded_file($file_tmp, '../img/'.$nama);
			$query = mysqli_query($koneksi,"UPDATE product set img='$nama' where id='$id'");
			if($query){
				// echo 'FILE BERHASIL DI UPLOAD';
			}else{
				// echo 'GAGAL MENGUPLOAD GAMBAR';
			}
		    }else{
			// echo 'UKURAN FILE TERLALU BESAR';
		    }
	       }else{
		// echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
	       }
    }

    if ($query) {
        header("Location: ../pages/form_product.php");
    }
?>