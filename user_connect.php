<?php

$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$contact = $_POST['contact'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$type = $_POST['type'];
$password = $_POST['password'];

$host = "localhost:3306";
$user = "root";
$pass = "";
$db = "bu_tech";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("insert into user(f_name, l_name, contact, password, age, gender, type) values(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisiss", $f_name, $l_name, $contact, $password, $age, $gender, $type);
    $execval = $stmt->execute();
    echo $execval;
    echo "Registration successfully...";
    $stmt->close();
    $conn->close();
    header('location: data_entry.php');
    exit;
}
?>

<!-- <!DOCTYPE html>
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

</html> -->