<?php
    $host = "localhost";    // XAMPP default
    $user = "root";         // XAMPP default
    $pass = "";             // XAMPP default
    $db   = "fct_tutor";    // your DB name

    $conn = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
