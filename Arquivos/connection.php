<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "Lab09";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
