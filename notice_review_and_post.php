<?php
include 'db.php'; // Make sure this file contains your DB connection
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" />
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>BU Tech 360 - Notice Review</title>
  <style>
    h3 { 
      text-align: center; 
    }

    a { 
      text-decoration: none; 
    }

    tr { 
      text-align: center; 
    }

    .textbold { 
      font-weight: bold; 
      color: rgba(10, 135, 129, 1);
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
                    <li class="nav__item"><a href="data_entry.php" class="nav__link">Data Entry</a></li>
                    <li class="nav__item"><a href="data_view.php" class="nav__link">Data View</a></li>
                    <li class="nav__item"><a href="notice_review_and_post.php" class="nav__link">Notice Review</a></li>
                </ul>
            </div>
            <div class="nav__actions">
                <div class="nav__toggle" id="nav-toggle"><i class="ri-menu-line"></i></div>
                <a href="homepage.php"><i class="ri-logout-box-r-line" id="login-btn"></i></a>
            </div>
        </nav>
    </header>

    <section style="margin-top: 150px;">
        <h3 class="textbold">Notice Review Request</h3>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Posted By</th>
                    <th>Priority</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT notice_review_id, title, content, posted_by, priority_level FROM notice_review";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    $i = 1;
                    while ($info = mysqli_fetch_assoc($query)) {
                        echo "<tr>
                                <th scope='row'>{$i}</th>
                                <td>{$info['notice_review_id']}</td>
                                <td>{$info['title']}</td>
                                <td>{$info['content']}</td>
                                <td>{$info['posted_by']}</td>
                                <td>{$info['priority_level']}</td>
                              </tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='6'>No notices found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Add Notice Form -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Add New Notice</h3>
                        <form class="row g-3" action="officer_notice_review_connect_2.php" method="post">
                            <div class="col-md-4">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" required />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Priority Level</label>
                                <select class="form-select" name="priority_level" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="high">High</option>
                                    <option value="mid">Mid</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Posted By</label>
                                <input type="text" class="form-control" name="posted_by" required />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Content</label>
                                <textarea class="form-control" name="content" rows="4" required></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Notice Form -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Delete Notice</h3>
                        <form class="row g-3" action="officer_notice_review_delete_data.php" method="post">
                            <div class="col-md-6">
                                <label class="form-label">Notice ID</label>
                                <input type="number" class="form-control" name="ID" required />
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" required>
                                    <label class="form-check-label">Are you sure you want to delete?</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="data_entry.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
