<?php

// $servername = "localhost";
// $username = "root";
// $password = "1234";
// $dbname = "score";

$servername = "localhost";
$username = "slowbs";
$password = "1596321";
$dbname = "score";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    //echo "Database Connected.";
    mysqli_set_charset($conn, "utf8");
}
