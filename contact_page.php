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
                        <a href="#" class="nav__link">About Us</a>
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
        <form action="homepage.php" class="login__form" method="POST">
            <h2 class="login__title">Log In</h2>
            <div class="login__group">
                <div>
                    <label for="id" class="login__label">ID</label>
                    <input type="text" placeholder="Enter your ID" id="id" name="id" class="login__input">
                </div>

                <div>
                    <label for="password" class="login__label">Password</label>
                    <input type="password" placeholder="Enter your password" id="password" name="password" class="login__input">
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
                    You do not have an account? <a href="#">Sign up</a>
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
                        <input type="text" class="form-control" id="mobile" name="mobile" required>
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
                <li>About Us</li>
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
</body>
</html>
