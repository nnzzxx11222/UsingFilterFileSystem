<?php
// setting of datapase

$hostname = "localhost";
$username = "root";
$password = "";
$database = "e_commercer_updata";
$port = 3306;

// $conn = new mysqli($hostname,$username,$password,$database,$port);
$conn = mysqli_connect($hostname, $username, $password, $database, $port);

// make sure of connecting with the database
if ($conn->connect_error) {
    echo 'Connection Faild: ' . $con->connect_error;
}
