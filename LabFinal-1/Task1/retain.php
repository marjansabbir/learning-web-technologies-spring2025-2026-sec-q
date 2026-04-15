<!DOCTYPE html>
<html>
<head>
    <title>Retain Value</title>
</head>
<body>

<?php
$name = "";
if(isset($_POST["name"])) {
    $name = $_POST["name"];
}
?>

<form method="post">
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <input type="submit" value="Submit">
</form>

<?php
if($name != "") {
    echo "Your name is: " . $name;
}
?>

</body>
</html>