<?php 
require_once "../config/koneksi.php";

mysqli_query($conn, "DELETE FROM tb_obat WHERE id_obat = '$_GET[id]'") or die(mysqli_error());
echo "<script>alert('Data Berhasil Dihapus!');window.location='data.php';</script>";

?>