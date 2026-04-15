<!DOCTYPE html>
<html>
<head>
    <title>Same Page</title>
</head>
<body>

<form method="post">
    Name: <input type="text" name="name">
    <input type="submit" value="Submit">
</form>

<?php
if(isset($_POST["name"])) {
    echo "Your name is: " . $_POST["name"];
}
?>

</body>
</html>