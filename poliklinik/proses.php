<?php 
require_once "../config/koneksi.php";
require_once "../assets/libs/vendor/autoload.php";



use Ramsey\Uuid\Uuid;

// $uuid = Uuid::uuid4();

if(isset($_POST['add'])) {
    $total = $_POST['total'];
    for($i = 1; $i <= $total; $i++) {
       // $uuid->toString();
       // $uuid->getFields()->getVersion(); 
       $uuid = Uuid::uuid4()->toString();
       $nama = trim(mysqli_real_escape_string($conn, $_POST['nama-'.$i])); 
       $gedung = trim(mysqli_real_escape_string($conn, $_POST['gedung-'.$i]));
       $sql = mysqli_query($conn, "INSERT INTO tb_poliklinik (id_poli, nama_poli, gedung) VALUES ('$uuid', '$nama', '$gedung')") or die(mysqli_error($conn));
    }
    
    if($sql) {
        echo "<script>alert('". $total ." data berhasil ditambahkan.');window.location='data.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data.');window.location='generate.php';</script>";
    }
    
    
    
} else if(isset($_POST['edit'])) {
  for($i = 0; $i <= count($_POST['id']); $i++) {
       $id = $_POST['id'][$i];
       $nama = $_POST['nama'][$i];
       $gedung = $_POST['gedung'][$i];
       $sql = mysqli_query($conn, "UPDATE tb_poliklinik SET nama_poli = '$nama', gedung = '$gedung' WHERE id_poli = '$id'") or die(mysqli_error($conn));
       if($sql) {
      echo "<script>alert('data berhasil diubah.');window.location='data.php';</script>";
    } else {
      echo "<script>alert('data gagal diubah.');window.location='data.php';</script>";
    }
    }


} 

?>