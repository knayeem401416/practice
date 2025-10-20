<?php
include 'db.php'; // Your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $priority_level = $_POST['priority_level'];
    $posted_by = $_POST['posted_by'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO notice_board (title, content, posted_by, priority_level) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $posted_by, $priority_level);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header('Location: notice_review_and_post.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

