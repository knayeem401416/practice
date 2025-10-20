<?php
session_start();
include 'db.php';

$project_title = $_POST['project_title'];
$mentor_id = $_POST['mentor_id'];
$student_id1 = $_POST['student_id1'];
$student_id2 = $_POST['student_id2'] ?: NULL;
$student_id3 = $_POST['student_id3'] ?: NULL;
$student_id4 = $_POST['student_id4'] ?: NULL;
$status = $_POST['status'];

$pdf_name = $_FILES['pdf']['name'];
$pdf_tmp_name = $_FILES['pdf']['tmp_name'];
$pdf_path = "pdf/" . $pdf_name;

if (!is_dir("pdf")) mkdir("pdf", 0777, true);
move_uploaded_file($pdf_tmp_name, $pdf_path);

// DB Connection
$conn = new mysqli("localhost:3306", "root", "", "bu_tech");
if ($conn->connect_error) {
    $_SESSION['message'] = "Database Connection Failed: " . $conn->connect_error;
    $_SESSION['msg_type'] = "error";
    header("Location: std_project_submission.php");
    exit;
}

// Required field check
if (empty($student_id1)) {
    $_SESSION['message'] = "Student 1 ID is required.";
    $_SESSION['msg_type'] = "error";
    header("Location: std_project_submission.php");
    exit;
}

// Verify IDs exist
$ids_to_check = array_filter([$mentor_id, $student_id1, $student_id2, $student_id3, $student_id4], fn($id) => !is_null($id));
$placeholders = implode(',', array_fill(0, count($ids_to_check), '?'));
$types = str_repeat('i', count($ids_to_check));

$query = "SELECT user_id FROM user WHERE user_id IN ($placeholders)";
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$ids_to_check);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != count($ids_to_check)) {
    $_SESSION['message'] = "One or more user IDs do not exist. Please check mentor/student IDs.";
    $_SESSION['msg_type'] = "error";
    header("Location: std_project_submission.php");
    exit;
}

// Insert project
$stmt = $conn->prepare("
    INSERT INTO projects 
    (project_title, mentor_id, student_id1, student_id2, student_id3, student_id4, status, pdf)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("siiiiiss", $project_title, $mentor_id, $student_id1, $student_id2, $student_id3, $student_id4, $status, $pdf_name);

if ($stmt->execute()) {
    $_SESSION['message'] = "Project registered successfully!";
    $_SESSION['msg_type'] = "success";
} else {
    $_SESSION['message'] = "Database Error: " . $stmt->error;
    $_SESSION['msg_type'] = "error";
}

$stmt->close();
$conn->close();
header("Location: data_entry.php");
exit;
?>
