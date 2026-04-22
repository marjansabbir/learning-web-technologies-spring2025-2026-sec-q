<?php
session_start();

// If no accounts exist yet, send to signup first
if (!isset($_SESSION['accounts']) || count($_SESSION['accounts']) === 0) {
    header("Location: signup.php");
} else {
    header("Location: login.php");
}
exit();
?>