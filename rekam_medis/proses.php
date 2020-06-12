<?php 
require_once "../config/koneksi.php";
require_once "../assets/libs/vendor/autoload.php";



use Ramsey\Uuid\Uuid;

// $uuid = Uuid::uuid4();

if(isset($_POST['add'])) {
       // $uuid->toString();
       // $uuid->getFields()->getVersion(); 
       $uuid = Uuid::uuid4()->toString();
       $pasien = trim(mysqli_real_escape_string($conn, $_POST['pasien'])); 
       $keluhan = htmlspecialchars(trim(mysqli_real_escape_string($conn, $_POST['keluhan'])));
       $dokter = trim(mysqli_real_escape_string($conn, $_POST['dokter']));
       $diagnosa = trim(mysqli_real_escape_string($conn, $_POST['diagnosa']));
       $poli = trim(mysqli_real_escape_string($conn, $_POST['poli']));
       $tgl = trim(mysqli_real_escape_string($conn, $_POST['tgl']));

       $sql = mysqli_query($conn, "INSERT INTO tb_rekammedis (id_rm, id_pasien, keluhan, id_dokter, diagnosa, id_poli, tgl_periksa) VALUES ('$uuid', '$pasien', '$keluhan', '$dokter', '$diagnosa', '$poli', '$tgl')") or die(mysqli_error($conn));
    
       $obat = $_POST['obat'];
       foreach ($obat as $ob) {
         mysqli_query($conn, "INSERT INTO tb_rm_obat (id_rm, id_obat) VALUES('$uuid', '$ob')") or die(mysqli_error($conn));
       }
       echo "<script>alert('Data Berhasil Ditambahkan.');window.location='data.php';</script>";
    
    
    
} 

?>