<?php

$project_title = $_POST['project_title'];
$mentor_id = $_POST['mentor_id'];
$student_id1 = $_POST['student_id1'];
$student_id2 = $_POST['student_id2'];
$student_id3 = $_POST['student_id3'];
$student_id4 = $_POST['student_id4'];
$status = $_POST['status'];

$pdf_name = $_FILES['pdf']['name'];
$pdf_tmp_name = $_FILES['pdf']['tmp_name'];
move_uploaded_file($pdf_tmp_name, "pdf/" . $pdf_name);












$host = "localhost:3306";
$user = "root";
$pass = "";
$db = "bu_tech";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("insert into projects(project_title, mentor_id, student_id1, student_id2, status, pdf) values(?, ?, ?, ?, ?,?)");
    $stmt->bind_param("siiiss", $project_title, $mentor_id, $student_id1, $student_id2, $status, $pdf_name);
    $execval = $stmt->execute();
    echo $execval;
    echo "Registration successfully...";
    $stmt->close();
    $conn->close();
    header('location: data_entry.php');
    exit;
}
