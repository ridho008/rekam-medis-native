<?php 
require_once "../config/koneksi.php";
require_once "../assets/libs/vendor/autoload.php";



use Ramsey\Uuid\Uuid;

$uuid = Uuid::uuid4();

if(isset($_POST['add'])) {
	$uuid->toString();
    $uuid->getFields()->getVersion();
    $indentitas = trim(mysqli_real_escape_string($conn, $_POST['indentitas']));
    $nama = trim(mysqli_real_escape_string($conn, $_POST['nama']));
    $jk = trim(mysqli_real_escape_string($conn, $_POST['jk']));
    // $spesialis = trim(mysqli_real_escape_string($conn, $_POST['spesialis']));
    $alamat = trim(mysqli_real_escape_string($conn, $_POST['alamat']));
    $no_telp = trim(mysqli_real_escape_string($conn, $_POST['no_telp']));
    $sql_cek_indentitas = mysqli_query($conn, "SELECT * FROM tb_pasien WHERE nomor_indentitas = '$indentitas'") or die(mysqli_error($conn));
    if(mysqli_num_rows($sql_cek_indentitas) > 0) {
        echo "<script>alert('Nomor indentitas sudah diinput.');window.location='add.php';</script>";
    } else {
        mysqli_query($conn, "INSERT INTO tb_pasien (id_pasien, nomor_indentitas, nama_pasien, jenis_kelamin, alamat, no_telp) VALUES ('$uuid', '$indentitas', '$nama', '$jk', '$alamat', '$no_telp')") or die(mysqli_error($conn));
        echo "<script>alert('Data Berhasil Ditambahkan!');window.location='data.php';</script>";
    }
    
} else if(isset($_POST['edit'])) {
    $id = $_POST['id'];
	$indentitas = trim(mysqli_real_escape_string($conn, $_POST['indentitas']));
    $nama = trim(mysqli_real_escape_string($conn, $_POST['nama']));
    $jk = trim(mysqli_real_escape_string($conn, $_POST['jk']));
    // $spesialis = trim(mysqli_real_escape_string($conn, $_POST['spesialis']));
    $alamat = trim(mysqli_real_escape_string($conn, $_POST['alamat']));
    $no_telp = trim(mysqli_real_escape_string($conn, $_POST['no_telp']));
    $sql_cek_indentitas = mysqli_query($conn, "SELECT * FROM tb_pasien WHERE nomor_indentitas = '$indentitas' AND id_pasien != '$id'") or die(mysqli_error($conn));
    if(mysqli_num_rows($sql_cek_indentitas) > 0) {
        echo "<script>alert('Nomor indentitas sudah diinput.');window.location='edit.php?id=$id';</script>";
    } else {
        mysqli_query($conn, "UPDATE tb_pasien SET nomor_indentitas = '$indentitas', nama_pasien = '$nama', jenis_kelamin = '$jk', no_telp = '$no_telp' WHERE id_pasien = '$id'") or die(mysqli_error($conn));
        echo "<script>alert('Data Berhasil Ditambahkan!');window.location='data.php';</script>";
    }
} else if(isset($_POST['import'])) {
    $file = $_FILES['file']['name'];

    $ekstensi = explode(".", $file);
    $file_name = "file-".round(microtime(true)).".".end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $target_dir = "../file/";
    $target_file = $target_dir.$file_name;
    // $upload = move_uploaded_file($sumber, '/opt/lampp/htdocs/yukcoding/rumahsakit/file'.$file['name']);
    move_uploaded_file($sumber, $target_file);
    
    $obj = PHPExcel_IOFactory::load($target_file);
    $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);
    
    $sql = "INSERT INTO tb_pasien (id_pasien, nomor_indentitas, nama_pasien, jenis_kelamin, alamat, no_telp) VALUES";
    for ($i=3; $i <= count($all_data); $i++) { 
        $uuid = Uuid::uuid4()->toString();
        $no_id = $all_data[$i]['A'];
        $nama = $all_data[$i]['B'];
        $jk = $all_data[$i]['C'];
        $alamat = $all_data[$i]['D'];
        $telp = $all_data[$i]['E'];

        $sql .= "('$uuid', '$no_id', '$nama', '$jk', '$alamat', '$telp'),";
    }
    $sql = substr($sql, 0, -1);
    // echo $sql;
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    unlink($target_file);
    echo "<script>alert('Data Berhasil Ditambahkan!');window.location='data.php';</script>";
}

?>