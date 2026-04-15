<!DOCTYPE html>
<html>
<head>
    <title>Blood Output</title>
</head>
<body>

<?php
if(isset($_POST["blood"]) && $_POST["blood"] != "") {
    echo "Blood Group: " . $_POST["blood"];
} else {
    echo "No blood group selected";
}
?>

</body>
</html>