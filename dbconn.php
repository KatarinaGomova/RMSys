<?php
    error_reporting(E_ALL);
    //error_reporting(0);
    $conn = new mysqli("localhost", "root", "root", "rmsys");

    if ($conn->connect_errno) {
        die("Connection failed: ". mysqli_connect_error());
    }

?>