<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab12";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
