<?php
include 'db.php';
session_start();
$id = $_SESSION['ID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" />
<link rel="stylesheet" href="style.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<title>BU Tech 360</title>

<style>
@media only screen and (max-width: 985px) {
    #media_2 { margin-top: 100px; margin-bottom: 100px; }
    h3 { text-align: center; }
    a { text-decoration: none; }
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

/* Student input boxes */
#student-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.student-box {
    width: 215px; /* fixed width */
}
</style>
</head>
<body>
<header class="header" id="header">
<nav class="navbar_custom nav-container">
    <img src="bulogo.png" alt="" class="nav__logo" />
    <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
            <li class="nav__item"><a href="officer_dashboard.php" class="nav__link">Dashboard</a></li>
            <li class="nav__item"><a href="officer_std_register_approve.php" class="nav__link">Registration Approve</a></li>
            <li class="nav__item"><a href="data_entry.php" class="nav__link">Data Entry</a></li>
            <li class="nav__item"><a href="data_view.php" class="nav__link">Data View</a></li>
            <li class="nav__item"><a href="notice_review_and_post.php" class="nav__link">Notice Review and Post</a></li>
        </ul>
    </div>
    <div class="nav__actions">
        <div class="nav__toggle" id="nav-toggle"><i class="ri-menu-line"></i></div>
        <a href="homepage.php"><i class="ri-logout-box-r-line" id="login-btn"></i></a>
    </div>
</nav>
</header>

<section>
<div class="row" style="width:100%; margin:150px auto 0 auto; justify-content:center;">

<!-- User Entry Form -->
<div class="col-lg-6 mb-3 mb-sm-0">
    <div class="card" style="box-shadow:0px 0px 10px rgba(0,0,0,0.5);">
        <div class="card-body">
            <h3 class="card-title">User Entry</h3>
            <form class="row g-3" action="user_connect.php" method="post" enctype="multipart/form-data">
                <div class="col-md-4">
                    <label class="form-label">First name</label>
                    <input type="text" class="form-control" name="f_name" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label">Last name</label>
                    <input type="text" class="form-control" name="l_name" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label">Contact Number</label>
                    <input type="text" class="form-control" name="contact" required 
                           pattern="\d{11}" maxlength="11" 
                           title="Contact number must be exactly 11 digits" />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" name="dob" required />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Age</label>
                    <input type="number" class="form-control" name="age" min="0" />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="F">Female</option>
                        <option value="M">Male</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Type of user</label>
                    <select class="form-select" name="type" required>
                        <option selected disabled value="">Choose...</option>
                        <option>Student</option>
                        <option>Mentor</option>
                        <option>Officer</option>
                        <option>Director</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" required />
                </div>
                <div class="form-group mb-3">
                    <label>Profile Picture</label>
                    <input type="file" name="profile_pic" class="form-control" accept="image/*" required>
                </div>
                <div class="col-12" style="margin-top:12px">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Project Data Entry Form -->
<div class="col-lg-6 mb-3 mb-sm-0">
    <div class="card" style="box-shadow:0px 0px 10px rgba(0,0,0,0.5);">
        <div class="card-body">
            <h3 class="card-title">Project Data Entry</h3>
            <form class="row g-3" action="project_connect.php" method="post" enctype="multipart/form-data">
                <div class="col-md-8"><label class="form-label">Project Title</label><input type="text" class="form-control" name="project_title" required /></div>
                <div class="col-md-4"><label class="form-label">Mentor</label>
                    <select class="form-select" name="mentor_id" required>
                        <option value="">Select Mentor</option>
                        <?php
                        $mentors = mysqli_query($conn, "SELECT user_id, f_name, l_name FROM user WHERE type = 'mentor'");
                        while ($mentor = mysqli_fetch_assoc($mentors)) {
                            echo "<option value='{$mentor['user_id']}'>{$mentor['f_name']} {$mentor['l_name']} (ID: {$mentor['user_id']})</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Number of Students</label><br>
                    <?php for ($i=1;$i<=4;$i++): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="num_students" id="num<?=$i?>" value="<?=$i?>" <?= $i===1?'checked':''?>>
                        <label class="form-check-label" for="num<?=$i?>"><?=$i?></label>
                    </div>
                    <?php endfor; ?>
                </div>

                <div class="col-12" id="student-container">
                    <?php for($i=1;$i<=4;$i++): ?>
                    <div class="student-box" id="student<?=$i?>">
                        <label class="form-label">Student <?=$i?></label>
                        <input type="text" class="form-control" name="student_id<?=$i?>" <?= $i===1?"value='$id' readonly":"placeholder='ID MUST EXIST IN DB'" ?> />
                    </div>
                    <?php endfor; ?>
                </div>

                <div class="col-md-4"><label class="form-label">Status</label>
                    <select class="form-select" name="status" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Reviewed">Reviewed</option>
                        <option value="Rechecked">Rechecked</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>

                <div class="col-md-4"><label class="form-label">Upload PDF</label><input type="file" class="form-control" name="pdf"></div>
                <div class="col-12"><button class="btn btn-primary" type="submit" name="submit">Submit form</button></div>
            </form>
        </div>
    </div>
</div>

</div>

<!-- Notice Board Data Request Entry Form -->
<div class="row" style="width:100%; margin:100px auto 80px auto; justify-content:center;">
    <div class="col-lg-6">
        <div class="card" style="box-shadow:0px 0px 10px rgba(0,0,0,0.5);">
            <div class="card-body">
                <h3 class="card-title text-center">Notice Board Data Request Entry</h3>
                <form class="row g-3" action="officer_notice_review_connect_1.php" method="post">
                    <div class="col-md-4"><label class="form-label">Title</label><input type="text" class="form-control" name="title" required /></div>
                    <div class="col-md-4"><label class="form-label">Priority level</label>
                        <select class="form-select" name="priority_level" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="high">High</option>
                            <option value="mid">Mid</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="col-md-4"><label class="form-label">Posted By</label><input type="text" class="form-control" name="posted_by" placeholder="ID MUST EXIST IN DB" required /></div>
                    <div class="col-md-12"><label class="form-label">Content</label><textarea class="form-control" name="content" required></textarea></div>
                    <div class="col-12"><button class="btn btn-primary" type="submit">Submit form</button></div>
                </form>
            </div>
        </div>
    </div>
</div>

</section>

<script>
const studentFields = [1,2,3,4].map(i => document.getElementById('student'+i));
const radios = document.querySelectorAll('input[name="num_students"]');

function toggleStudents() {
    const num = parseInt(document.querySelector('input[name="num_students"]:checked').value);
    studentFields.forEach((field,index)=>{
        field.style.display = (index < num) ? 'block' : 'none';
        field.querySelector('input').required = index < num;
    });
}

radios.forEach(radio => radio.addEventListener('change', toggleStudents));
window.onload = toggleStudents;

// Contact Number: only digits, max 11
const contactInput = document.querySelector('input[name="contact"]');
contactInput.addEventListener('input', function() {
    this.value = this.value.replace(/\D/g,'').slice(0,11);
});

// Age: min 1 if user enters 0 or negative
const ageInput = document.querySelector('input[name="age"]');
ageInput.addEventListener('input', function() {
    if(this.value !== '' && this.value < 1) {
        this.value = 1;
    }
});
</script>

<script src="homepage.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
