<!DOCTYPE html>
<html>
<head>
    <title>Output</title>
</head>
<body>

<?php
if(isset($_POST["name"])) {
    echo "Your name is: " . $_POST["name"];
}
?>

</body>
</html>