<?php
session_start();

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $_SESSION['users'][$username] = [
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'photo' => 'default.png'
    ];

    echo "Registration   Successful!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>

<h2>Registration</h2>

<form method="post">
    Username: <input type="text" name="username"><br><br>
    Email: <input type="email" name="email"><br><br>
    Password: <input type="password" name="password"><br><br>

    <input type="submit" name="submit" value="Register">
</form>

<a href="index.php">Back</a>

</body>
</html>