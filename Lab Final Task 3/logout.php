<?php
session_start();
session_destroy(); // clears all session data
header("Location: login.php");
exit();
?>