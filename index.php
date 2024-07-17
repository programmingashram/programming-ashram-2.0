<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Programming Ashram</title>
        <link rel="stylesheet" href="./style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
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
                        <li class="nav-item">
                            <a href='dashboard.php' class="nav-link" href="#">Dashboard</a>
                        </li>
                    </ul>
                </div>
                
                <div class="navigation-button w-100 text-end">
                <?php
                    session_start();
                    if (isset($_SESSION['id'])) {
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
                        echo '<a href="user-login.php" class="btn-green text-decoration-none">Get Started</a>';
                    }
                ?>
                </div>
            </div>
        </nav>

          <main class="bg-texteure">
            <section class="bg-overly">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="p-2">
                                <img src="./assets/AdobeStock_545875468@2x-1.webp" alt="" class="w-100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-2 text-center text-light">
                                <div class="middile-header mb-3"><span>Programming Ashram With </span></div>
                                <h1 class="f-c">Top notch Education & Research </h1>
                                <p>
                                    Consectetur a erat nam at. Facilisis magna etiam tempor orci. Sem et tortor consequat id. Fermentum egestas tellus. Nunc eu hendrerit turpis. Fusce non lectus sem.
                                </p>
                                <!-- <div class="main-btn">
                                    <a href="#" class="btn-green-light text-decoration-none">Watch Free Demo Class</a>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-3 d">
                            <div class="p-2">
                                 <img src="./assets/AdobeStock_587433154-1.webp" alt="" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div class="mentor-heightlight shadow-lg  position-relative p-2 border-2 border-secondary rounded-3 bg-light text-dark m-auto">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <img src="./assets/96954293.png" alt="" class="rounded-3 mentor-profile-img shadow-lg my-2">
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Sr. Engr. Ayushman Chaurasiya</h5>
                                        <p class="rounded-5 max-auto border px-2 py-1 w-auto text-center border-danger text-danger mt-2 mb-0">Mentor</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="row align-items-center">
                                    <div class=" col-md-4">
                                        <h5 class="my-3">Designation </h5>
                                        <p class="text-secondary">Full Stack Developer</p>
                                     </div>
                                     <div class=" col-md-4">
                                        <h5  class="my-3">Experience  </h5>
                                        <p class="text-secondary">5 Years ++</p>
                                     </div>
                                     <div class=" col-md-4 mb-4">
                                        <a href="#" class="btn-green text-decoration-none">Veiw Profile</a>
                                     </div>
                               </div>
                            </div>
                       </div>
                    </div>
                </div>
            </section>
          </main>

          <article class="mt-4 py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-4">
                            <div class="galert-image">
                                <img src="./assets/New-Rectangle-2.jpg" alt="" class="w-100 rounded-3 mb-4">
                                <img src="./assets/Vector-1.2.webp" alt="" class="w-100 rounded-3 border border-secondary">
                            </div>
                            <div class="galert-image">
                                <img src="./assets/New-Rectangle-4.jpg" alt="" class="w-100 rounded-3 mb-4">
                                <img src="./assets/New-Rectangle-4.jpg" alt="" class="w-100 rounded-3">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                       <div class="p-3">
                            <h2 class="font-68">Expertise Across <span class="green-text"><u>All Disciplines</u></span></h2>
                            <p>
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Distinctio, reprehenderit qui dolores assumenda provident quas eum earum fugiat reiciendis,
                            </p>
                            <div class="mt-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="content-tile d-flex gap-2">
                                            <span class="w-25"><i><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 65.1 60" style="enable-background:new 0 0 65.1 60;" xml:space="preserve"><g>	<path d="M19,55H6c-0.6,0-1-0.5-1-1l0,0V7.8c0-0.6,0.5-1,1-1l0,0h13c0.6,0,1,0.5,1,1V54C20.1,54.5,19.6,55,19,55   M7.1,53h11V8.8h-11V53z"></path>	<path d="M15.1,48.6H9.9c-0.6,0-1-0.5-1-1.1c0-0.5,0.5-1,1-1h5.3c0.6,0,1,0.5,1,1.1  C16.1,48.2,15.7,48.6,15.1,48.6"></path>	<path d="M31.9,55h-13c-0.6,0-1-0.5-1-1c0,0,0,0,0,0V7.8c0-0.6,0.5-1,1-1c0,0,0,0,0,0h13c0.6,0,1,0.5,1,1  c0,0,0,0,0,0V54C32.9,54.5,32.4,55,31.9,55C31.9,55,31.9,55,31.9,55 M19.9,53h11V8.8h-11V53z"></path>	<path d="M28,48.6h-5.3c-0.6,0-1-0.5-1-1.1c0-0.5,0.5-1,1-1H28c0.6,0,1,0.5,1,1.1C29,48.2,28.5,48.6,28,48.6"></path>	<path d="M46.8,55c-0.4,0-0.8-0.3-1-0.7L30.9,10.6C30.7,10,31,9.4,31.5,9.3l12.3-4.2c0.5-0.2,1.1,0.1,1.3,0.6  c0,0,0,0,0,0l14.9,43.8c0.2,0.5-0.1,1.1-0.6,1.3l-12.3,4.2C47,55,46.9,55,46.8,55 M33.2,10.9l14.3,41.8l10.4-3.5L43.5,7.3  L33.2,10.9z"></path>	<path d="M48.4,47.7c-0.6,0-1-0.5-1-1c0-0.4,0.3-0.8,0.7-1l5-1.7c0.5-0.2,1.1,0.1,1.3,0.7  c0.2,0.5-0.1,1.1-0.6,1.3l-5,1.7C48.6,47.7,48.5,47.7,48.4,47.7"></path></g></svg></i></span>
                                            <div class="tile-data">
                                                <div class='font-45 green-text'><h1><strong>70M</strong></h1></div>
                                                <p>Et sollicitudin ac orci phasellus.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="content-tile d-flex gap-2">
                                            <span class="w-25"><i><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 65.1 60" style="enable-background:new 0 0 65.1 60;" xml:space="preserve"><g>	<path d="M19,55H6c-0.6,0-1-0.5-1-1l0,0V7.8c0-0.6,0.5-1,1-1l0,0h13c0.6,0,1,0.5,1,1V54C20.1,54.5,19.6,55,19,55   M7.1,53h11V8.8h-11V53z"></path>	<path d="M15.1,48.6H9.9c-0.6,0-1-0.5-1-1.1c0-0.5,0.5-1,1-1h5.3c0.6,0,1,0.5,1,1.1  C16.1,48.2,15.7,48.6,15.1,48.6"></path>	<path d="M31.9,55h-13c-0.6,0-1-0.5-1-1c0,0,0,0,0,0V7.8c0-0.6,0.5-1,1-1c0,0,0,0,0,0h13c0.6,0,1,0.5,1,1  c0,0,0,0,0,0V54C32.9,54.5,32.4,55,31.9,55C31.9,55,31.9,55,31.9,55 M19.9,53h11V8.8h-11V53z"></path>	<path d="M28,48.6h-5.3c-0.6,0-1-0.5-1-1.1c0-0.5,0.5-1,1-1H28c0.6,0,1,0.5,1,1.1C29,48.2,28.5,48.6,28,48.6"></path>	<path d="M46.8,55c-0.4,0-0.8-0.3-1-0.7L30.9,10.6C30.7,10,31,9.4,31.5,9.3l12.3-4.2c0.5-0.2,1.1,0.1,1.3,0.6  c0,0,0,0,0,0l14.9,43.8c0.2,0.5-0.1,1.1-0.6,1.3l-12.3,4.2C47,55,46.9,55,46.8,55 M33.2,10.9l14.3,41.8l10.4-3.5L43.5,7.3  L33.2,10.9z"></path>	<path d="M48.4,47.7c-0.6,0-1-0.5-1-1c0-0.4,0.3-0.8,0.7-1l5-1.7c0.5-0.2,1.1,0.1,1.3,0.7  c0.2,0.5-0.1,1.1-0.6,1.3l-5,1.7C48.6,47.7,48.5,47.7,48.4,47.7"></path></g></svg></i></span>
                                            <div class="tile-data">
                                                <div class='font-45 green-text'><h1><strong>70M</strong></h1></div>
                                                <p>Et sollicitudin ac orci phasellus.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="content-tile d-flex gap-2">
                                            <span class="w-25"><i><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 65.1 60" style="enable-background:new 0 0 65.1 60;" xml:space="preserve"><g>	<path d="M19,55H6c-0.6,0-1-0.5-1-1l0,0V7.8c0-0.6,0.5-1,1-1l0,0h13c0.6,0,1,0.5,1,1V54C20.1,54.5,19.6,55,19,55   M7.1,53h11V8.8h-11V53z"></path>	<path d="M15.1,48.6H9.9c-0.6,0-1-0.5-1-1.1c0-0.5,0.5-1,1-1h5.3c0.6,0,1,0.5,1,1.1  C16.1,48.2,15.7,48.6,15.1,48.6"></path>	<path d="M31.9,55h-13c-0.6,0-1-0.5-1-1c0,0,0,0,0,0V7.8c0-0.6,0.5-1,1-1c0,0,0,0,0,0h13c0.6,0,1,0.5,1,1  c0,0,0,0,0,0V54C32.9,54.5,32.4,55,31.9,55C31.9,55,31.9,55,31.9,55 M19.9,53h11V8.8h-11V53z"></path>	<path d="M28,48.6h-5.3c-0.6,0-1-0.5-1-1.1c0-0.5,0.5-1,1-1H28c0.6,0,1,0.5,1,1.1C29,48.2,28.5,48.6,28,48.6"></path>	<path d="M46.8,55c-0.4,0-0.8-0.3-1-0.7L30.9,10.6C30.7,10,31,9.4,31.5,9.3l12.3-4.2c0.5-0.2,1.1,0.1,1.3,0.6  c0,0,0,0,0,0l14.9,43.8c0.2,0.5-0.1,1.1-0.6,1.3l-12.3,4.2C47,55,46.9,55,46.8,55 M33.2,10.9l14.3,41.8l10.4-3.5L43.5,7.3  L33.2,10.9z"></path>	<path d="M48.4,47.7c-0.6,0-1-0.5-1-1c0-0.4,0.3-0.8,0.7-1l5-1.7c0.5-0.2,1.1,0.1,1.3,0.7  c0.2,0.5-0.1,1.1-0.6,1.3l-5,1.7C48.6,47.7,48.5,47.7,48.4,47.7"></path></g></svg></i></span>
                                            <div class="tile-data">
                                                <div class='font-45 green-text'><h1><strong>70M</strong></h1></div>
                                                <p>Et sollicitudin ac orci phasellus.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="content-tile d-flex gap-2">
                                            <span class="w-25"><i><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 65.1 60" style="enable-background:new 0 0 65.1 60;" xml:space="preserve"><g>	<path d="M19,55H6c-0.6,0-1-0.5-1-1l0,0V7.8c0-0.6,0.5-1,1-1l0,0h13c0.6,0,1,0.5,1,1V54C20.1,54.5,19.6,55,19,55   M7.1,53h11V8.8h-11V53z"></path>	<path d="M15.1,48.6H9.9c-0.6,0-1-0.5-1-1.1c0-0.5,0.5-1,1-1h5.3c0.6,0,1,0.5,1,1.1  C16.1,48.2,15.7,48.6,15.1,48.6"></path>	<path d="M31.9,55h-13c-0.6,0-1-0.5-1-1c0,0,0,0,0,0V7.8c0-0.6,0.5-1,1-1c0,0,0,0,0,0h13c0.6,0,1,0.5,1,1  c0,0,0,0,0,0V54C32.9,54.5,32.4,55,31.9,55C31.9,55,31.9,55,31.9,55 M19.9,53h11V8.8h-11V53z"></path>	<path d="M28,48.6h-5.3c-0.6,0-1-0.5-1-1.1c0-0.5,0.5-1,1-1H28c0.6,0,1,0.5,1,1.1C29,48.2,28.5,48.6,28,48.6"></path>	<path d="M46.8,55c-0.4,0-0.8-0.3-1-0.7L30.9,10.6C30.7,10,31,9.4,31.5,9.3l12.3-4.2c0.5-0.2,1.1,0.1,1.3,0.6  c0,0,0,0,0,0l14.9,43.8c0.2,0.5-0.1,1.1-0.6,1.3l-12.3,4.2C47,55,46.9,55,46.8,55 M33.2,10.9l14.3,41.8l10.4-3.5L43.5,7.3  L33.2,10.9z"></path>	<path d="M48.4,47.7c-0.6,0-1-0.5-1-1c0-0.4,0.3-0.8,0.7-1l5-1.7c0.5-0.2,1.1,0.1,1.3,0.7  c0.2,0.5-0.1,1.1-0.6,1.3l-5,1.7C48.6,47.7,48.5,47.7,48.4,47.7"></path></g></svg></i></span>
                                            <div class="tile-data">
                                                <div class='font-45 green-text'><h1><strong>70M</strong></h1></div>
                                                <p>Et sollicitudin ac orci phasellus.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="#" class="btn-green text-decoration-none">Learn More</a>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
          </article>
          
          <article class="mt-5 py-5 bg-light-green">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="catergories-heading">
                            <h2 class="font-68">Explore Top Courses <span class="green-text"><u>Categories</u></span></h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="heading-corner text-end">
                            <a href="#" class="btn-green text-decoration-none">Browse all categories</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="catregories-card card p-3 mt-4">
                            <img src="https://lizza.wpengine.com/lms/wp-content/uploads/sites/12/2024/02/Categorey-Icon-1.svg" alt="" class="w-25">
                            <div class="card-title mt-2"><h4>Design</h4></div>
                            <p>1 Courses(s)</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="catregories-card card p-3 mt-4">
                            <img src="https://lizza.wpengine.com/lms/wp-content/uploads/sites/12/2024/02/Categorey-Icon-1.svg" alt="" class="w-25">
                            <div class="card-title mt-2"><h4>UI Devlopment</h4></div>
                            <p>1 Courses(s)</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="catregories-card card p-3 mt-4">
                            <img src="https://lizza.wpengine.com/lms/wp-content/uploads/sites/12/2024/02/Categorey-Icon-1.svg" alt="" class="w-25">
                            <div class="card-title mt-2"><h4>Python</h4></div>
                            <p>1 Courses(s)</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="catregories-card card p-3 mt-4">
                            <img src="https://lizza.wpengine.com/lms/wp-content/uploads/sites/12/2024/02/Categorey-Icon-2.svg" alt="" class="w-25">
                            <div class="card-title mt-2"><h4>Marketing</h4></div>
                            <p>1 Courses(s)</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="catregories-card card p-3 mt-4">
                            <img src="https://lizza.wpengine.com/lms/wp-content/uploads/sites/12/2024/02/Categorey-Icon-8.svg" alt="" class="w-25">
                            <div class="card-title mt-2"><h4>Basics Of Computers</h4></div>
                            <p>1 Courses(s)</p>
                        </div>
                    </div>
                </div>
            </div>
          </article>
          <article class="mt-5 py-5">
            <div class="col-md-12">
                <div class="text-center w-75 m-auto">
                    <h2 class="font-68">View Our <span class="green-text"> <u>Course Offerings</u> </span>And Our Planned Fee Schedule</h2>
                </div>
                <div class="mt-5 text-center">
                    <a href="#" class="btn-green text-decoration-none">Ask with mentor</a>
                </div>
            </div>
          </article>
          <article class="mt-5 py-5 bg-light-green">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="text-center w-75 m-auto">
                            <h2 class="font-68">Browse Our <span class="green-text"><u>Course</u></span> Catalog</h2>
                            <p>
                                Nullam eleifend metus ipsum, at ornare odio vehicula in. Pellentesque condimentum ntum vehicula.Nulla convallis enim eu velit commodo condimentum.
                            </p>
                        </div>
                    </div>
                    

                    <?php
                        include 'config.php';
                        $sql = "SELECT * FROM courses";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $description = implode(' ', array_slice(explode(' ', $row["description"]), 0, 16)) . '...';
                                echo '
                                <div class="col-md-4">
                                    <div class="card course-card mb-3 bg-light">
                                        <img src="'. $row["image"] .'" class="card-img-top" alt="'. $row["title"] .'">
                                        <div class="d-flex px-3 mt-3 justify-content-between">
                                            <p class="f-12">'. date("d M, Y", strtotime($row["date"])) .'</p>
                                            <p class="f-12">'. $row["curriculum_count"] .' Curriculum</p>
                                            <p class="f-12">'. $row["student_count"] .' Students</p>
                                        </div>
                                        <h5 class="card-title px-3 pt-2 mb-0 fs-5">'. $row["title"] .'</h5>
                                        <div class="card-body px-3 pt-1 mb-0 f-12">
                                            <p>'. $description .'</p>
                                            <a href="course.php?id='. $row["id"] .'" class="btn-green text-decoration-none">View Details</a>
                                        </div>
                                    </div>
                                </div>';
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                        ?>

                    <div class="col-md-12">
                        <div class="mt-3 text-center">
                            <a href="#" class="btn-green text-decoration-none">View All Courses</a>
                        </div>
                    </div>
                </div>
            </div>
          </article>
    </body>
</html>