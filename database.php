
<?php

$host="localhost";
$user="root";
$password="";
$database="nieruchomosci";


$connection = mysqli_connect($host, $user, $password, $database);

if(!$connection) {
  echo "ERROR MySQL: Connect to Server\n";
  exit();
}
else {
}
 ?>
