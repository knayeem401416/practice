<?php
include 'db.php';

session_start();
$id = $_SESSION['ID'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>BU Tech 360</title>
</head>

<style>
    #img-logo {
        position: fixed;
        top: 150px;
        left: 0;
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        opacity: .8;
    }
</style>

<body>
    <header class="header" id="header">
        <nav class="navbar_custom nav-container">
            <img src="bulogo.png" alt="" class="nav__logo">

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="std_dashboard.php" class="nav__link">Dashboard</a>
                    </li>

                    <li class="nav__item">
                        <a href="std_project_submission.php" class="nav__link">Project Submission</a>
                    </li>

                    <li class="nav__item">
                        <a href="std_status.php" class="nav__link">Project Status</a>
                    </li>
                </ul>
            </div>

            <div class="nav__actions">
                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-menu-line"></i>
                </div>
                <!-- Logout button -->
                <a href="homepage.php"><i class="ri-logout-box-r-line" id="login-btn"></i></a>

                <!-- Toggle button -->

            </div>
        </nav>
    </header>

    <!-- <img src="bulogo.png" alt="" id="img-logo"> -->

    <!--==================== PROJECT STATUS ====================-->
    <div class="card" style="margin: 150px auto 0px auto; width: 1000px; display:flex; justify-content:center; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); ">
        <div class="card-header">
            <h5 class="card-title" style="text-align: center; font-weight:bold; font-size:30px;">Project Status</h5>
        </div>
        <div class="card-body">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Project ID</th>
                        <th>Project Title</th>
                        <th>Status</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';

                    $sql = "SELECT project_id, project_title, status, comment FROM  projects where student_id1 = $id";
                    $query = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($query) > 0) {
                    ?>

                        <?php
                        $i = 1;
                        while ($info = mysqli_fetch_array($query)) {
                            $project_id = $info['project_id'];
                            $project_title = $info['project_title'];
                            $status = $info['status'];
                            $comment = $info['comment'];
                        ?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $project_id ?></td>
                        <td><?= $project_title ?></td>
                        <td><?= $status ?></td>
                        <td><?= !empty($comment) ? $comment : 'N/A' ?></td>
                    </tr>
                </tbody>
        <?php
                        }
                    }
        ?>
        </tbody>
            </table>
        </div>
    </div>

    <script src="homepage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>