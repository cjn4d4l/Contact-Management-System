<?php
$db_server = "127.0.0.1:3307";
$db_username = "root";
$db_password = "thisisnewpassword";
$db_name = "conms";

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

echo "<script>console.log('Database Successfully Connected')</script>";
?>