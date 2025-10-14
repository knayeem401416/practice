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
    header('location: mentor_notice_request.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="data_entry.php" method="post">
        <button class="btn btn-primary" type="submit">
            go back
        </button>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>