<?php
class connectToDB {

private $conn;

public function __construct()
{
  $config = include 'konek.php';
  $this->conn = new mysqli( $config['db']['server'], $config['db']['user'], $config['db']['pass'], $config['db']['dbname']);
}

function __destruct()
{
  $this->conn->close();
}

public function addSekolah($nama, $latitude, $longitude, $details){
    $statement = $this->conn->prepare("Insert INTO sekolah(nama, latitude, longitude, details) VALUES(?, ?, ?, ?)");

$statement->bind_param('ssss', $nama, $latitude, $longitude, $details);

$statement->execute();

$statement->close();
}

public function addKabupaten($kode, $nama, $geolocation, $luas){
  $statement = $this->conn->prepare("Insert INTO kabupaten(kode, nama, geolocation, luas) VALUES(?, ?, ?, ?)");

$statement->bind_param('ssss', $kode, $nama, $geolocation, $luas);

$statement->execute();

$statement->close();
}

public function getSekolahList()
{
    $query = "select * from sekolah";
    $data = mysqli_query($this->conn, $query);
    while ($row = mysqli_fetch_array($data)){
        $hasil[] = $row;
    }
    return $hasil;
}

public function getKabupatenList(){
  $query_mysql = mysqli_query($this->conn, "SELECT * FROM kabupaten");
  while ($row = mysqli_fetch_array($query_mysql)){
    $hasil[] = $row;
  }
  return $hasil;
}

/*public function getAreasList(){
  $query_mysql = mysqli_query($this->conn, "SELECT * FROM areas");
  while ($row = mysqli_fetch_array($query_mysql)){
    $hasil[] = $row;
  }
  return $hasil;
}
*/

}
?>

