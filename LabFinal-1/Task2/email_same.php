<!DOCTYPE html>
<html>
<head>
    <title>Email Same</title>
</head>
<body>

<form method="post">
    Email: <input type="text" name="email">
    <input type="submit">
</form>

<?php
if(isset($_POST["email"])) {
    echo "Your email is: " . $_POST["email"];
}
?>

</body>
</html>