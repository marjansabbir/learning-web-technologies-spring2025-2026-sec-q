<?php


function getUserByName($name) {
    global $conn;
    $name   = mysqli_real_escape_string($conn, $name);
    $result = mysqli_query($conn, "SELECT * FROM accounts WHERE name='$name'");
    return mysqli_fetch_assoc($result);
}

function getAllUsers() {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM accounts");
    $users  = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}

function createUser($name, $password, $role) {
    global $conn;
    $name     = mysqli_real_escape_string($conn, $name);
    $password = mysqli_real_escape_string($conn, $password);
    $role     = mysqli_real_escape_string($conn, $role);
    return mysqli_query($conn, "INSERT INTO accounts (name, password, role) VALUES ('$name', '$password', '$role')");
}

function updateUser($oldName, $newName, $newPassword) {
    global $conn;
    $oldName     = mysqli_real_escape_string($conn, $oldName);
    $newName     = mysqli_real_escape_string($conn, $newName);
    $newPassword = mysqli_real_escape_string($conn, $newPassword);
    return mysqli_query($conn, "UPDATE accounts SET name='$newName', password='$newPassword' WHERE name='$oldName'");
}
?>
