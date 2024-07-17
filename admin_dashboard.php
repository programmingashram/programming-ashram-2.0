<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

// Initialize variables for success and error messages
$success = $error = "";

// Handling course addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_course'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $details = $_POST['details'];
    $mentors = $_POST['mentors'];
    $duration = $_POST['duration'];
    $wylearn = $_POST['wylearn'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $error = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) { // 500KB limit
        $error = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // File is uploaded successfully
            $image = $target_file;
            $sql = "INSERT INTO courses (title, description, details, image, mentors, duration, wylearn) VALUES ('$title', '$description', '$details', '$image', '$mentors', '$duration', '$wylearn')";
            if ($conn->query($sql) === TRUE) {
                $success = "Course added successfully";
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }
}

// Handling course update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_course'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $details = $_POST['details'];

    // Handle image upload
    $image = $_POST['existing_image'];
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 500000) {
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1 && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
        }
    }

    $sql = "UPDATE courses SET title='$title', description='$description', details='$details', image='$image' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $success = "Course updated successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handling course deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM courses WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $success = "Course deleted successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handling lesson addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_lesson'])) {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $status = $_POST['status'];

    $insert_sql = "INSERT INTO lessons (course_id, title, status) VALUES ('$course_id', '$title', '$status')";

    if ($conn->query($insert_sql) === TRUE) {
        $success = "Lesson added successfully";
    } else {
        $error = "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

// Handling lesson update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_lesson'])) {
    $lesson_id = $_POST['lesson_id'];
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $status = $_POST['status'];

    $update_sql = "UPDATE lessons SET course_id='$course_id', title='$title', status='$status' WHERE id=$lesson_id";

    if ($conn->query($update_sql) === TRUE) {
        $success = "Lesson updated successfully";
    } else {
        $error = "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

// Handling lesson deletion
if (isset($_GET['delete_lesson'])) {
    $lesson_id = $_GET['delete_lesson'];
    $sql = "DELETE FROM lessons WHERE id=$lesson_id";
    if ($conn->query($sql) === TRUE) {
        $success = "Lesson deleted successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Handling attendance addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_attendance'])) {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $lesson_id = $_POST['lesson_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO attendance (student_id, course_id, lesson_id, date, status) VALUES ('$student_id', '$course_id', '$lesson_id', '$date', '$status')";
    if ($conn->query($sql) === TRUE) {
        $success = "Attendance record added successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch users
$sql_users = "SELECT * FROM users";
$result_users = $conn->query($sql_users);
$users = [];
if ($result_users->num_rows > 0) {
    while ($row = $result_users->fetch_assoc()) {
        $users[] = $row;
    }
}

// Fetch courses
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
$courses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

// Fetch lessons
$sql_lessons = "SELECT l.*, c.title as course_title FROM lessons l JOIN courses c ON l.course_id = c.id";
$result_lessons = $conn->query($sql_lessons);
$lessons = [];
if ($result_lessons->num_rows > 0) {
    while ($row = $result_lessons->fetch_assoc()) {
        $lessons[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container-fluid mt-5">
        <h2>Admin Dashboard</h2>
        <?php if (!empty($success)) { echo '<div class="alert alert-success">' . $success . '</div>'; } ?>
        <?php if (!empty($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>

        <!-- Add Course Form -->
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="details">Details</label>
                <textarea class="form-control" id="details" name="details" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="duration">Course Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" required>
            </div>
            <div class="form-group">
                <label for="mentors">Mentors</label>
                <textarea class="form-control" id="mentors" name="mentors" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="wylearn">What you will Learn</label>
                <textarea class="form-control" id="wylearn" name="wylearn" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Course Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_course">Add Course</button>
        </form>

        <hr>

        <!-- Manage Courses Table -->
        <h3 class="mt-5">Manage Courses</h3>
        <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Duration</th>
                    <th>Image</th>
                    <th>Mentor</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course) { ?>
                <tr>
                    <td><?php echo $course['id']; ?></td>
                    <td><?php echo $course['title']; ?></td>
                    <td><?php echo $course['description']; ?></td>
                    <td><?php echo $course['details']; ?></td>
                    <td><?php echo $course['duration']; ?></td>
                    <td><img src="<?php echo $course['image']; ?>" alt="Course Image" width="100"></td>
                    <td><?php echo $course['mentors']; ?></td>
                    <td style='width: 400px'>
                        <form method="POST" action="" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
                            <input type="hidden" name="existing_image" value="<?php echo $course['image']; ?>">
                            <div class="form-group">
                                <label for="title">Course Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $course['title']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" value="<?php echo $course['description']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="details">Details</label>
                                <textarea class="form-control" id="details" name="details" rows="5" required><?php echo $course['details']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $course['duration']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="mentors">Mentor</label>
                                <textarea class="form-control" id="mentors" name="mentors" rows="5" required><?php echo $course['mentors']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="mentors">What you will Learn</label>
                                <textarea class="form-control" id="wylearn" name="wylearn" rows="5" required><?php echo $course['wylearn']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Course Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary" name="update_course">Update</button>
                            <a href="?delete=<?php echo $course['id']; ?>" class="btn btn-danger">Delete</a>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>

        <hr>

        <!-- Add Lesson Form -->
        <h3 class="mt-5">Add Lesson</h3>
        <form method="POST" action="">
            <div class="form-group">
                <label for="course_id">Course</label>
                <select class="form-control" id="course_id" name="course_id" required>
                    <?php foreach ($courses as $course) { ?>
                    <option value="<?php echo $course['id']; ?>"><?php echo $course['title']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Lesson Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="add_lesson">Add Lesson</button>
        </form>

        <hr>

        <!-- Manage Lessons Table -->
        <h3 class="mt-5">Manage Lessons</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson) { ?>
                <tr>
                    <td><?php echo $lesson['id']; ?></td>
                    <td><?php echo $lesson['course_title']; ?></td>
                    <td><?php echo $lesson['title']; ?></td>
                    <td><?php echo $lesson['status']; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="lesson_id" value="<?php echo $lesson['id']; ?>">
                            <div class="form-group">
                                <label for="course_id">Course</label>
                                <select class="form-control" id="course_id" name="course_id" required>
                                    <?php foreach ($courses as $course) { ?>
                                    <option value="<?php echo $course['id']; ?>" <?php echo $course['id'] == $lesson['course_id'] ? 'selected' : ''; ?>>
                                        <?php echo $course['title']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Lesson Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $lesson['title']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Pending" <?php echo $lesson['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Completed" <?php echo $lesson['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="update_lesson">Update</button>
                            <a href="?delete_lesson=<?php echo $lesson['id']; ?>" class="btn btn-danger">Delete</a>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

          <!-- Add Attendance Form -->
          <h3 class="mt-5">Add Attendance</h3>
        <form method="POST" action="">
            <div class="form-group">
                <label for="student_id">Student</label>
                <select class="form-control" id="id" name="id" required>
                    <?php foreach ($students as $student) { ?>
                    <option value="<?php echo $student['id']; ?>"><?php echo $student['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="course_id">Course</label>
                <select class="form-control" id="course_id" name="course_id" required>
                    <?php foreach ($courses as $course) { ?>
                    <option value="<?php echo $course['id']; ?>"><?php echo $course['title']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="lesson_id">Lesson</label>
                <select class="form-control" id="lesson_id" name="lesson_id" required>
                    <?php foreach ($lessons as $lesson) { ?>
                    <option value="<?php echo $lesson['id']; ?>"><?php echo $lesson['title']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="add_attendance">Add Attendance</button>
        </form>

        <hr>

        <!-- Manage Attendance Table -->
        <h3 class="mt-5">Manage Attendance</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Lesson</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch attendance records
                $sql_attendance = "SELECT a.*, s.name as student_name, c.title as course_title, l.title as lesson_title
                                   FROM attendance a
                                   JOIN students s ON a.student_id = s.id
                                   JOIN courses c ON a.course_id = c.id
                                   JOIN lessons l ON a.lesson_id = l.id";
                $result_attendance = $conn->query($sql_attendance);
                if ($result_attendance->num_rows > 0) {
                    while ($row = $result_attendance->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['course_title']; ?></td>
                            <td><?php echo $row['lesson_title']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="attendance_id" value="<?php echo $row['id']; ?>">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Present" <?php echo $row['status'] == 'Present' ? 'selected' : ''; ?>>Present</option>
                                            <option value="Absent" <?php echo $row['status'] == 'Absent' ? 'selected' : ''; ?>>Absent</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="update_attendance">Update</button>
                                </form>
                                <a href="?delete_attendance=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>

        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
</body>
</html>
