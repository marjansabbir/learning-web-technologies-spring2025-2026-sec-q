<!DOCTYPE html>
<html>
<head>
    <title>Degree Output</title>
</head>
<body>

<?php
if(isset($_POST["degree"])) {
    foreach($_POST["degree"] as $d) {
        echo $d . "<br>";
    }
} else {
    echo "No degree selected";
}
?>

</body>
</html>