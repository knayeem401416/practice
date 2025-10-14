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
  <div class="row project-submit" style="margin: 150px 0px auto auto; justify-content: center;">
    <div class="col-lg-6 mb-3 mb-sm-0">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Project data Entry</h3>
          <form class="row g-3" action="student_project_connect.php" method="post" enctype="multipart/form-data">
            <div class="col-md-8">
              <label for="validationDefault06" class="form-label">Project Title</label>
              <input type="text" class="form-control" id="validationDefault06" name="project_title" required />
            </div>

            <div class="col-md-4">
              <label for="validationDefaultUsername" class="form-label">Mentor ID</label>
              <div class="input-group">
                <input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" name="mentor_id" placeholder="ID MUST EXIST IN DB" required />
              </div>
            </div>
            <div class="col-md-3">
              <label for="validationDefault03" class="form-label">Student 1</label>
              <input value=<?= $id ?> class="form-control" id="validationDefault03" name="student_id1" placeholder="ID MUST EXIST IN DB" required />
            </div>
            <div class="col-md-3">
              <label for="validationDefault03" class="form-label">Student 2</label>
              <input type="text" class="form-control" id="validationDefault03" name="student_id2" placeholder="ID MUST EXIST IN DB" />
            </div>
            <div class="col-md-3">
              <label for="validationDefault03" class="form-label">Student 3</label>
              <input type="text" class="form-control" id="validationDefault03" name="student_id3" placeholder="ID MUST EXIST IN DB" />
            </div>
            <div class="col-md-3">
              <label for="validationDefault03" class="form-label">Student 4</label>
              <input type="text" class="form-control" id="validationDefault03" name="student_id4" placeholder="ID MUST EXIST IN DB" />
            </div>
            <div class="col md-4">
              <label for="validationDefault04" class="form-label">Upload pdf </label>
              <input type="file" class="form-control" name="pdf" id="pdf">

            </div>


            <div class="col-12">
              <button class="btn btn-primary" type="submit" name="submit">
                Submit form
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="homepage.js"></script>
</body>

</html>