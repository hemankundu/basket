<?php
$dbname = "bsket_db";
$link = mysqli_connect("localhost", "heman", "hemanpass", $dbname);
if (!$link) {
    //If not connected to database
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}