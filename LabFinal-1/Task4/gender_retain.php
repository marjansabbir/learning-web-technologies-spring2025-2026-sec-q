<!DOCTYPE html>
<html>
<head>
    <title>Gender Same Page</title>
</head>
<body>

<?php
$gender = "";
if(isset($_POST["gender"])) {
    $gender = $_POST["gender"];
}
?>

<form method="post">
    Gender:
    <input type="radio" name="gender" value="Male"
    <?php if($gender == "Male") echo "checked"; ?>> Male

    <input type="radio" name="gender" value="Female"
    <?php if($gender == "Female") echo "checked"; ?>> Female

    <br><br>
    <input type="submit" value="Submit">
</form>

<?php
if($gender != "") {
    echo "Selected Gender: " . $gender;
}
?>

</body>
</html>