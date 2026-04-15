<?php
session_start();

if(!isset($_SESSION['current_user'])) {
    header("Location: login.php");
}

$user = $_SESSION['users'][$_SESSION['current_user']];
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Profile</title>
</head>
<body>

<h2>Profile</h2>

Username: <?php echo $user['username']; ?> <br><br>
Email: <?php echo $user['email']; ?> <br><br>

<img src="<?php echo $user['photo']; ?>" width="100"> <br><br>

<a href="dashboard.php">Back</a>

</body>
</html>