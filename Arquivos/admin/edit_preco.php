<?php
include 'connection.php';

$id_livro = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];
    $preco = $_POST['preco'];

    $sql = "UPDATE pre__os SET data='$data', preco='$preco' WHERE id_livro=$id_livro";

    if ($conn->query($sql) === TRUE) {
        header('Location: admin_home.php');
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM pre__os WHERE id_livro=$id_livro";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Preço</title>
</head>
<body>
    <h1>Editar Preço</h1>
    <form method="POST" action="">
        Data: <input type="date" name="data" value="<?php echo $row['data']; ?>" required><br>
        Preço: <input type="text" name="preco" value="<?php echo $row['preco']; ?>" required><br>
        <button type="submit">Salvar</button>
    </form>
    <a href="admin_home.php">Voltar para a Lista de Preços</a>
</body>
</html>