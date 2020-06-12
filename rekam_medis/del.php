<?php require_once "../config/koneksi.php";

mysqli_query($conn, "DELETE FROM tb_rekammedis WHERE id_rm = '$_GET[id]'") or die(mysqli_error($conn));
echo "<script>alert('Data Berhasil Dihapus!');window.location='data.php';</script>";

?>