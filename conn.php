<?php
    $host = "sql108.infinityfree.com";
    $username = "if0_38250293";
    $password = "fplwYYGKCkgPFvK";
    $dbname = "if0_38250293_secretcore";

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
