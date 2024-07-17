<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

// Fetch lesson details based on ID
if (isset($_GET['id'])) {
    $lesson_id = $_GET['id'];
    $sql_lesson = "SELECT * FROM lessons WHERE id = $lesson_id";
    $result_lesson = $conn->query($sql_lesson);
    if ($result_lesson->num_rows > 0) {
        $lesson = $result_lesson->fetch_assoc();
    } else {
        echo "Lesson not found";
        exit();
    }
} else {
    echo "Lesson ID not provided";
    exit();
}

// Fetch all courses
$sql_courses = "SELECT * FROM courses";
$result_courses = $conn->query($sql_courses);
$courses = [];
if ($result_courses->num_rows > 0) {
    while ($row = $result_courses->fetch_assoc()) {
        $courses[] = $row;
    }
} else {
    echo "No courses found";
    exit();
}

// Handle form submission to update lesson
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_lesson'])) {
    $lesson_id = $_POST['lesson_id'];
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $status = $_POST['status'];

    $update_sql = "UPDATE lessons SET course_id='$course_id', title='$title', status='$status' WHERE id=$lesson_id";

    if ($conn->query($update_sql) === TRUE) {
        $success = "Lesson updated successfully";
    } else {
        $error = "Error updating lesson: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Lesson</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Lesson</h2>
        <?php if (isset($success)) { echo '<div class="alert alert-success">' . $success . '</div>'; } ?>
        <?php if (isset($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>
        <form method="POST" action="">
            <input type="hidden" name="lesson_id" value="<?php echo $lesson['id']; ?>">
            <div class="form-group">
                <label for="course_id">Course</label>
                <select class="form-control" id="course_id" name="course_id" required>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo $course['id']; ?>" <?php if ($course['id'] == $lesson['course_id']) echo 'selected'; ?>>
                            <?php echo $course['title']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Lesson Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $lesson['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Pending" <?php if ($lesson['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Ongoing" <?php if ($lesson['status'] == 'Ongoing') echo 'selected'; ?>>Ongoing</option>
                    <option value="Completed" <?php if ($lesson['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="update_lesson">Update Lesson</button>
        </form>
        <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
