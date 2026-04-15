<!DOCTYPE html>
<html>
<head>
    <title>DOB Retain</title>
</head>
<body>

<?php
$dob = "";
if(isset($_POST["dob"])) {
    $dob = $_POST["dob"];
}
?>

<form method="post">
    DOB: <input type="date" name="dob" value="<?php echo $dob; ?>">
    <input type="submit">
</form>

<?php
if($dob != "") {
    echo "Your DOB is: " . $dob;
}
?>

</body>
</html>