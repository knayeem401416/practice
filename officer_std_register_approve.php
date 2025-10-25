<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['ajax'], $_POST['action'], $_POST['reg_id'])) {
        $reg_id = mysqli_real_escape_string($conn, $_POST['reg_id']);
        $action = $_POST['action'];

        if ($action === 'approve') {
            $status = 'Approved';
        } elseif ($action === 'reject') {
            $status = 'Rejected';
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
            exit;
        }

        // ✅ Force correct type match
        $update_sql = "UPDATE student_registration SET status='$status' WHERE reg_id='$reg_id' OR reg_id=" . intval($reg_id);

        if (mysqli_query($conn, $update_sql)) {

            // ✅ Check updated row actually changed
            if (mysqli_affected_rows($conn) > 0) {

                // ✅ Fetch the student
                $select_sql = "SELECT * FROM student_registration WHERE reg_id='$reg_id' OR reg_id=" . intval($reg_id);
                $result = mysqli_query($conn, $select_sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    // Insert into user if approved
                    if ($status === 'Approved') {
                        $f_name = mysqli_real_escape_string($conn, $row['f_name']);
                        $l_name = mysqli_real_escape_string($conn, $row['l_name']);
                        $contact = mysqli_real_escape_string($conn, $row['contact']);
                        $password = mysqli_real_escape_string($conn, $row['password']);
                        $dob = mysqli_real_escape_string($conn, $row['dob']);
                        $age = mysqli_real_escape_string($conn, $row['age']);
                        $gender = mysqli_real_escape_string($conn, $row['gender']);
                        $type = mysqli_real_escape_string($conn, $row['type']);
                        $profile_pic = mysqli_real_escape_string($conn, $row['profile_pic']);

                        $check_sql = "SELECT * FROM user WHERE contact='$contact'";
                        $check_result = mysqli_query($conn, $check_sql);

                        if (mysqli_num_rows($check_result) == 0) {
                            $insert_sql = "INSERT INTO user (f_name, l_name, contact, password, dob, age, gender, type, profile_pic)
                                           VALUES ('$f_name', '$l_name', '$contact', '$password', '$dob', '$age', '$gender', '$type', '$profile_pic')";
                            mysqli_query($conn, $insert_sql);
                        }
                    }
                }

                echo json_encode(['success' => true, 'status' => $status]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No rows updated']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Query failed: ' . mysqli_error($conn)]);
        }

        exit;
    }
}
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
        .h11 {
            margin-top: 150px;
            margin-bottom: 50px;
            text-align: center;
            color: rgba(10, 135, 129, 1);
            font-weight: bold;
        }

        tr {
            text-align: center;
            vertical-align: middle;
        }

        .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #0a8781;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            display: block;
            margin: 0 auto;
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
</head>

<body>
    <header class="header" id="header">
        <nav class="navbar_custom nav-container">
            <img src="bulogo.png" alt="" class="nav__logo">

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li><a href="officer_dashboard.php" class="nav__link">Dashboard</a></li>
                    <li><a href="officer_std_register_approve.php" class="nav__link">Registration Approve</a></li>
                    <li><a href="data_entry.php" class="nav__link">Data Entry</a></li>
                    <li><a href="data_view.php" class="nav__link">Data View</a></li>
                    <li><a href="notice_review_and_post.php" class="nav__link">Notice Review and Post</a></li>
                </ul>
            </div>

            <div class="nav__actions">
                <a href="homepage.php">
                    <i class="ri-logout-box-r-line" id="login-btn"></i>
                </a>
            </div>
        </nav>
    </header>

    <!--==================== PENDING LIST ====================-->
    <div class="container">
        <h1 class="h11">Student Registration Pending</h1>

        <table class="table table-striped table-hover table-bordered text-center">
            <thead class="table-success">
                <tr>
                    <th>Serial Number</th>
                    <th>Reg ID</th>
                    <th>Full Name</th>
                    <th>Contact</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Type</th>
                    <th>Profile Picture</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="pending">
                <?php
                $sql = "SELECT * FROM student_registration WHERE status='Pending' ORDER BY reg_id ASC";
                $result = mysqli_query($conn, $sql);
                $serial = 1;

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $reg_id = htmlspecialchars($row['reg_id']);
                        $full_name = htmlspecialchars($row['f_name'] . ' ' . $row['l_name']);
                        $contact = htmlspecialchars($row['contact']);
                        $age = htmlspecialchars($row['age']);
                        $gender = htmlspecialchars($row['gender']);
                        $type = htmlspecialchars($row['type']);
                        $status = htmlspecialchars($row['status']);
                        $profile_pic = htmlspecialchars($row['profile_pic']);

                        echo "<tr>
                            <td>{$serial}</td>
                            <td>{$reg_id}</td>
                            <td>{$full_name}</td>
                            <td>{$contact}</td>
                            <td>{$age}</td>
                            <td>{$gender}</td>
                            <td>{$type}</td>
                            <td><img src='{$profile_pic}' class='profile-pic' alt='Profile'></td>
                            <td>{$status}</td>
                            <td>
                                <button class='btn btn-success btn-sm me-1' onclick=\"updateStatus('{$reg_id}','approve',this)\">Approve</button>
                                <button class='btn btn-danger btn-sm' onclick=\"updateStatus('{$reg_id}','reject',this)\">Reject</button>
                            </td>
                        </tr>";
                        $serial++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!--==================== APPROVED LIST ====================-->
    <div class="container">
        <h1 class="h11">Student Registration Approved</h1>

        <table class="table table-striped table-hover table-bordered text-center">
            <thead class="table-success">
                <tr>
                    <th>Serial Number</th>
                    <th>Reg ID</th>
                    <th>Full Name</th>
                    <th>Contact</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Type</th>
                    <th>Profile Picture</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="approved">
                <?php
                $sql = "SELECT * FROM student_registration WHERE status='Approved' ORDER BY reg_id ASC";
                $result = mysqli_query($conn, $sql);
                $serial = 1;

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $reg_id = htmlspecialchars($row['reg_id']);
                        $full_name = htmlspecialchars($row['f_name'] . ' ' . $row['l_name']);
                        $contact = htmlspecialchars($row['contact']);
                        $age = htmlspecialchars($row['age']);
                        $gender = htmlspecialchars($row['gender']);
                        $type = htmlspecialchars($row['type']);
                        $status = htmlspecialchars($row['status']);
                        $profile_pic = htmlspecialchars($row['profile_pic']);

                        echo "<tr>
                            <td>{$serial}</td>
                            <td>{$reg_id}</td>
                            <td>{$full_name}</td>
                            <td>{$contact}</td>
                            <td>{$age}</td>
                            <td>{$gender}</td>
                            <td>{$type}</td>
                            <td><img src='{$profile_pic}' class='profile-pic'></td>
                            <td>{$status}</td>
                        </tr>";
                        $serial++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!--==================== REJECTED LIST ====================-->
    <div class="container">
        <h1 class="h11">Student Registration Rejected</h1>

        <table class="table table-striped table-hover table-bordered text-center">
            <thead class="table-success">
                <tr>
                    <th>Serial Number</th>
                    <th>Reg ID</th>
                    <th>Full Name</th>
                    <th>Contact</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Type</th>
                    <th>Profile Picture</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="rejected">
                <?php
                $sql = "SELECT * FROM student_registration WHERE status='Rejected' ORDER BY reg_id ASC";
                $result = mysqli_query($conn, $sql);
                $serial = 1;

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $reg_id = htmlspecialchars($row['reg_id']);
                        $full_name = htmlspecialchars($row['f_name'] . ' ' . $row['l_name']);
                        $contact = htmlspecialchars($row['contact']);
                        $age = htmlspecialchars($row['age']);
                        $gender = htmlspecialchars($row['gender']);
                        $type = htmlspecialchars($row['type']);
                        $status = htmlspecialchars($row['status']);
                        $profile_pic = htmlspecialchars($row['profile_pic']);

                        echo "<tr>
                            <td>{$serial}</td>
                            <td>{$reg_id}</td>
                            <td>{$full_name}</td>
                            <td>{$contact}</td>
                            <td>{$age}</td>
                            <td>{$gender}</td>
                            <td>{$type}</td>
                            <td><img src='{$profile_pic}' class='profile-pic'></td>
                            <td>{$status}</td>
                        </tr>";
                        $serial++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function updateStatus(regId, action, btn) {
            fetch("", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `ajax=1&reg_id=${encodeURIComponent(regId)}&action=${encodeURIComponent(action)}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    let row = btn.closest("tr");
                    row.querySelector("td:nth-child(9)").innerText = data.status;
                    row.querySelector("td:nth-child(10)").innerHTML = "";

                    if (data.status === "Approved") {
                        document.querySelector("#approved").appendChild(row);
                    } else if (data.status === "Rejected") {
                        document.querySelector("#rejected").appendChild(row);
                    }
                } else {
                    alert("Failed to update status.");
                }
            })
            .catch(err => console.error(err));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
