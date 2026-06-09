<?php
include('C:\xampp\htdocs\Contact Management System\backend\db_connection.php');
$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);
$response = "";

if (mysqli_num_rows($result) > 0) {
    while ($rows = $result->fetch_assoc()) {
        $response .= $rows['contact_id'] . " " . $rows['contact_name'] . " " . $rows['contact_number'] . "<br>";
    }
}

echo $response;
?>