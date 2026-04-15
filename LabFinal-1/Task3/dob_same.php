<!DOCTYPE html>
<html>
<head>
    <title>DOB Same</title>
</head>
<body>

<form method="post">
    DOB: <input type="date" name="dob">
    <input type="submit">
</form>

<?php
if(isset($_POST["dob"])) {
    echo "Your DOB is: " . $_POST["dob"];
}
?>

</body>
</html>
