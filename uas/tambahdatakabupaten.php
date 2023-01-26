<?php

require_once("db.php");

$kode = strip_tags($_POST['kode']);
$nama = strip_tags($_POST['nama']);
$geolocation = strip_tags($_POST['geolocation']);
$luas = strip_tags($_POST['luas']);
$conn = new connectToDB();
$conn->addKabupaten($kode, $nama, $geolocation, $luas);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Tambah data Kabupaten</title>
 </head>
 <body>
  <h1>Data sudah ditambahkan</h1>
 </body>
</html>

<?php //100.41700384946552, -0.9471276547383438, 100.3538801157608, -0.9726773582620972, 100.42225766943187, -0.9986903326192149,  100.4469402985619,-0.9583367863157499