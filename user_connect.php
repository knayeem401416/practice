<?php
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$contact = $_POST['contact'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$type = $_POST['type'];
$password = $_POST['password'];
$dob = $_POST['dob'];

// Handle profile picture
$profile_pic = null;
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = uniqid() . "_" . basename($_FILES['profile_pic']['name']);
    $target_path = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_path)) {
        $profile_pic = $target_path;
    }
}

$host = "localhost:3306";
$user = "root";
$pass = "";
$db = "bu_tech";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO user (f_name, l_name, contact, password, dob, age, gender, type, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssississs", $f_name, $l_name, $contact, $password, $dob, $age, $gender, $type, $profile_pic);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['message'] = "User registered successfully!";
        header("Location: data_entry.php");
        exit;
    } else {
        echo "❌ Database Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
