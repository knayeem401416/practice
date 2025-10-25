<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $type = "Student";
    $status = "Pending";

    // Handle profile picture upload
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["profile_pic"]["name"]);
    $targetFilePath = $targetDir . time() . "_" . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array(strtolower($fileType), $allowedTypes)) {
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFilePath)) {
            // Insert data into user table
            $sql = "INSERT INTO student_registration (f_name, l_name, contact, password, dob, age, gender, type, profile_pic, status)
                    VALUES ('$f_name', '$l_name', '$contact', '$password', '$dob', '$age', '$gender', '$type', '$targetFilePath', '$status')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: signup.php?success=1");
                exit();
            } else {
                header("Location: signup.php?error=1");
                exit();
            }
        } else {
            header("Location: signup.php?error=1");
            exit();
        }
    } else {
        header("Location: signup.php?error=1");
        exit();
    }
}
?>
