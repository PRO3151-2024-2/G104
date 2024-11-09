<?php
include 'connection.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $capa = $_POST['capa'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $descricao = $_POST['descricao'];
    $data_pub = $_POST['data_pub'];
    $genero = $_POST['genero'];

    $sql = "UPDATE livros SET capa='$capa', titulo='$titulo', autor='$autor', isbn='$isbn',
            descricao='$descricao', data_pub='$data_pub', genero='$genero' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: admin_home.php');
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM livros WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
</head>
<body>
    <h1>Editar Livro</h1>
    <form method="POST" action="">
        Capa: <input type="text" name="capa" value="<?php echo $row['capa']; ?>" required><br>
        Título: <input type="text" name="titulo" value="<?php echo $row['titulo']; ?>" required><br>
        Autor: <input type="text" name="autor" value="<?php echo $row['autor']; ?>" required><br>
        ISBN: <input type="text" name="isbn" value="<?php echo $row['isbn']; ?>" required><br>
        Descrição: <textarea name="descricao" required><?php echo $row['descricao']; ?></textarea><br>
        Data de Publicação: <input type="date" name="data_pub" value="<?php echo $row['data_pub']; ?>" required><br>
        Gênero: <input type="text" name="genero" value="<?php echo $row['genero']; ?>" required><br>
        <button type="submit">Salvar</button>
    </form>
    <a href="admin_home.php">Voltar para a Lista de Livros</a>
</body>
</html>
