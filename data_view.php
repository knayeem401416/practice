<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" />

    <link rel="stylesheet" href="style.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <title>BU Tech 360</title>
</head>
<style>
    .table_to_edit {
        margin-top: 100px;
        margin-bottom: 100px;
    }

    h3 {
        text-align: center;
    }

    a {
        text-decoration: none;
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

    tr {
        text-align: center;
    }

    .textbold{
        font-weight: bold;
        color: rgba(10, 135, 129, 1);
    }
</style>

<body>
    <header class="header" id="header">
        <nav class="navbar_custom nav-container">
            <img src="bulogo.png" alt="" class="nav__logo" />

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="officer_dashboard.php" class="nav__link">Dashboard</a>
                    </li>

                    <li class="nav__item">
                        <a href="data_entry.php" class="nav__link">Data Entry</a>
                    </li>

                    <li class="nav__item">
                        <a href="data_view.php" class="nav__link">Data View</a>
                    </li>

                    <li class="nav__item">
                        <a href="notice_review_and_post.php" class="nav__link">Notice Review and Post</a>
                    </li>

                    <!-- <li class="nav__item">
                        <a href="notice_review_and_post.php" class="nav__link">Services</a>
                    </li> -->

                    <!-- <li class="nav__item">
                        <a href="#" class="nav__link">Featured</a>
                    </li>

                    <li class="nav__item">
                        <a href="#" class="nav__link">Contact Me</a>
                    </li> -->
                </ul>

                <!-- Close button
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div> -->
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



    <section style="margin-top: 150px;">
        <div class="table_to_edit">
            <table class="table table table-striped table-hover">
                <h3 class="textbold"> Notice Review Request</h3>
                <?php
                include 'db.php';

                $sql = "SELECT notice_review_id, title, content, posted_by, priority_level FROM  notice_review";
                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) > 0) {
                ?>

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Posted By</th>
                            <th scope="col">Pririty</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    while ($info = mysqli_fetch_array($query)) {
                        $notice_review_id = $info['notice_review_id'];
                        $title = $info['title'];
                        $content = $info['content'];
                        $posted_by = $info['posted_by'];
                        $pririty_level = $info['priority_level'];

                    ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $notice_review_id ?></td>
                                <td><?= $title ?></td>
                                <td><?= $content ?></td>
                                <td><?= $posted_by ?></td>
                                <td><?= $pririty_level ?></td>

                            </tr>
                        <?php
                    }
                } else {
                        ?>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Posted By</th>
                                <th scope="col">Pririty</th>
                            </tr>
                        </thead>
                    <?php
                }
                    ?>

                        </tbody>
            </table>
        </div>



        <div class="table_to_edit">
            <table class="table table table-striped table-hover">
                <h3 class="textbold"> Notice Board</h3>

                <?php
                include 'db.php';

                $sql = "SELECT notice_id, title, content, posted_by, priority_level FROM  notice_board";
                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) > 0) {
                ?>

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Posted By</th>
                            <th scope="col">Pririty</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    while ($info = mysqli_fetch_array($query)) {
                        $notice_id = $info['notice_id'];
                        $title = $info['title'];
                        $content = $info['content'];
                        $posted_by = $info['posted_by'];
                        $pririty_level = $info['priority_level'];

                    ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $notice_id ?></td>
                                <td><?= $title ?></td>
                                <td><?= $content ?></td>
                                <td><?= $posted_by ?></td>
                                <td><?= $pririty_level ?></td>

                            </tr>
                        <?php
                    }
                } else {
                        ?>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Posted By</th>
                                <th scope="col">Pririty</th>
                            </tr>
                        </thead>
                    <?php
                }
                    ?>

                        </tbody>
            </table>
        </div>


        <div class="table_to_edit">
            <table class="table table table-striped table-hover">
                <h3 class="textbold"> Projects Submitted</h3>

                <?php
                include 'db.php';

                $sql = "SELECT project_id, project_title, mentor_id, student_id1,student_id2, status, pdf FROM  projects";
                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) > 0) {
                ?>

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Mentor ID</th>
                            <th scope="col">Student ID 1</th>
                            <th scope="col">Student ID 2</th>
                            <th scope="col">Status</th>
                            <th scope="col">PDF name</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    while ($info = mysqli_fetch_array($query)) {
                        $notice_id = $info['project_id'];
                        $project_title = $info['project_title'];
                        $mentor_id = $info['mentor_id'];
                        $student_id1 = $info['student_id1'];
                        $student_id2 = $info['student_id2'];
                        $status = $info['status'];
                        $pdf = $info['pdf'];

                    ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $notice_id ?></td>
                                <td><?= $project_title ?></td>
                                <td><?= $mentor_id ?></td>
                                <td><?= $student_id1 ?></td>
                                <td><?= $student_id2 ?></td>
                                <td><?= $status ?></td>
                                <td><?= $pdf ?></td>

                            </tr>
                        <?php
                    }
                } else {
                        ?>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Posted By</th>
                                <th scope="col">Pririty</th>
                            </tr>
                        </thead>
                    <?php
                }
                    ?>

                        </tbody>
            </table>
        </div>










        <div class="table_to_edit">
            <table class="table table table-striped table-hover">
                <h3 class="textbold"> User Database</h3>
                <?php
                include 'db.php';

                $sql = "SELECT user_id, f_name, l_name, contact,password, age, gender, type FROM  user";
                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) > 0) {
                ?>

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Contact Num</th>
                            <th scope="col">Password</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">type</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    while ($info = mysqli_fetch_array($query)) {
                        $notice_id = $info['user_id'];
                        $project_title = $info['f_name'];
                        $mentor_id = $info['l_name'];
                        $student_id1 = $info['contact'];
                        $student_id2 = $info['password'];
                        $status = $info['age'];
                        $pdf = $info['gender'];
                        $pdf_1 = $info['type'];

                    ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $notice_id ?></td>
                                <td><?= $project_title ?></td>
                                <td><?= $mentor_id ?></td>
                                <td><?= $student_id1 ?></td>
                                <td><?= $student_id2 ?></td>
                                <td><?= $status ?></td>
                                <td><?= $pdf ?></td>
                                <td><?= $pdf_1 ?></td>

                            </tr>
                        <?php
                    }
                } else {
                        ?>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Posted By</th>
                                <th scope="col">Pririty</th>
                            </tr>
                        </thead>
                    <?php
                }
                    ?>

                        </tbody>
            </table>
        </div>




        <div class="table_to_edit">
            <table class="table table table-striped table-hover">
                <h3 class="textbold"> Contact database</h3>
                <?php
                include 'db.php';

                $sql = "SELECT contact_id, name, num, subject,message FROM  contact";
                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) > 0) {
                ?>

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Num</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>


                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    while ($info = mysqli_fetch_array($query)) {
                        $notice_id = $info['contact_id'];
                        $project_title = $info['name'];
                        $mentor_id = $info['num'];
                        $student_id1 = $info['subject'];
                        $student_id2 = $info['message'];


                    ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $notice_id ?></td>
                                <td><?= $project_title ?></td>
                                <td><?= $mentor_id ?></td>
                                <td><?= $student_id1 ?></td>
                                <td><?= $student_id2 ?></td>

                            </tr>
                        <?php
                    }
                } else {
                        ?>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Num</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                            </tr>
                        </thead>
                    <?php
                }
                    ?>

                        </tbody>
            </table>
        </div>






        <div class="row" style="margin-bottom: 50px">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Delete Data </h3>
                        <form class="row g-3" action="delete_data.php" method="post">
                            <div class="col-md-4">
                                <label for="validationDefault06" class="form-label">ID</label>
                                <input type="text" class="form-control" id="validationDefault06" name="ID" required />
                            </div>


                            <div class="col-md-4">
                                <!-- <label for="validationDefaultUsername" class="form-label">Table Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" name="table_name" required />
                                </div> -->
                                <label for="validationDefault04" class="form-label">Table Name</label>
                                <select class="form-select" id="validationDefault04" name="table_name" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="notice_review">Notice Review Request</option>
                                    <option value="notice_board">Notice Board</option>
                                    <option value="projects">Projects Submitted</option>
                                    <option value="user">User Database</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                    <label class="form-check-label" for="invalidCheck2">
                                        Are you sure you want to delete?
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">
                                    Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>



    </section>

    <!--==================== LOGIN ====================-->
    <!-- <div class="login" id="login">
    <form action="" class="login__form">
      <h2 class="login__title">Log In</h2>

      <div class="login__group">
        <div>
          <label for="email" class="login__label">Email</label>
          <input type="email" placeholder="Write your email" id="email" class="login__input" />
        </div>

        <div>
          <label for="password" class="login__label">Password</label>
          <input type="password" placeholder="Enter your password" id="password" class="login__input" />
        </div>
      </div>

      <div>
        <p class="login__signup">
          You do not have an account? <a href="#">Sign up</a>
        </p>

        <a href="#" class="login__forgot"> You forgot your password </a>

        <button type="submit" class="login__button">Log In</button>
      </div>
    </form>

    <i class="ri-close-line login__close" id="login-close"></i>
  </div> -->

    <script src="data_entry.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>