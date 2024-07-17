<?php
session_start();
include 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch courses
$courses_sql = "SELECT * FROM courses";
$courses_result = $conn->query($courses_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $status = $_POST['status'];

    $insert_sql = "INSERT INTO lessons (course_id, title, status) VALUES ('$course_id', '$title', '$status')";
    
    if ($conn->query($insert_sql) === TRUE) {
        echo "Lesson added successfully";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

// Fetch lessons
$lessons_sql = "SELECT l.id, l.title, l.status, c.title as course_title FROM lessons l JOIN courses c ON l.course_id = c.id";
$lessons_result = $conn->query($lessons_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Manage Lessons</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Lessons</h1>
        
        <form action="manage_lessons.php" method="post" class="mb-5">
            <div class="form-group">
                <label for="course_id">Course</label>
                <select name="course_id" id="course_id" class="form-control" required>
                    <?php
                    if ($courses_result->num_rows > 0) {
                        while($course = $courses_result->fetch_assoc()) {
                            echo '<option value="'. $course["id"] .'">'. $course["title"] .'</option>';
                        }
                    } else {
                        echo '<option value="">No courses available</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Lesson Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="not started">Not Started</option>
                    <option value="in progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Lesson</button>
        </form>

        <h2>Lessons List</h2>
        <table class="table">
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
                <?php
                if ($lessons_result->num_rows > 0) {
                    while($lesson = $lessons_result->fetch_assoc()) {
                        echo '
                        <tr>
                            <td>'. $lesson["id"] .'</td>
                            <td>'. $lesson["course_title"] .'</td>
                            <td>'. $lesson["title"] .'</td>
                            <td>'. $lesson["status"] .'</td>
                            <td>
                                <a href="edit_lesson.php?id='. $lesson["id"] .'" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_lesson.php?id='. $lesson["id"] .'" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No lessons available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
