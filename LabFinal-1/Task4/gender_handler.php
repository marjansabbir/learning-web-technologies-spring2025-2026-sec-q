<!DOCTYPE html>
<html>
<head>
    <title>Gender Output</title>
</head>
<body>

<?php
if(isset($_POST["gender"])) {
    echo "Selected Gender: " . $_POST["gender"];
} else {
    echo "No gender selected";
}
?>

</body>
</html>