<?php
session_start();
include 'db.php';

$errorMsg = "";
$successMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $ID = trim($_POST['id']);
    $password = trim($_POST['password']);
    $userType = trim($_POST['userType']);

    if (empty($ID) || empty($password) || empty($userType)) {
        $errorMsg = "Please fill in all fields.";
    } else {
        $sql = "SELECT * FROM user WHERE user_id = ? AND password = ? AND type = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $ID, $password, $userType);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['ID'] = $ID;
            $_SESSION['userType'] = $userType;

            $successMsg = "Login Successful!";
            $redirectPage = "";

            switch ($userType) {
                case 'student': $redirectPage = "std_dashboard.php"; break;
                case 'director': $redirectPage = "director_dashboardpage.php"; break;
                case 'officer': $redirectPage = "officer_dashboard.php"; break;
                case 'mentor': $redirectPage = "mentor_dashboardpage.php"; break;
                default: $errorMsg = "Invalid user type.";
            }

            if ($redirectPage !== "") {
                echo "<script>
                    alert('$successMsg');
                    window.location.href = '$redirectPage';
                </script>";
                exit;
            }
        } else {
            $errorMsg = "❌ Login failed!";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<title>BU Tech 360</title>
<style>
    .login { 
        display: none; 
    }
    .show-login { 
        display: flex; 
    }
    .login__error { 
        background-color: #ffe0e0; 
        color: #b30000; 
        padding: 10px; 
        border-radius: 6px; 
        font-weight: 600; 
        text-align: center; 
        margin-bottom: 10px; 
        border: 1px solid #ffb3b3; 
    }
    .password-toggle, .password-toggle1 { 
        position: absolute; 
        right: 12px; 
        cursor: pointer; 
        color: #6c757d; 
        font-size: 18px; 
        z-index: 3; 
        user-select: none; 
        line-height: 1; 
        transition: color 0.2s ease; 
    }
    .password-toggle { 
        bottom: 20px; 
    }
    .password-toggle1 { 
        bottom: 10px; 
    }
    .approval-section {
        margin-top: 150px !important;
    }
</style>
</head>
<body>

<header class="header" id="header">
<nav class="navbar_custom nav-container">
    <img src="bulogo.png" alt="" class="nav__logo">
    <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
            <li class="nav__item"><a href="homepage.php" class="nav__link">Home</a></li>
            <li class="nav__item"><a href="about_us.php" class="nav__link">About Us</a></li>
            <li class="nav__item"><a href="#" class="nav__link">Services</a></li>
            <li class="nav__item"><a href="#" class="nav__link">Featured</a></li>
            <li class="nav__item"><a href="contact_page.php" class="nav__link active">Contact Us</a></li>
        </ul>
        <div class="nav__close" id="nav-close"><i class="ri-close-line"></i></div>
    </div>
    <div class="nav__actions">
        <div class="nav__toggle" id="nav-toggle"><i class="ri-menu-line"></i></div>
        <i class="ri-user-line nav__login" id="login-btn"></i>
    </div>
</nav>
</header>

<!-- Login Form -->
<div class="login" id="login">
    <form action="" class="login__form" method="POST">
        <h2 class="login__title">Log In</h2>
        <?php if (!empty($errorMsg)): ?>
            <div class="login__error"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>
        <div class="login__group">
            <div>
                <label for="id" class="login__label">ID</label>
                <input type="text" placeholder="Enter your ID" id="id" name="id" class="login__input">
            </div>
            <div class="position-relative">
                <label for="password" class="login__label">Password</label>
                <input type="password" placeholder="Enter your password" id="password" name="password" class="login__input pe-5" required>
                <i class="ri-eye-off-line password-toggle" id="togglePassword" role="button" tabindex="0"></i>
            </div>
            <div>
                <label for="userType" class="login__label">User Type</label>
                <select id="userType" name="userType" class="login__select" required>
                    <option value="" selected disabled hidden>Select User Type</option>
                    <option value="student">Student</option>
                    <option value="director">Director</option>
                    <option value="officer">Officer</option>
                    <option value="mentor">Mentor</option>
                </select>
            </div>
        </div>
        <div>
            <p class="login__signup">You do not have an account? <a href="signup.php">Sign up</a></p>
            <a href="#" class="login__forgot">You forgot your password</a>
            <button type="submit" name="login" class="login__button">Log In</button>
        </div>
    </form>
    <i class="ri-close-line login__close" id="login-close"></i>
</div>

<!-- Check Approval Section -->
<div class="container my-5 approval-section">
    <div class="card shadow-lg border-0 p-4 mx-auto" style="max-width: 500px;">
        <h3 class="text-center mb-4">Check Registration Approval</h3>

        <?php
        $approveMsg = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['check_approve'])) {
            $fname = trim($_POST['f_name']);
            $lname = trim($_POST['l_name']);
            $contact = trim($_POST['contact']);
            $password = trim($_POST['password']);

            if (empty($fname) || empty($lname) || empty($contact) || empty($password)) {
                $approveMsg = "<div class='alert alert-danger text-center'>⚠️ Please fill in all fields.</div>";
            } else {
                $sql = "SELECT status FROM student_registration WHERE f_name=? AND l_name=? AND contact=? AND password=?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $contact, $password);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    $status = ucfirst($row['status']);
                    if ($status === "Pending") {
                        $approveMsg = "<div class='alert alert-warning text-center'>⏳ Your registration is pending for approval.</div>";
                    } elseif ($status === "Rejected") {
                        $approveMsg = "<div class='alert alert-danger text-center'>❌ Your registration has been rejected.</div>";
                    } elseif ($status === "Approved") {
                        $sqlUser = "SELECT user_id FROM user WHERE f_name=? AND l_name=? AND contact=? AND password=?";
                        $stmtUser = mysqli_prepare($conn, $sqlUser);
                        mysqli_stmt_bind_param($stmtUser, "ssss", $fname, $lname, $contact, $password);
                        mysqli_stmt_execute($stmtUser);
                        $resultUser = mysqli_stmt_get_result($stmtUser);

                        if ($userRow = mysqli_fetch_assoc($resultUser)) {
                            $userID = $userRow['user_id'];
                            $approveMsg = "<div class='alert alert-success text-center'>✅ Registration approved!<br>Your User ID is: <strong>$userID</strong></div>";
                        } else {
                            $approveMsg = "<div class='alert alert-info text-center'>⚠️ Approved but user record not created yet.</div>";
                        }
                        mysqli_stmt_close($stmtUser);
                    } else {
                        $approveMsg = "<div class='alert alert-secondary text-center'>ℹ️ Unknown status.</div>";
                    }
                } else {
                    $approveMsg = "<div class='alert alert-danger text-center'>❌ No matching record found!</div>";
                }
                mysqli_stmt_close($stmt);
            }
        }
        ?>
        
        <div class="mt-3">
            <?= $approveMsg ?>
        </div>

        <form method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="f_name" class="form-label">First Name</label>
                <input type="text" name="f_name" id="f_name" class="form-control" placeholder="Enter first name" required>
            </div>
            <div class="mb-3">
                <label for="l_name" class="form-label">Last Name</label>
                <input type="text" name="l_name" id="l_name" class="form-control" placeholder="Enter last name" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter contact number" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="approve_password" class="form-label">Password</label>
                <input type="password" name="password" id="approve_password" class="form-control pe-5" placeholder="Enter password" required>
                <i class="ri-eye-off-line password-toggle1" id="toggleApprovePassword" role="button" tabindex="0"></i>
            </div>
            <div class="text-center">
                <button type="submit" name="check_approve" class="btn btn-primary w-100">Check Status</button>
            </div>
        </form>
    </div>
</div>

<!--==================== FOOTER ====================-->
    <div class="footer-container">
        <div class="footer-logo">
            <img src="bulogo.png" alt="">
        </div>
        <div class="footer-col-1">
            <ul>
                <li><a href="about_us.php">About Us</a></li>
                <li>Contact Us</li>
                <li>FAQs</li>
                <li>Support</li>
                <li>Blog</li>
            </ul>
        </div>
        <div class="footer-col-2">
            <ul>
                <li>Services</li>
                <li>Products</li>
                <li>Features</li>
                <li>Case Studies</li>
                <li>Testimonials</li>
            </ul>
        </div>
        <div class="footer-social-icon">
            <div style="margin-bottom: 10px; color: hsl(230, 12%, 40%); font-size: 40px;"><i class="ri-facebook-circle-fill"></i></div>
            <div style="margin-bottom: 10px; color: hsl(230, 12%, 40%); font-size: 40px;"><i class="ri-linkedin-box-fill"></i></div>
            <div style="margin-bottom: 10px; color: hsl(230, 12%, 40%); font-size: 40px;"><i class="ri-instagram-fill"></i></div>
        </div>
    </div>

<script src="homepage.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Open login if error exists
    <?php if (!empty($errorMsg)): ?>
    document.getElementById("login").classList.add("show-login");
    <?php endif; ?>

    // Password toggles
    function setupPasswordToggle(toggleId, inputId) {
        const toggle = document.getElementById(toggleId);
        const input = document.getElementById(inputId);
        if (!toggle || !input) return;
        toggle.addEventListener('click', () => {
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            toggle.classList.toggle('ri-eye-line', isPassword);
            toggle.classList.toggle('ri-eye-off-line', !isPassword);
        });
    }
    setupPasswordToggle('togglePassword', 'password');
    setupPasswordToggle('toggleApprovePassword', 'approve_password');

    // Contact field validation
    const contactInput = document.getElementById('contact');
    if (contactInput) {
        contactInput.addEventListener('input', function(){
            this.value = this.value.replace(/\D/g, '').slice(0, 11);
        });
    }
});
</script>
</body>
</html>
