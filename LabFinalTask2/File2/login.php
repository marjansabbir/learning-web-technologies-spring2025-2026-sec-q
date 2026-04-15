<?php
session_start();

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(isset($_SESSION['users'][$username])) {
        if($_SESSION['users'][$username]['password'] == $password) {

            $_SESSION['current_user'] = $username;

            // Optional cookie (simple)
            setcookie("username", $username, time()+3600);

            header("Location: dashboard.php");
        } else {
            echo "Wrong Password!";
        }
    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="post">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>

    <input type="submit" name="submit" value="Login">
</form>

<a href="index.php">Back</a>

</body>
</html>