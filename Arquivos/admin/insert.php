<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tabela']) && $_POST['tabela'] === 'livros') {
        // Inserção na tabela livros
        $id = $_POST['id'];
        $capa = $_POST['capa'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $isbn = $_POST['isbn'];
        $descricao = $_POST['descricao'];
        $data_pub = $_POST['data_pub'];
        $genero = $_POST['genero'];

        $sql = "INSERT INTO livros (id, capa, titulo, autor, isbn, descricao, data_pub, genero) 
                VALUES ('$id', '$capa', '$titulo', '$autor', '$isbn', '$descricao', '$data_pub', '$genero')";

        if ($conn->query($sql) === TRUE) {
            header("Location: admin_home.php");
            exit();
        } else {
            echo "Erro ao inserir na tabela livros: " . $conn->error;
        }
    } elseif (isset($_POST['tabela']) && $_POST['tabela'] === 'pre__os') {
        // Inserção na tabela pre__os
        $data = $_POST['data'];
        $id_livro = $_POST['id_livro'];
        $preco = $_POST['preco'];

        $sql = "INSERT INTO pre__os (data, id_livro, preco) VALUES ('$data', '$id_livro', '$preco')";

        if ($conn->query($sql) === TRUE) {
            header("Location: admin_home.php");
            exit();
        } else {
            echo "Erro ao inserir na tabela pre__os: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Novo Registro</title>
</head>
<body>
    <h1>Adicionar Novo Livro</h1>
    <form method="POST" action="insert.php">
        <input type="hidden" name="tabela" value="livros">
        <label for="id">ID:</label>
        <input type="text" name="id" required><br>
        <label for="capa">Capa:</label>
        <input type="text" name="capa" required><br>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" required><br>
        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" required><br>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required></textarea><br>
        <label for="data_pub">Data de Publicação:</label>
        <input type="date" name="data_pub" required><br>
        <label for="genero">Gênero:</label>
        <input type="text" name="genero" required><br>
        <input type="submit" value="Adicionar Livro">
    </form>

    <h2>Adicionar Novo Preço</h2>
    <form method="POST" action="insert.php">
        <input type="hidden" name="tabela" value="pre__os">
        <label for="data">Data:</label>
        <input type="date" name="data" required><br>
        <label for="id_livro">ID do Livro:</label>
        <input type="text" name="id_livro" required><br>
        <label for="preco">Preço:</label>
        <input type="text" name="preco" required><br>
        <input type="submit" value="Adicionar Preço">
    </form>
</body>
</html>