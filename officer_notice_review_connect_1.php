<?php

$title = $_POST['title'];
$priority_level = $_POST['priority_level'];
$posted_by = $_POST['posted_by'];
$content = $_POST['content'];

$host = "localhost:3306";
$user = "root";
$pass = "";
$db = "bu_tech";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("insert into notice_review(title, content, posted_by, priority_level) values(?, ?, ?, ?)");
    $stmt->bind_param("ssis", $title, $content, $posted_by, $priority_level);
    $execval = $stmt->execute();
    echo $execval;
    echo "Data sent sucessfully";
    $stmt->close();
    $conn->close();
    header('location: data_entry.php');
    exit;
}
