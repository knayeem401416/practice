<?php
session_start();
include 'db.php'; // your DB connection file

$errorMsg = "";
$successMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ID = trim($_POST['id']);
    $password = trim($_POST['password']);
    $userType = trim($_POST['userType']);

    if (empty($ID) || empty($password) || empty($userType)) {
        $errorMsg = "Please fill in all fields.";
    } else {
        // ✅ Check all 3: ID, password, and user type
        $sql = "SELECT * FROM user WHERE user_id = ? AND password = ? AND type = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $ID, $password, $userType);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // ✅ Match found
            $_SESSION['ID'] = $ID;
            $_SESSION['userType'] = $userType;

            // show success alert before redirect
            $successMsg = "Login Successful!";
            $redirectPage = "";

            switch ($userType) {
                case 'student':
                    $redirectPage = "std_dashboard.php";
                    break;
                case 'director':
                    $redirectPage = "director_dashboardpage.php";
                    break;
                case 'officer':
                    $redirectPage = "officer_dashboard.php";
                    break;
                case 'mentor':
                    $redirectPage = "mentor_dashboardpage.php";
                    break;
                default:
                    $errorMsg = "Invalid user type.";
            }

            if ($redirectPage !== "") {
                echo "<script>
                    alert('$successMsg');
                    window.location.href = '$redirectPage';
                </script>";
                exit;
            }
        } else {
            // ❌ Login failed
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>BU Tech 360</title>
</head>

<style>
    .login {
        display: none;
    }

    .show-login {
        display: flex; /* or whatever display type your JS uses */
    }

    .login__error {
        background-color: #ffe0e0; /* light red background */
        color: #b30000;            /* dark red text */
        padding: 10px;
        border-radius: 6px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 10px;
        border: 1px solid #ffb3b3;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        bottom: 20px;
        cursor: pointer;
        color: #6c757d;
        font-size: 18px;
        z-index: 3;
        user-select: none;
        line-height: 1;
        transition: color 0.2s ease;
    }
</style>

<body>
    <header class="header" id="header">
        <nav class="navbar_custom nav-container">
            <img src="bulogo.png" alt="" class="nav__logo">

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="homepage.php" class="nav__link">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="about_us.php" class="nav__link">About Us</a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">Services</a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">Featured</a>
                    </li>
                    <li class="nav__item">
                        <a href="contact_page.php" class="nav__link active">Contact Us</a>
                    </li>
                </ul>

                <!-- Close button -->
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>

            <div class="nav__actions">
                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-menu-line"></i>
                </div>
                <!-- Login button -->
                <i class="ri-user-line nav__login" id="login-btn"></i>
            </div>
        </nav>
    </header>

    <!--==================== LOGIN ====================-->
    <div class="login" id="login">
        <form action="contact_page.php" class="login__form" method="POST">
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
                    <i class="ri-eye-off-line password-toggle" id="togglePassword" role="button" tabindex="0" aria-label="Toggle password visibility"></i>
                </div>

                <div>
                    <label for="userType" class="login__label">User Type</label>
                    <select id="userType" name="userType" class="login__select" required>
                        <option value="" selected disabled hidden>Select User Type</option>
                        <option value="student">Student</option>
                        <option value="director">Director</option>
                        <option value="officer">Officer</option>
                        <option value="mentor">Mentor</option>
                        <!-- <option value="trainer">Trainer</option> -->
                    </select>
                </div>
            </div>

            <div>
                <p class="login__signup">
                    You do not have an account? <a href="signup.php">Sign up</a>
                </p>

                <a href="#" class="login__forgot">
                    You forgot your password
                </a>

                <button type="submit" class="login__button">Log In</button>
            </div>
        </form>

        <i class="ri-close-line login__close" id="login-close"></i>
    </div>

    <!--==================== CONTACT FORM ====================-->
    <div class="container" style="margin-top: 150px;">
        <div class="row justify-content-center bg-light border rounded" style="width: 50%; margin-left: auto; margin-right: auto;">
            <div class="col-md-8 mt-5">
                
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success text-center">Your message has been sent successfully!</div>
                <?php elseif (isset($_GET['error'])): ?>
                    <div class="alert alert-danger text-center">There was an error sending your message. Please try again.</div>
                <?php endif; ?>

                <form action="contact.php" method="post">
                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="mobile">Mobile Number:</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" pattern="\d{11}" maxlength="11" title="Mobile number must be exactly 11 digits" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="subject">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>

                    <input type="submit" class="btn btn-primary mt-2 mb-5 w-100" name="send-message" value="Send Message">
                </form>
            </div>
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
    <?php if (!empty($errorMsg)): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("login").classList.add("show-login"); // open the login box
            });
        </script>
    <?php endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.getElementById("togglePassword");
            const passwordInput = document.getElementById("password");

            togglePassword.addEventListener("click", function () {
                // Toggle input type between password/text
                const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);

                // Toggle icon class (eye / eye-off)
                this.classList.toggle("ri-eye-off-line");
                this.classList.toggle("ri-eye-line");
            });

            // Optional: allow pressing Enter key on the icon for accessibility
            togglePassword.addEventListener("keypress", function (e) {
                if (e.key === "Enter" || e.key === " ") {
                    togglePassword.click();
                }
            });
        });
    </script>

</body>
</html>
