<?php
// config/db.php
// Change these values to match your server

$conn = mysqli_connect("localhost", "root", "", "student_db");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
