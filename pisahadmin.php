<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['username'])) {
    header ('location: loginadmin.php');
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "steam_replica";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
  die("tidak bisa terkoneksi ke database");
}

$username = mysqli_real_escape_string($koneksi, $_SESSION['username']);
$mysql_adm = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");
$data_adm = mysqli_fetch_array($mysql_adm);

$game_name = "";
$date_released = "";
$developer= "";
$publisher = "";
$price = "";
$foto = "";
$error = "";
$sukses = "";

if (isset($_GET['op'])) {
  $op = $_GET['op'];
} else {
  $op = "";
}

if ($op == 'delete') {
  $id = $_GET['id'];
  $sql1 = "delete from item_data where gameid = '$id'";
  $q1 = mysqli_query($koneksi, $sql1);
  if ($q1) {
    $sukses = "Berhasil hapus data";
  } else {
    $error = "Gagal melakukan delete data";
  }
}

if ($op == 'edit') {
  $id = $_GET['id'];
  $sql1 = "select * from item_data where gameid = '$id'";
  $q1 = mysqli_query($koneksi, $sql1);
  $r1 = mysqli_fetch_array($q1);
  $game_name = $r1['game_name'];
  $date_released = $r1['date_released'];
  $developer = $r1['developer'];
  $publisher = $r1['publisher'];
  $price = $r1['price'];

  if ($game_name == '') {
    $error = "Data tidak ditemukan";
  }
}
if (isset($_POST['simpan'])) { //untuk create
  
  $game_name = $_POST['game_name'];
  $date_released = $_POST['date_released'];
  $developer = $_POST['developer'];
  $publisher = $_POST['publisher'];
  $price = $_POST['price'];
   $foto = $_FILES['foto']['name'];
   $ekstensi1=array('png','jpg','jpeg');
   $x=explode('.',$foto);
   $ekstensi=strtolower(end($x));
   $file_tmp=$_FILES['foto']['tmp_name'];
   if(in_array($ekstensi, $ekstensi1)===true){
    move_uploaded_file($file_tmp, 'img/'.$foto);
   }
   else{
    echo "<script>alert ('Eksentasi tidak diperbolehkan')</script>";
   }
   $game_name =$_POST['game_name'];

  if ($game_name && $date_released && $developer && $publisher && $price && $foto) {
    if ($op == 'edit') { //untuk update
      $sql1 = "update item_data set game_name = '$game_name', date_released = '$date_released', developer = '$developer', publisher = '$publisher', price='$price', foto='$foto' where gameid='$_GET[id]'";
      $q1 = mysqli_query($koneksi, $sql1);
      if ($q1) {
        $sukses = "Data berhasil diupdate";
      } else {
        $error = "Data gagal diupdate";
      }
    } else { //untuk insert
      $sql1 = "insert into item_data(game_name,date_released,developer,publisher,price,foto) values ('$game_name','$date_released','$developer','publisher','$price','$foto')";
      $q1 = mysqli_query($koneksi, $sql1);
      if ($q1) {
        $sukses = "Berhasil memasukkan data baru";
      } else {
        $error = "Gagal memasukkan data";
      }
    }
  } else {
    $error = "Silahkan masukkan semua data";
  }
}
?>