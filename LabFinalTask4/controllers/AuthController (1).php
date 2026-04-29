<?php


function loginController() {
    global $conn;  

    if (isset($_SESSION['logged_in'])) {
        header("Location: index.php?page=home");
        exit();
    }

    $message = "";  

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name     = trim($_POST['name']);
        $password = trim($_POST['password']);

        $user = getUserByName($name);

        if ($user && $user['password'] === $password) {
            $_SESSION['logged_in'] = $user;
            header("Location: index.php?page=home");
            exit();
        } else {
            $message = "Wrong username or password. Try again!";
        }
    }

    require 'views/login_view.php';
}

function signupController() {
    global $conn;  

    $message = "";  

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name     = trim($_POST['name']);
        $password = trim($_POST['password']);
        $role     = $_POST['role'];

        if ($name === "" || $password === "") {
            $message = "Please fill in all fields.";
        } elseif (getUserByName($name)) {
            $message = "This username already exists! Try another.";
        } else {
            createUser($name, $password, $role);
            header("Location: index.php?page=login");
            exit();
        }
    }

    require 'views/signup_view.php';
}

function logoutController() {
    session_destroy();
    header("Location: index.php?page=login");
    exit();
}
?>
