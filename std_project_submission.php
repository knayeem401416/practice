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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<title>BU Tech 360</title>

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

  /* Student boxes layout */
  #student-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }

  .student-box {
    width: 218px; /* fixed width so boxes do not resize */
  }
</style>
</head>

<body>
<header class="header" id="header">
<nav class="navbar_custom nav-container">
    <img src="bulogo.png" alt="" class="nav__logo">
    <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
            <li class="nav__item"><a href="std_dashboard.php" class="nav__link">Dashboard</a></li>
            <li class="nav__item"><a href="std_project_submission.php" class="nav__link">Project Submission</a></li>
            <li class="nav__item"><a href="std_status.php" class="nav__link">Project Status</a></li>
        </ul>
    </div>
    <div class="nav__actions">
        <div class="nav__toggle" id="nav-toggle"><i class="ri-menu-line"></i></div>
        <a href="homepage.php"><i class="ri-logout-box-r-line" id="login-btn"></i></a>
    </div>
</nav>
</header>

<div class="row project-submit" style="margin: 150px 0px auto auto; justify-content: center;">
    <div class="col-lg-6 mb-3 mb-sm-0">
        <div class="card">
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="container mt-4">
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="ri-check-line" style="font-size: 1.2rem; margin-right: 10px;"></i>
                            <div>' . $_SESSION['message'] . '</div>
                        </div>
                      </div>';
                unset($_SESSION['message']);
            }
            ?>

            <div class="card-body">
                <h3 class="card-title">Project Data Entry</h3>
                <form class="row g-3" action="student_project_connect.php" method="post" enctype="multipart/form-data">
                    <div class="col-md-8">
                        <label class="form-label">Project Title</label>
                        <input type="text" class="form-control" name="project_title" required />
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Mentor</label>
                        <select class="form-select" name="mentor_id" required>
                            <option value="">Select Mentor</option>
                            <?php
                            $mentors = mysqli_query($conn, "SELECT user_id, f_name, l_name FROM user WHERE type='mentor'");
                            while ($mentor = mysqli_fetch_assoc($mentors)) {
                                echo "<option value='{$mentor['user_id']}'>{$mentor['f_name']} {$mentor['l_name']} (ID: {$mentor['user_id']})</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Number of Students</label><br>
                        <?php for ($i=1; $i<=4; $i++): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="num_students" id="num<?=$i?>" value="<?=$i?>" <?= $i===1 ? 'checked' : '' ?>>
                            <label class="form-check-label" for="num<?=$i?>"><?=$i?></label>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <div class="col-12" id="student-container">
                        <div class="student-box" id="student1">
                            <label class="form-label">Student 1</label>
                            <input type="text" class="form-control" name="student_id1" value="<?= $id ?>" readonly />
                        </div>
                        <div class="student-box" id="student2">
                            <label class="form-label">Student 2</label>
                            <input type="text" class="form-control" name="student_id2" placeholder="ID MUST EXIST IN DB" required />
                        </div>
                        <div class="student-box" id="student3">
                            <label class="form-label">Student 3</label>
                            <input type="text" class="form-control" name="student_id3" placeholder="ID MUST EXIST IN DB" required />
                        </div>
                        <div class="student-box" id="student4">
                            <label class="form-label">Student 4</label>
                            <input type="text" class="form-control" name="student_id4" placeholder="ID MUST EXIST IN DB" required />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Upload PDF</label>
                        <input type="file" class="form-control" name="pdf">
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
const studentFields = [1,2,3,4].map(i => document.getElementById('student'+i));
const radios = document.querySelectorAll('input[name="num_students"]');

function toggleStudents() {
    const num = parseInt(document.querySelector('input[name="num_students"]:checked').value);
    studentFields.forEach((field,index)=>{
        field.style.display = (index < num) ? 'block' : 'none';
        field.querySelector('input').required = index < num && index!==0; // first student is readonly
    });
}

radios.forEach(radio => radio.addEventListener('change', toggleStudents));
window.onload = toggleStudents;
</script>

<script src="homepage.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
