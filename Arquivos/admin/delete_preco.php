<?php
include 'connection.php';

$id_livro = $_GET['id'];

$sql = "DELETE FROM pre__os WHERE id_livro=$id_livro";

if ($conn->query($sql) === TRUE) {
    header('Location: admin_home.php');
    exit;
} else {
    echo "Erro ao excluir: " . $conn->error;
}

$conn->close();
?>