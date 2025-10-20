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

    <section>
        <div class="row" style="margin-top: 150px; margin-bottom:80px; margin-left:50px; margin-right:50px ">
            <div class="col-lg-12" id="media_2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Notice Board Data Request Entry</h3>
                        <form class="row g-3" action="mentor_notice_review_connect.php" method="post">
                            <div class="col-md-4">
                                <label for="validationDefault06" class="form-label">Title</label>
                                <input type="text" class="form-control" id="validationDefault06" name="title" required />
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefault04" class="form-label">Priority level</label>
                                <select class="form-select" id="validationDefault04" name="priority_level" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="high">High</option>
                                    <option value="mid">Mid</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="validationDefaultUsername" class="form-label">Posted By </label>
                                <div class="input-group">
                                    <input value=<?= $id ?> type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" name="posted_by" readonly/>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="validationDefault07" class="form-label">Content</label>
                                <textarea type="text" class="form-control" id="validationDefault07" name="content" required></textarea>
                            </div>

                            <div class="col-12" style="margin-top: 30px;">
                                <button class="btn btn-primary" type="submit">
                                    Submit form
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="mentor_dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>