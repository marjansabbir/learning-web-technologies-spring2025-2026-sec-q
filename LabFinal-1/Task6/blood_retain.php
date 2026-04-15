<!DOCTYPE html>
<html>
<head>
    <title>Blood Same Page</title>
</head>
<body>

<?php
$blood = "";
if(isset($_POST["blood"])) {
    $blood = $_POST["blood"];
}
?>

<form method="post">
    Blood Group:
    <select name="blood">
        <option value="">Select</option>

        <option value="A+" <?php if($blood=="A+") echo "selected"; ?>>A+</option>
        <option value="B+" <?php if($blood=="B+") echo "selected"; ?>>B+</option>
        <option value="O+" <?php if($blood=="O+") echo "selected"; ?>>O+</option>
    </select>

    <br><br>
    <input type="submit" value="Submit">
</form>

<?php
if($blood != "") {
    echo "Blood Group: " . $blood;
}
?>

</body>
</html>