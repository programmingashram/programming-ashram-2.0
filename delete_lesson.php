<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

$lesson_id = $_GET['id'];

$delete_sql = "DELETE FROM lessons WHERE id=$lesson_id";

if ($conn->query($delete_sql) === TRUE) {
    header('Location: manage_lessons.php');
} else {
    echo "Error: " . $delete_sql . "<br>" . $conn->error;
}

$conn->close();
?>
