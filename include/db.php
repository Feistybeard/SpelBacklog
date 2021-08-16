<?php
//info för att ansluta till mysql databasen
$server = "localhost";
$user = "xxxxxx";
$pass = "yyyyyy";
$dbname = "maal0053";


//anslutningen till databasen
$conn = mysqli_connect($server, $user, $pass, $dbname);

//om anslutningen inte lyckas
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
