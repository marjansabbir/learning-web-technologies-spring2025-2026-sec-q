<?php
session_start();

if(isset($_POST['submit'])) {
    $username = $_POST['username'];

    if(isset($_SESSION['users'][$username])) {
        echo "Your password is: " . $_SESSION['users'][$username]['password'];
    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>

<h2>Forgot Password</h2>

<form method="post">
    Username: <input type="text" name="username"><br><br>
    <input type="submit" name="submit" value="Get Password">
</form>

<a href="index.php">Back</a>

</body>
</html>