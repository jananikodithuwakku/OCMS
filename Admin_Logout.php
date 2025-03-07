<?php
session_start();
session_destroy();
header("Location: Admin_Panel.php");
exit();
?>
