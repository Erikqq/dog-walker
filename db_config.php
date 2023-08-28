<?php

$host = "localhost";
$username = "szimur";
$password = "lnzhhJQATR3uBUd";
$database = "szimur";

$con = mysqli_connect($host, $username, $password, $database);


if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>