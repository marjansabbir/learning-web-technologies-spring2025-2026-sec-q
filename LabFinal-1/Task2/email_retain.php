<!DOCTYPE html>
<html>
<head>
    <title>Email Retain</title>
</head>
<body>

<?php
$email = "";
if(isset($_POST["email"])) {
    $email = $_POST["email"];
}
?>

<form method="post">
    Email: <input type="text" name="email" value="<?php echo $email; ?>">
    <input type="submit">
</form>

<?php
if($email != "") {
    echo "Your email is: " . $email;
}
?>

</body>
</html>