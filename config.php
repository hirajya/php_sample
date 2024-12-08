<?php
$host = 'localhost';
$user = 'root';       // Your database username
$pass = '';           // Your database password
$dbname = 'crud_db';  // Database name

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
