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
                        <a href="mentor_dashboardpage.php" class="nav__link">Dashboard</a>
                    </li>

                    <li class="nav__item">
                        <a href="reviewpage.php" class="nav__link">Review Project</a>
                    </li>
                    <li class="nav__item">
                        <a href="mentor_notice_request.php" class="nav__link">Notice Request</a>
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

    <!-- <img src="bulogo.png" alt="" id="img-logo"> -->

    <!--==================== PENDING LIST ====================-->
    <h1 class="h11">Project Proposal Pending</h1>
    <table class="table table table-striped table-hover table-bordered">

        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Project ID</th>
                <th>Project Title</th>
                <th>Mentor ID</th>
                <th>1st Student ID</th>
                <th>2nd Student ID</th>
                <th>PDF</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        include 'db.php';

        $sql = "SELECT project_id, project_title, mentor_id, student_id1, student_id2, status, pdf FROM projects where status = 'Pending' and mentor_id = $id ORDER BY project_id ASC";
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

                if ($status == 'Reviewed' || $status == 'Rechecked') {
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
                        <td><?= !empty($student_id2) ? $student_id2 : 'N/A' ?></td>
                        <td><a href="pdf/<?= $pdf ?>" download><?= $pdf ?></a></td>
                        <td><?= $status ?></td>
                        <td>
                            <form action="reviewpage.php" method="post">
                                <input type="hidden" name="project_id" value="<?= $project_id ?>">
                                <?php if ($status != 'Reviewed') : ?>
                                    <button type="submit" name="action" value="review" class="btn btn-success">Review</button>
                                <?php endif; ?>
                                <?php if ($status != 'Rechecked') : ?>
                                    <!-- <button type="submit" name="action" value="recheck" class="btn btn-danger">Recheck</button> -->
                                    <button type="button" name="action" value="recheck" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#recheckModal" data-project-id="<?= $project_id ?>">Recheck</button>
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

        if ($action == "review") {
            $sql = "UPDATE projects SET status='Reviewed' WHERE project_id='$project_id'";
        } elseif ($action == "recheck") {
            $comment = mysqli_real_escape_string($conn, $_POST['comment']);
            $sql = "UPDATE projects SET status='Rechecked', comment='$comment' WHERE project_id='$project_id'";
        }

        if (mysqli_query($conn, $sql)) {
            // ✅ Auto refresh after successful update
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        } else {
            echo "<div class='alert alert-danger text-center mt-3'>❌ Database Error: " . mysqli_error($conn) . "</div>";
        }
    }
    ?>


    <!--==================== REVIEWED LIST ====================-->
    <h1 class="h12">Reviewed List</h1>

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

        $sql = "SELECT project_id, project_title, mentor_id, student_id1, student_id2, status, pdf FROM  projects where status = 'Reviewed' and mentor_id = $id ORDER BY project_id ASC";
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
                        <td><?= !empty($student_id2) ? $student_id2 : 'N/A' ?></td>
                        <td><a href="pdf/<?= $pdf ?>" download><?= $pdf ?></a></td>
                        <td><?= $status ?></td>
                    </tr>
                </tbody>
        <?php
            }
        }
        ?>
    </table>


    <!--==================== RECHECKED LIST ====================-->
    <h1 class="h12">Rechecked List</h1>

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
                <th scope="col">Comment</th>
            </tr>
        </thead>

        <?php
        include 'db.php';

        $sql = "SELECT project_id, project_title, mentor_id, student_id1, student_id2, status, pdf, comment FROM  projects where status = 'Rechecked'  and mentor_id = $id   ORDER BY project_id ASC";
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
                $comment = $info['comment'];
            ?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $project_id ?></td>
                        <td><?= $project_title ?></td>
                        <td><?= $mentor_id ?></td>
                        <td><?= $student_id1 ?></td>
                        <td><?= !empty($student_id2) ? $student_id2 : 'N/A' ?></td>
                        <td><a href="pdf/<?= $pdf ?>" download><?= $pdf ?></a></td>
                        <td><?= $status ?></td>
                        <td><?= $comment ?></td>
                    </tr>
                </tbody>
        <?php
            }
        }
        ?>
    </table>

    <!--==================== APPROVED LIST ====================-->
    <h1 class="h12">Approved List</h1>

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

        $sql = "SELECT project_id, project_title, mentor_id, student_id1, student_id2, status, pdf FROM  projects where status = 'Approved' and mentor_id = $id ORDER BY project_id ASC";
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
                        <td><?= !empty($student_id2) ? $student_id2 : 'N/A' ?></td>
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
    <h1 class="h12">Rejected List</h1>

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
                <th scope="col">Comment</th>
            </tr>
        </thead>

        <?php
        include 'db.php';

        $sql = "SELECT project_id, project_title, mentor_id, student_id1, student_id2, status, pdf, comment FROM  projects where status = 'Rejected'  and mentor_id = $id   ORDER BY project_id ASC";
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
                $comment = $info['comment'];
            ?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $project_id ?></td>
                        <td><?= $project_title ?></td>
                        <td><?= $mentor_id ?></td>
                        <td><?= $student_id1 ?></td>
                        <td><?= !empty($student_id2) ? $student_id2 : 'N/A' ?></td>
                        <td><a href="pdf/<?= $pdf ?>" download><?= $pdf ?></a></td>
                        <td><?= $status ?></td>
                        <td><?= $comment ?></td>
                    </tr>
                </tbody>
        <?php
            }
        }
        ?>
    </table>

    <!-- Recheck Comment Modal -->
    <div class="modal fade" id="recheckModal" tabindex="-1" aria-labelledby="recheckModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="">
            <div class="modal-body">
            <input type="hidden" name="project_id" id="modal_project_id">
            <input type="hidden" name="action" value="recheck">
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Enter your feedback..." required></textarea>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Submit</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <script>
    // Pass project_id to modal when Recheck button is clicked
    const recheckModal = document.getElementById('recheckModal');
    recheckModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const projectId = button.getAttribute('data-project-id');
        document.getElementById('modal_project_id').value = projectId;
    });
    </script>


    <script src="homepage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>