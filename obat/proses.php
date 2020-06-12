<?php 
require_once "../config/koneksi.php";
require_once "../assets/libs/vendor/autoload.php";



use Ramsey\Uuid\Uuid;

$uuid = Uuid::uuid4();

if(isset($_POST['add'])) {
	$uuid->toString();
    $uuid->getFields()->getVersion();
    $nama = trim(mysqli_real_escape_string($conn, $_POST['nama']));
    $ket = trim(mysqli_real_escape_string($conn, $_POST['ket']));
    mysqli_query($conn, "INSERT INTO tb_obat (id_obat, nama_obat, ket_obat) VALUES ('$uuid', '$nama', '$ket')") or die(mysqli_error());
    echo "<script>alert('Data Berhasil Ditambahkan!');window.location='data.php';</script>";
} else if(isset($_POST['edit'])) {
	$id = $_POST['id'];
	$nama = trim(mysqli_real_escape_string($conn, $_POST['nama']));
    $ket = trim(mysqli_real_escape_string($conn, $_POST['ket']));
    mysqli_query($conn, "UPDATE tb_obat SET nama_obat = '$nama', ket_obat = '$ket' WHERE id_obat = '$id'") or die(mysqli_error());
    echo "<script>alert('Data Berhasil Diubah!');window.location='data.php';</script>";
}

?>