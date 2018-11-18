<?php
session_start();

unset($_SESSION['ValidLogin']);
header('Location: index.php');

?>
