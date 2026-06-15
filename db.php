<?php
$host = "localhost";
$user = "root";
$pass = ""; // Enter your local database password here
$db   = "mapproject"; 
$port = 8889; // MAMP MySQL port

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
