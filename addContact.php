<?php
include('C:\xampp\htdocs\Contact Management System\backend\db_connection.php');
$contact_name = $_POST['contact_name'] ?? null;
$contact_number = $_POST['contact_number'] ?? null;

if ($contact_name === null || $contact_number === null) {
    echo "Name or Number Cannot be Empty";
    return;
}

if (preg_match("/[a-z]/i", $contact_number)) {
    echo "Invalid Contact Number";
    return;
}

if (strlen($contact_number) < 11) {
    echo "Invalid Contact Number";
    return;
}

$sql = "INSERT INTO contacts (contact_name, contact_number) VALUES ('$contact_name', '$contact_number')";
if ($conn->query($sql) === TRUE) {
    echo "Added Successfully";
} else {
    echo "Failed to Add";
}
$conn->close();
?>