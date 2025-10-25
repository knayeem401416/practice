<?php
session_start();
include 'db.php';

$errorMsg = "";
$successMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        /* ===== Login Popup ===== */
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

        .password-toggle {
            position: absolute;
            right: 12px;
            bottom: 15px;
            cursor: pointer;
            color: #6c757d;
            font-size: 18px;
            z-index: 3;
            user-select: none;
            transition: color 0.2s ease;
        }

        /* ===== Information Section ===== */
        .info-section {
            max-width: 1100px;
            margin: 120px auto;
            padding: 20px;
            background: #fff;
        }

        .info-title {
            font-size: 28px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 30px;
            text-align: left;
            border-bottom: 3px solid #007bff;
            display: inline-block;
            padding-bottom: 5px;
        }

        .info-container {
            display: flex;
            align-items: flex-start;
            gap: 30px;
            flex-wrap: wrap;
        }

        .info-image {
            flex: 1;
            min-width: 300px;
        }

        .info-image img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .info-text {
            flex: 2;
            font-size: 16px;
            line-height: 1.7;
            color: #333;
            text-align: justify;
        }

        .info-text strong {
            color: #000;
        }

        @media (max-width: 768px) {
            .info-container {
                flex-direction: column;
            }

            .info-title {
                text-align: center;
            }
        }

        /* ===== Footer ===== */
        .footer-container {
            background-color: #f8f9fa;
            padding: 40px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            text-align: center;
        }

        .footer-logo img {
            width: 120px;
            margin-bottom: 20px;
        }

        .footer-col-1 ul,
        .footer-col-2 ul {
            list-style: none;
            padding: 0;
        }

        .footer-col-1 ul li,
        .footer-col-2 ul li {
            color: #555;
            margin-bottom: 8px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .footer-col-1 ul li:hover,
        .footer-col-2 ul li:hover {
            color: #007bff;
        }

        .footer-social-icon i {
            margin: 5px;
            font-size: 32px;
            color: hsl(230, 12%, 40%);
            transition: color 0.3s;
        }

        .footer-social-icon i:hover {
            color: #007bff;
        }
    </style>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="navbar_custom nav-container">
            <img src="bulogo.png" alt="" class="nav__logo">

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="homepage.php" class="nav__link active">Home</a></li>
                    <li class="nav__item"><a href="about_us.php" class="nav__link">About Us</a></li>
                    <li class="nav__item"><a href="#" class="nav__link">Services</a></li>
                    <li class="nav__item"><a href="#" class="nav__link">Featured</a></li>
                    <li class="nav__item"><a href="contact_page.php" class="nav__link">Contact Us</a></li>
                </ul>
                <div class="nav__close" id="nav-close"><i class="ri-close-line"></i></div>
            </div>

            <div class="nav__actions">
                <div class="nav__toggle" id="nav-toggle"><i class="ri-menu-line"></i></div>
                <i class="ri-user-line nav__login" id="login-btn"></i>
            </div>
        </nav>
    </header>

    <!--==================== LOGIN POPUP ====================-->
    <div class="login" id="login">
        <form action="about_us.php" class="login__form" method="POST">
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
                    <i class="ri-eye-off-line password-toggle" id="togglePassword"></i>
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
                <button type="submit" class="login__button">Log In</button>
            </div>
        </form>
        <i class="ri-close-line login__close" id="login-close"></i>
    </div>

    <!--==================== INFORMATION SECTION ====================-->
    <section class="info-section">
        <h2 class="info-title">INFORMATION</h2>
        <div class="info-container">
            <div class="info-image">
                <img src="campus.jpg" alt="Bangladesh University Campus">
            </div>

            <div class="info-text">
                <p><strong>Bangladesh University (BU)</strong> was established in 2001 under Private University Act, 1992 by Mr. Quazi Azher Ali, as a non-profit, non-political private university pioneering in computer-based education. It has been accredited by the Government of the People’s Republic of Bangladesh. Its curricula as well as programs have been approved by the University Grants Commission (UGC) of Bangladesh. BU is approved by the Government of Bangladesh for awarding degrees in various disciplines. We are committed to excellence and innovation in pursuing applied knowledge through research and creative activities with the objectives of producing world-class professionals responsive to the needs of the Bangladeshi community and the world at large.</p>

                <p>BU started its academic session with 17 students and 0.02 acres of space in 2001. Now BU can accommodate around 3400 students in its own aesthetic permanent campus. With 85 full-time and 20 part-time faculty members and 110 administrative members, officials and staffs, our community continues to grow to cater to the needs of both the students and the nation as well.</p>

                <p><strong>Location:</strong><br>
                    The permanent campus is located at <strong>5/B, Beribandh Main Road, Adabar, Mohammadpur, Dhaka</strong> which is well connected with other parts of Dhaka city. The permanent campus is having 1.7026 acres of land and it was inaugurated by Advocate Jahangir Kabir Nanak, MP and former Hon’ble State Minister for Local Govt., Rural Development and Co-operatives on October 18, 2011.
                </p>

                <p><strong>Founder:</strong><br>
                    The President of the People’s Republic of Bangladesh is the Chancellor of Bangladesh University (BU). He appointed Quazi Azher Ali, M.Sc. (DU), MPA (Harvard), the founder of BU as its Vice Chancellor. Virtually BU is the vivid imaginative conception of this noble soul. He held this position since its inception in October, 2001 till the day of his death on December 15, 2009. He had high academic achievement with long and varied experiences in national and international administration including Secretary to the Government of Bangladesh and Executive Director of Asian Development Bank (ADB). Mr. Ali agreed to accept taka one per month as salary considering the initial financial problems for a new noncommercial institution.
                </p>
            </div>
        </div>
    </section>

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
            <i class="ri-facebook-circle-fill"></i>
            <i class="ri-linkedin-box-fill"></i>
            <i class="ri-instagram-fill"></i>
        </div>
    </div>

    <script src="homepage.js"></script>

    <?php if (!empty($errorMsg)): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("login").classList.add("show-login");
            });
        </script>
    <?php endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.getElementById("togglePassword");
            const passwordInput = document.getElementById("password");

            togglePassword.addEventListener("click", function() {
                const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);
                this.classList.toggle("ri-eye-off-line");
                this.classList.toggle("ri-eye-line");
            });
        });
    </script>
</body>
</html>
