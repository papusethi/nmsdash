<?php

// connection to database
$connection = mysqli_connect('localhost', 'root', '', 'noiseapp');

if (!$connection == true) {
    die("Database Connection Failed.");
}
?>