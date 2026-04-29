<?php


function getAllRecords() {
    global $conn;
    $result  = mysqli_query($conn, "SELECT * FROM records");
    $records = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $records[] = $row;
    }
    return $records;
}

function getRecordById($id) {
    global $conn;
    $id     = (int)$id;
    $result = mysqli_query($conn, "SELECT * FROM records WHERE id=$id");
    return mysqli_fetch_assoc($result);
}

function createRecord($name, $course, $grade) {
    global $conn;
    $name   = mysqli_real_escape_string($conn, $name);
    $course = mysqli_real_escape_string($conn, $course);
    $grade  = mysqli_real_escape_string($conn, $grade);
    return mysqli_query($conn, "INSERT INTO records (name, course, grade) VALUES ('$name', '$course', '$grade')");
}

function updateRecord($id, $name, $course, $grade) {
    global $conn;
    $id     = (int)$id;
    $name   = mysqli_real_escape_string($conn, $name);
    $course = mysqli_real_escape_string($conn, $course);
    $grade  = mysqli_real_escape_string($conn, $grade);
    return mysqli_query($conn, "UPDATE records SET name='$name', course='$course', grade='$grade' WHERE id=$id");
}

function deleteRecord($id) {
    global $conn;
    $id = (int)$id;
    return mysqli_query($conn, "DELETE FROM records WHERE id=$id");
}
?>
