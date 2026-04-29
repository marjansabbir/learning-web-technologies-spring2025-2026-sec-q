<?php
session_start();

require_once 'config/db.php';
require_once 'models/UserModel.php';
require_once 'models/RecordModel.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/RecordController.php';

$page = $_GET['page'] ?? '';

if ($page === '') {
    $allUsers = getAllUsers();
    if (count($allUsers) === 0) {
        header("Location: index.php?page=signup");
    } else {
        header("Location: index.php?page=login");
    }
    exit();
}

switch ($page) {
    case 'login':   loginController();   break;
    case 'signup':  signupController();  break;
    case 'logout':  logoutController();  break;
    case 'home':    homeController();    break;
    case 'records': recordsController(); break;
    case 'create':  createController();  break;
    case 'update':  updateController();  break;
    case 'delete':  deleteController();  break;

    default:
        echo "<p style='text-align:center; margin-top:50px; font-size:18px;'>
              ❌ Page not found.
              <a href='index.php'>Go Home</a></p>";
}
?>
