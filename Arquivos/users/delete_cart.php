<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include '../connection.php';

if (isset($_GET['livro_id'])) {
    $livro_id = (int)$_GET['livro_id'];

    $sql = "DELETE FROM carrinho WHERE livro_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erro na preparação da declaração SQL: " . $conn->error);
    }
    $stmt->bind_param('ii', $livro_id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        echo "Item removido do carrinho com sucesso!";
    } else {
        echo "Erro ao remover o item: " . $stmt->error;
    }
} else {
    echo "Parâmetro 'livro_id' inválido.";
}
?>
<a href="carrinho.php">Voltar para o carrinho</a>
