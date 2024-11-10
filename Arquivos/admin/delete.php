<?php
include 'connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM livros WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: admin_home.php');
    exit;
} else {
    echo "Erro ao excluir: " . $conn->error;
}

$conn->close();
?>
