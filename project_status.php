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
    .h11 {
        margin-top: 150px;
        margin-bottom: 50px;
        text-align: center;
        color: black;
        font-weight: bold;
    }

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
        <nav class="nav container">
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
                        <a href="project_status.php" class="nav__link">Project Status</a>
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
    <h1 class="h11">Project Status </h1>

    <table class="table table table-striped table-hover table-bordered">

        <?php
        include 'db.php';

        $sql = "SELECT project_id, project_title, status FROM  projects";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
        ?>
            <thead>
                <tr>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Project ID</th>
                    <th scope="col">Project Title</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <?php
            $i = 1;
            while ($info = mysqli_fetch_array($query)) {
                $project_id = $info['project_id'];
                $project_title = $info['project_title'];
                $status = $info['status'];
            ?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $project_id ?></td>
                        <td><?= $project_title ?></td>
                        <td><?= $status ?></td>
                    </tr>
                </tbody>
        <?php
            }
        }
        ?>
    </table>


    <script src="homepage.js"></script>
</body>

</html>