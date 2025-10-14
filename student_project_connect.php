<?php
$project_title = $_POST['project_title'];
$mentor_id = $_POST['mentor_id'];
$student_id1 = $_POST['student_id1'];
$student_id2 = $_POST['student_id2'];
$student_id3 = $_POST['student_id3'];
$student_id4 = $_POST['student_id4'];
$status = 'pending';

$pdf_name = $_FILES['pdf']['name'];
$pdf_tmp_name = $_FILES['pdf']['tmp_name'];
$pdf_path = "pdf/" . $pdf_name;

// Create PDF folder if it doesn't exist
if (!is_dir("pdf")) {
    mkdir("pdf", 0777, true);
}

move_uploaded_file($pdf_tmp_name, $pdf_path);

$host = "localhost:3306";
$user = "root";
$pass = "";
$db = "bu_tech";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Check that required fields are provided
if (empty($student_id1)) {
    echo "<h3 style='color:red;'>❌ Student 1 ID is required.</h3>";
    exit;
}

// Convert optional student IDs to NULL
$student_id2 = !empty($student_id2) ? $student_id2 : NULL;
$student_id3 = !empty($student_id3) ? $student_id3 : NULL;
$student_id4 = !empty($student_id4) ? $student_id4 : NULL;

// ✅ Verify that all provided IDs exist in `user`
$ids_to_check = array_filter([$mentor_id, $student_id1, $student_id2, $student_id3, $student_id4], fn($id) => !is_null($id));
$placeholders = implode(',', array_fill(0, count($ids_to_check), '?'));
$types = str_repeat('i', count($ids_to_check));

$query = "SELECT user_id FROM user WHERE user_id IN ($placeholders)";
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$ids_to_check);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != count($ids_to_check)) {
    echo "<h3 style='color:red;'>❌ One or more user IDs do not exist in the user table. Please check mentor/student IDs.</h3>";
    exit;
}

// ✅ Insert project data
$stmt = $conn->prepare("
    INSERT INTO projects 
    (project_title, mentor_id, student_id1, student_id2, student_id3, student_id4, status, pdf)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

// Bind parameters using NULL for optional student IDs
$stmt->bind_param(
    "siiiiiss",
    $project_title,
    $mentor_id,
    $student_id1,
    $student_id2,
    $student_id3,
    $student_id4,
    $status,
    $pdf_name
);

if ($stmt->execute()) {
    echo "<h3 style='color:green;'>✅ Project registered successfully!</h3>";
    header('Location: std_project_submission.php');
    exit;
} else {
    echo "<h3 style='color:red;'>❌ Database Error: " . $stmt->error . "</h3>";
}

$stmt->close();
$conn->close();
?>
