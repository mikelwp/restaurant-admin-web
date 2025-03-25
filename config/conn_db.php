<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "20232_wp2_412022019";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>