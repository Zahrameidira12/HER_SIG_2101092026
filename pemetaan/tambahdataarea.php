<?php

require_once("db.php");

$name = strip_tags($_POST['name']);
$geolocations = strip_tags($_POST['geolocations']);
$conn = new connectToDB();
$conn->addAreas($name, $geolocations);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Tambah data</title>
 </head>
 <body>
  <h1>Data sudah ditambahkan</h1>
 </body>
</html>

<?php //100.41700384946552, -0.9471276547383438, 100.3538801157608, -0.9726773582620972, 100.42225766943187, -0.9986903326192149,  100.4469402985619,-0.9583367863157499