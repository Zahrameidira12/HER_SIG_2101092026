<?php

require_once("db.php");

$nama = strip_tags($_POST['nama']);
$latitude = strip_tags($_POST['latitude']);
$longitude = strip_tags($_POST['longitude']);
$details = strip_tags($_POST['details']);
$conn = new connectToDB();
$conn->addSekolah($nama, $latitude, $longitude, $details);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Tambah data Sekolah</title>
 </head>
 <body>
  <h1>Data sudah ditambahkan</h1>
 </body>
</html>

