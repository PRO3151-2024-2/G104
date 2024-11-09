<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "Lab11");

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consultar dados dos livros e preços
$sql = "SELECT livros.id, livros.capa, livros.titulo, livros.autor, livros.isbn, livros.descricao, 
               livros.data_pub, livros.genero, pre__os.preco 
        FROM livros 
        JOIN pre__os ON livros.id = pre__os.id_livro";

$result = $conn->query($sql);

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode($books);

$conn->close();
?>