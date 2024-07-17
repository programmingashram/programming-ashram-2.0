<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Course Details</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<header >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-2 text-center">
                            <p class="h6 mb-0 text-light">Want to launch innovative new courses – <a href="#" class=" text-light">We’ll Show You.</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary p-2">
            <div class="container-fluid justify-content-between">
                <a class="navbar-brand d-flex gap-3 align-items-center" href="#">
                    <img src="./assets/Gold_Luxury_Initial_Circle_Logo-removebg-preview.png" alt="" class="logo">
                    <h6 class="mb-0"><span class="green-text">Programming</span> Ashram</h6>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse w-100" id="navbarNav">
                    <ul class="navbar-nav justify-content-center w-100">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Classes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Feeds</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                
                <div class="navigation-button w-100 text-end">
                    <?php
                    session_start();
                    if (isset($_SESSION['id'])) {
                        // Display user's profile and name
                        echo '<div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ' . $_SESSION['username'] . '
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Profile</a>
                                    <a class="dropdown-item" href="#">Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </div>
                            </div>';
                    } else {
                        // Display login or signup button if user is not logged in
                        echo '<a href="user-login.php" class="btn-green text-decoration-none">Get Started</a>';
                    }

                    ?>
                </div>
            </div>
        </nav>
 
    <div class="container mt-5">
        <?php
        session_start();
        include 'config.php';
        $course_id = $_GET['id'];
        $sql = "SELECT * FROM courses WHERE id=$course_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '
                <div class="mb-3">
                    <img src="'. $row["image"] .'" class="card-img-top" alt="'. $row["title"] .'">
                    <div class="card-body">
                        <div class="d-flex position-relative course-details justify-content-between align-items-center shadow p-3 bg-light-green">
                            <div class="d-flex gap-3 w-100 my-4">
                                <div class="profile">
                                    <h5><b>Mentor</b></h5>
                                    <p> '. $row["mentors"] .'</p>
                                </div>
                                <div class="profile">
                                    <h5><b>Curriculum</b></h5>
                                    <p>0</p>
                                </div>
                                <div class="profile">
                                    <h5><b>Duration</b></h5>
                                     <p>'. $row["duration"] .'</p>
                                </div>
                                <div class="profile">
                                    <h5><b>Reviews</b></h5>
                                    <p>0</p>
                                </div>
                            </div>
                             <div class="d-flex gap-3 w-100 my-4 justify-content-end">
                                <div class="profile text-end">
                                     <a href="#" class="btn-green text-decoration-none">Enroll Now</a>
                                </div>
                            </div>
                        </div>
                         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#about-course" type="button" role="tab" aria-controls="pills-home" aria-selected="true">About Course</button>
                            </li>
                             <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#objectives" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Course Objectives</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#mentor" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Mentor</button>
                            </li>
                             
                        </ul>
                        <hr>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="about-course" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                <h4>About Course</h4>
                                <p class="card-text">'. $row["details"] .'</p>
                            </div>
                            <div class="tab-pane fade" id="objectives" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                <p> '. $row["wylearn"] .'</p>
                            </div>
                            <div class="tab-pane fade" id="mentor" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                <p> '. $row["mentors"] .'</p>
                            </div>
                            
                        </div>
                       
                        <a href="index.php" class="btn btn-secondary mt-5">Back to Course Listing</a>';
                if (isset($_SESSION['user_id'])) {
                    echo '<a href="enroll.php?course_id='. $row["id"] .'" class="btn btn-primary ms-5 mt-5">Enroll</a>';
                }
                echo '</div></div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<!-- // <p class="card-text"><small class="text-muted">Date: '. date("d M, Y", strtotime($row["date"])) .'</small></p>
                        // <p class="card-text"><small class="text-muted">Curriculum Count: '. $row["curriculum_count"] .'</small></p>
                        // <p class="card-text"><small class="text-muted">Student Count: '. $row["student_count"] .'</small></p> -->