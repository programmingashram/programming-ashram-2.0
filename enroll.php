<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'];

// Check if the user is already enrolled in the course
$sql = "SELECT * FROM user_courses WHERE user_id = $user_id AND course_id = $course_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $sql = "INSERT INTO user_courses (user_id, course_id) VALUES ($user_id, $course_id)";
    if ($conn->query($sql) === TRUE) {
        echo "Enrolled successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "You are already enrolled in this course.";
}

$conn->close();
?>
<a href="index.php">Back to Course Listing</a>
