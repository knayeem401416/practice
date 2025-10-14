<?php
include 'db.php'; // connection to database

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// collect form data safely
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// prepare SQL query
$sql = "INSERT INTO contact (name, num, subject, message) VALUES ('$name', '$mobile', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    // redirect back to contact_page.php with success message
    header("Location: contact_page.php?success=1");
    exit();
} else {
    // redirect back with an error message
    header("Location: contact_page.php?error=1");
    exit();
}

$conn->close();
?>
