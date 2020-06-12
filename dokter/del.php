<?php 
require_once "../config/koneksi.php";

$chk = @$_POST['checked'];
if(!isset($chk)) {
	echo "<script>alert('Pastikan anda sudah seleksi data.');window.location='data.php';</script>";
} else {
	foreach($chk as $id) {
		$sql = mysqli_query($conn, "DELETE FROM tb_dokter WHERE id_dokter = '$id'") or die(mysqli_error($conn));
	}
	if($sql) {
		echo "<script>alert('". count($chk) ."Data berhasil dihapus.');window.location='data.php';</script>";
	} else {
		echo "<script>alert('Data gagal dihapus.');window.location='data.php';</script>";
	}
}


?>