<?php
session_start();
unset($_SESSION['district_name']);
header('location:index.php');
?>