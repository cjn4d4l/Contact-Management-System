<?php
include('C:\xampp\htdocs\Contact Management System\backend\db_connection.php');
$contact_id = $_POST['contact_id'];
$sql = "DELETE FROM contacts WHERE contact_id=$contact_id";
if ($conn->query($sql) === TRUE) {
    echo "Successfully Deleted";
} else {
    echo "Failed to Delete";
}
?>
