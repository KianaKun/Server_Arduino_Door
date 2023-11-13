// File untuk koneksi ke database mysql
<?php
$dbhost = "192.168.1.2";
$dbuser = "Kianaa";
$password = "";
$dbname= "server_arduino";

$dbconnect = new mysqli($dbhost,$dbuser,$password,$dbname);

if($dbconnect->connect_error){
    die("Error Connecting Database");
}

?>
