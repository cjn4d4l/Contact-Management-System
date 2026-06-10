<?php
header('Content-Type: application/json');
$conn = new mysqli("127.0.0.1:3307", "root", "thisisnewpassword", "conms");
$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);
$contacts = [];

if ($result->num_rows > 0) {
    while ($rows = $result->fetch_assoc()) {
        $contacts[] = $rows;
    }
}

echo json_encode($contacts);
?>