<!DOCTYPE html>
<html>
<head>
    <title>Degree Same Page</title>
</head>
<body>

<?php
$degree = array();
if(isset($_POST["degree"])) {
    $degree = $_POST["degree"];
}
?>

<form method="post">
    Degree:

    <input type="checkbox" name="degree[]" value="SSC"
    <?php if(in_array("SSC", $degree)) echo "checked"; ?>> SSC

    <input type="checkbox" name="degree[]" value="HSC"
    <?php if(in_array("HSC", $degree)) echo "checked"; ?>> HSC

    <input type="checkbox" name="degree[]" value="BSc"
    <?php if(in_array("BSc", $degree)) echo "checked"; ?>> BSc

    <br><br>
    <input type="submit" value="Submit">
</form>

<?php
if(count($degree) > 0) {
    foreach($degree as $d) {
        echo $d . "<br>";
    }
}
?>

</body>
</html>