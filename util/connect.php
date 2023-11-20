<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "rsudma_cup";
$connect = mysqli_connect($server, $username, $password, $database, 3306) or die("Connection Failed");
try {
    //mysqli_connect($server,$username,$password) or die("Connection Failed");
    mysqli_select_db($connect, $database) or die("Database not found");
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
