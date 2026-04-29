<?php


function checkLogin() {
    if (!isset($_SESSION['logged_in'])) {
        header("Location: index.php?page=login");
        exit();
    }
}

function checkAdmin() {
    if ($_SESSION['logged_in']['role'] !== 'admin') {
        echo "<p style='text-align:center; color:red; margin-top:50px; font-size:18px;'>❌ Access Denied! Admins only.</p>";
        echo "<p style='text-align:center;'><a href='index.php?page=home'>Go Back</a></p>";
        exit();
    }
}

function homeController() {
    global $conn;
    checkLogin();
    $user = $_SESSION['logged_in'];
    require 'views/home_view.php';
}

function recordsController() {
    global $conn;
    checkLogin();
    $user    = $_SESSION['logged_in'];
    $records = getAllRecords();
    require 'views/records_view.php';
}

function createController() {
    global $conn;
    checkLogin();
    checkAdmin();

    $message = "";  

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name   = trim($_POST['name']);
        $course = trim($_POST['course']);
        $grade  = trim($_POST['grade']);

        if ($name === "" || $course === "" || $grade === "") {
            $message = "error:Please fill in all fields.";
        } else {
            createRecord($name, $course, $grade);
            $message = "success:Record added successfully!";
        }
    }

    require 'views/create_view.php';
}

function updateController() {
    global $conn;
    checkLogin();
    $user = $_SESSION['logged_in'];

    
    $message = "";
    $record  = null;
    $records = [];
    $id      = -1;

    if ($user['role'] === 'admin') {

        $records = getAllRecords();  // for the list

        if (isset($_GET['id'])) {
            $id     = (int)$_GET['id'];
            $record = getRecordById($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id     = (int)$_POST['id'];
            $name   = trim($_POST['name']);
            $course = trim($_POST['course']);
            $grade  = trim($_POST['grade']);

            if ($name === "" || $course === "" || $grade === "") {
                $message = "error:Please fill in all fields.";
                $record  = getRecordById($id);
            } else {
                updateRecord($id, $name, $course, $grade);
                $message = "success:Record updated successfully!";
                $record  = getRecordById($id);
            }
        }

    } else {

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newName     = trim($_POST['name']);
            $newPassword = trim($_POST['password']);

            if ($newName === "" || $newPassword === "") {
                $message = "error:Please fill in all fields.";
            } else {
                $oldName = $user['name'];
                updateUser($oldName, $newName, $newPassword);

                $_SESSION['logged_in'] = getUserByName($newName);
                $user = $_SESSION['logged_in'];
                $message = "success:Profile updated successfully!";
            }
        }
    }

    require 'views/update_view.php';
}

function deleteController() {
    global $conn;
    checkLogin();
    checkAdmin();

    $message = "";  

    if (isset($_GET['id'])) {
        $id     = (int)$_GET['id'];
        $record = getRecordById($id);

        if ($record) {
            deleteRecord($id);
            $message = "success:Record deleted successfully!";
        } else {
            $message = "error:Record not found.";
        }
    }

    $records = getAllRecords();
    require 'views/delete_view.php';
}
?>
