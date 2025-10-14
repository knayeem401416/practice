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
        color: rgba(10, 135, 129, 1);
        font-weight: bold;
    }

    tr {
        text-align: center;
    }

    .h12 {
        margin-top: 50px;
        margin-bottom: 50px;
        text-align: center;
        color: rgba(10, 135, 129, 1);
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
        <nav class="navbar_custom nav-container">
            <img src="bulogo.png" alt="" class="nav__logo">

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="director_dashboardpage.php" class="nav__link">Dashboard</a>
                    </li>

                    <li class="nav__item">
                        <a href="approvepage.php" class="nav__link">Approve Project</a>
                    </li>
                    <li class="nav__item">
                        <a href="director_notice_request.php" class="nav__link">Notice Request</a>
                    </li>
                </ul>
            </div>

            <div class="nav__actions">
                <!-- Logout button -->
                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-menu-line"></i>
                </div>
                <!-- Logout button -->
                <a href="homepage.php">
                    <i class="ri-logout-box-r-line" id="login-btn"></i>
                </a>
            </div>
        </nav>
    </header>



    <!--==================== REVIEWED LIST ====================-->
    <h1 class="h11">Project Proposal Reviewed</h1>
    <table class="table table table-striped table-hover table-bordered">

        <thead>
            <tr>
                <th scope="col">Serial Number</th>
                <th scope="col">Project ID</th>
                <th scope="col">Project Title</th>
                <th scope="col">Mentor ID</th>
                <th scope="col">1st Student ID</th>
                <th scope="col">2nd Student ID</th>
                <th scope="col">PDF</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <?php
        include 'db.php';

        $sql = "SELECT project_id, project_title, mentor_id, student_id1, student_id2, status, pdf FROM  projects WHERE status = 'Reviewed' ORDER BY project_id ASC";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
        ?>

            <?php
            $i = 1;
            while ($info = mysqli_fetch_array($query)) {
                $project_id = $info['project_id'];
                $project_title = $info['project_title'];
                $mentor_id = $info['mentor_id'];
                $student_id1 = $info['student_id1'];
                $student_id2 = $info['student_id2'];
                $pdf = $info['pdf'];
                $status = $info['status'];
                $hide = "";

                if ($status == 'Approved' || $status == 'Rejected') {
                    $hide = "style='display: none;'";
                }

            ?>
                <tbody <?php echo $hide; ?>>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $project_id ?></td>
                        <td><?= $project_title ?></td>
                        <td><?= $mentor_id ?></td>
                        <td><?= $student_id1 ?></td>
                        <td><?= $student_id2 ?></td>
                        <td><a href="pdf/<?= $pdf ?>" download><?= $pdf ?></a></td>
                        <td><?= $status ?></td>
                        <td>
                            <form action="approvepage.php" method="post">
                                <input type="hidden" name="project_id" value="<?= $project_id ?>">
                                <?php if ($status != 'Approved') : ?>
                                    <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                                <?php endif; ?>
                                <?php if ($status != 'Rejected') : ?>
                                    <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                </tbody>
        <?php
            }
        }
        ?>
    </table>

    <?php
    if (isset($_POST['project_id'], $_POST['action'])) {

        $project_id = $_POST['project_id'];
        $action = $_POST['action'];

        if ($action == "approve") {
            $sql = "UPDATE projects SET status='Approved' WHERE project_id='$project_id'";
        } else if ($action == "reject") {
            $sql = "UPDATE projects SET status='Rejected' WHERE project_id='$project_id'";
        }

        $resut = mysqli_query($conn, $sql);
    }
    ?>

    <!--==================== APPROVED LIST ====================-->
    <h1 class="h12">Approved List </h1>

    <table class="table table table-striped table-hover table-bordered">

        <thead>
            <tr>
                <th scope="col">Serial Number</th>
                <th scope="col">Project ID</th>
                <th scope="col">Project Title</th>
                <th scope="col">Mentor ID</th>
                <th scope="col">1st Student ID</th>
                <th scope="col">2nd Student ID</th>
                <th scope="col">PDF</th>
                <th scope="col">Status</th>
            </tr>
        </thead>

        <?php
        include 'db.php';

        $sql = "SELECT project_id, project_title, mentor_id, student_id1, student_id2, status, pdf FROM  projects WHERE status = 'Approved' ORDER BY project_id ASC";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
        ?>

            <?php
            $i = 1;
            while ($info = mysqli_fetch_array($query)) {
                $project_id = $info['project_id'];
                $project_title = $info['project_title'];
                $mentor_id = $info['mentor_id'];
                $student_id1 = $info['student_id1'];
                $student_id2 = $info['student_id2'];
                $pdf = $info['pdf'];
                $status = $info['status'];
            ?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $project_id ?></td>
                        <td><?= $project_title ?></td>
                        <td><?= $mentor_id ?></td>
                        <td><?= $student_id1 ?></td>
                        <td><?= $student_id2 ?></td>
                        <td><a href="pdf/<?= $pdf ?>" download><?= $pdf ?></a></td>
                        <td><?= $status ?></td>
                    </tr>
                </tbody>
        <?php
            }
        }
        ?>
    </table>

    <!--==================== REJECTED LIST ====================-->
    <h1 class="h12">Rejected List </h1>

    <table class="table table table-striped table-hover table-bordered">

        <thead>
            <tr>
                <th scope="col">Serial Number</th>
                <th scope="col">Project ID</th>
                <th scope="col">Project Title</th>
                <th scope="col">Mentor ID</th>
                <th scope="col">1st Student ID</th>
                <th scope="col">2nd Student ID</th>
                <th scope="col">PDF</th>
                <th scope="col">Status</th>
            </tr>
        </thead>

        <?php
        include 'db.php';

        $sql = "SELECT project_id, project_title, mentor_id, student_id1, student_id2, status, pdf FROM  projects WHERE status = 'Rejected' ORDER BY project_id ASC";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
        ?>

            <?php
            $i = 1;
            while ($info = mysqli_fetch_array($query)) {
                $project_id = $info['project_id'];
                $project_title = $info['project_title'];
                $mentor_id = $info['mentor_id'];
                $student_id1 = $info['student_id1'];
                $student_id2 = $info['student_id2'];
                $pdf = $info['pdf'];
                $status = $info['status'];
            ?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $project_id ?></td>
                        <td><?= $project_title ?></td>
                        <td><?= $mentor_id ?></td>
                        <td><?= $student_id1 ?></td>
                        <td><?= $student_id2 ?></td>
                        <td><a href="pdf/<?= $pdf ?>" download><?= $pdf ?></a></td>
                        <td><?= $status ?></td>
                    </tr>
                </tbody>
        <?php
            }
        }
        ?>
    </table>



    <script src="homepage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>