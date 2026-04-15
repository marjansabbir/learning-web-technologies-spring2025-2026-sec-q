<?php
session_start();

if(!isset($_SESSION['current_user'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome, <?php echo $_SESSION['current_user']; ?></h2>

<a href="view_profile.php">View Profile</a> <br><br>
<a href="edit_profile.php">Edit Profile</a> <br><br>
<a href="change_picture.php">Change Profile Picture</a> <br><br>
<a href="change_password.php">Change Password</a> <br><br>
<a href="logout.php">Logout</a>

</body>
</html>