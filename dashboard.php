<?php
session_start();
include 'config.php';  // Include your database connection here

// Ensure $conn is defined properly in config.php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user profile information
$user_sql = "SELECT username, email, profile_image FROM users WHERE id = $user_id";
$user_result = $conn->query($user_sql);

if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $username = $user_row['username'];
    $email = $user_row['email'];
    $profile_image = $user_row['profile_image'];
} else {
    // Handle case where user profile is not found (as per your application logic)
    $username = 'User';
    $email = 'user@example.com';
    $profile_image = 'default_profile.jpg'; // Provide a default image path
}

// Fetch enrolled courses
$course_sql = "SELECT c.id as course_id, c.title, c.description, c.image, uc.status, uc.progress
              FROM courses c
              JOIN user_courses uc ON c.id = uc.course_id
              WHERE uc.user_id = $user_id";
$result = $conn->query($course_sql);

// Fetch attendance data
$attendance_sql = "SELECT a.date, a.status, c.title 
                   FROM attendance a
                   JOIN courses c ON a.course_id = c.id
                   WHERE a.user_id = $user_id";
$attendance_result = $conn->query($attendance_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <title>Student Dashboard</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .container-fluid {
            flex: 1;
        }
        .stepper {
            display: flex;
            flex-direction: column;
        }
        .stepper-step {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .stepper-step .stepper-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ddd;
            text-align: center;
            line-height: 30px;
            margin-right: 10px;
        }
        .stepper-step.completed .stepper-circle {
            background-color: #28a745;
            color: #fff;
        }
        .stepper-step.pending .stepper-circle {
            background-color: orange;
            color: #fff;
        }
        .sidebar{
            height:100vh;
            overflow-y:auto;
        }
    </style>
</head>
<body class='dashboard'>
    <nav class="navbar dashboard-nav navbar-expand-lg py-3 px-4 border-3 border-bottom border-light">
        <a class="navbar-brand text-light" href="#">Student Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href='index.php' class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar border-3 border-end border-light">
                <div class="text-center my-4">
                    <img src="./uploads/<?php echo $profile_image; ?>" class="rounded-circle profile-image p-1" alt="<?php echo $username; ?>" width="80">
                    <h5 class="mt-2 profile-name text-light"><?php echo $username; ?></h5>
                </div>
                <div class="sidebar-sticky mt-4">
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item my-2">
                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">
                                <i class="bi bi-house-door"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item my-2">
                            <a class="nav-link" id="attendance-tab" data-bs-toggle="tab" href="#attendance" role="tab" aria-controls="attendance" aria-selected="false">
                                <i class="bi bi-journal-richtext"></i>
                                Attendance
                            </a>
                        </li>
                        <li class="nav-item my-2">
                            <a class="nav-link" id="quizzes-tab" data-bs-toggle="tab" href="#quizzes" role="tab" aria-controls="quizzes" aria-selected="false">
                                <i class="bi bi-card-list"></i>
                                Quizzes
                            </a>
                        </li>
                        <li class="nav-item my-2">
                            <a class="nav-link" id="courses-tab" data-bs-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">
                                <i class="bi bi-file-earmark"></i>
                                Courses
                            </a>
                        </li>
                        <li class="nav-item my-2">
                            <a class="nav-link" id="certificates-tab" data-bs-toggle="tab" href="#certificates" role="tab" aria-controls="certificates" aria-selected="false">
                                <i class="bi bi-award"></i>
                                Certificates
                            </a>
                        </li>
                        <li class="nav-item my-2">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                <i class="bi bi-person"></i>
                                Profile
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 bg-success-subtle">
                <div class="tab-content">
                    <div class="tab-pane active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                       <h3 class="mt-4">Dashboard</h3>
                       <article class="mt-5 py-5 bg-light-green rounded-2 shadow-sm">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="catergories-heading">
                            <h2 class="font-68">Explore <span class="green-text"><u>Winnings</u></span></h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="heading-corner text-end">
                            <a href="#" class="btn-green text-decoration-none">Ashram Support !</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="catregories-card card p-3 mt-4" id="courses-tab" data-bs-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">
                            <i class="bi bi-journal-bookmark-fill" style="font-size: 2rem;"></i>
                            <div class="card-title mt-2"><h4>Enrolled Courses</h4></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="catregories-card card p-3 mt-4">
                            <i class="bi bi-calendar-check-fill" style="font-size: 2rem;"></i>
                            <div class="card-title mt-2"><h4>Attendance</h4></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="catregories-card card p-3 mt-4">
                            <i class="bi bi-book-half" style="font-size: 2rem;"></i>
                            <div class="card-title mt-2"><h4>Lesson Plans</h4></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="catregories-card card p-3 mt-4">
                            <i class="bi bi-gem" style="font-size: 2rem;"></i>
                            <div class="card-title mt-2"><h4>Achievements</h4></div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
                    </div>

                    <div class="tab-pane" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                        <h3 class="mt-4">Attendance</h3>
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($attendance_result->num_rows > 0) {
                                    while ($row = $attendance_result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . ucfirst($row['status']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No attendance records found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="quizzes" role="tabpanel" aria-labelledby="quizzes-tab">
                        <h3 class="mt-4">Quizzes</h3>
                        <p>Quizzes content goes here.</p>
                    </div>

                    <div class="tab-pane" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                        <h3 class="mt-4">Courses</h3>
                        <div class="row">
                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $course_id = $row["course_id"];
                                    $description = implode(' ', array_slice(explode(' ', $row["description"]), 0, 8)) . '...';
                                    echo '
                                    <div class="col-md-3">
                                        <div class="card mb-4 shadow-sm">
                                            <img src="'. $row["image"] .'" class="card-img-top" alt="'. $row["title"] .'">
                                            <div class="card-body">
                                                <h5 class="card-title">'. $row["title"] .'</h5>
                                                <p class="card-text">'. $description .'</p>
                                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseCourse'. $course_id .'" role="button" aria-expanded="false" aria-controls="collapseCourse'. $course_id .'">
                                                   Check Status
                                                </a>
                                                <div class="collapse mt-2" id="collapseCourse'. $course_id .'">
                                                    <h5 class="my-4">Course Status</h5>
                                                    <div class="stepper">';
                                    
                                                $lessons_sql = "SELECT * FROM lessons WHERE course_id = $course_id";
                                                $lessons_result = $conn->query($lessons_sql);
                                                
                                                if ($lessons_result->num_rows > 0) {
                                                    while($lesson = $lessons_result->fetch_assoc()) {
                                                        $lesson_status = $lesson["status"] == 'completed' ? 'completed' : 'pending';
                                                        echo '
                                                    
                                                        <div class="stepper-step '. $lesson_status .'">
                                                            <div class="stepper-circle">'. ($lesson["status"] == 'completed' ? '<i class="bi bi-check"></i>' : '') .'</div>
                                                            <div class="stepper-info">
                                                                <p class="mb-0">'. $lesson["title"] .'</p>
                                                            </div>
                                                        </div>';
                                                    }
                                                } else {
                                                    echo '<p>No lessons found for this course.</p>';
                                                }
                                                
                                                echo '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<p>You are not enrolled in any courses.</p>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="tab-pane" id="certificates" role="tabpanel" aria-labelledby="certificates-tab">
                        <h3 class="mt-4">Certificates</h3>
                        <p>Certificates content goes here.</p>
                    </div>

                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h3 class="mt-4">Profile</h3>
                        <p>Profile content goes here.</p>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <footer class="mt-auto text-center py-3 bg-dark text-white">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> Programming Ashram. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
