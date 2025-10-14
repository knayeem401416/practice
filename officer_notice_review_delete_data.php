<?php

$id = $_POST['ID'];
$host = "localhost:3306";
$user = "root";
$pass = "";
$db = "bu_tech";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $sql = "DELETE FROM notice_review WHERE notice_review_id = $id";
    mysqli_query($conn, $sql);
    echo "Data deleted successfully!";
    header('location: notice_review_and_post.php');
    exit;
}
