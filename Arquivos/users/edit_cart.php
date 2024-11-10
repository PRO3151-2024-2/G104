<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

include '../connection.php'; // Verifique o caminho do arquivo de conexão

// Verifica se o parâmetro 'livro_id' foi passado corretamente e se a quantidade foi enviada pelo formulário
if (isset($_GET['livro_id'])) {
    $livro_id = (int)$_GET['livro_id'];

    // Verifica se o formulário foi enviado com a nova quantidade
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantidade'])) {
        $nova_quantidade = (int)$_POST['quantidade'];

        if ($nova_quantidade > 0) {
            // Atualiza a quantidade do item no carrinho com base em 'livro_id' e 'user_id'
            $sql = "UPDATE carrinho SET quantidade = ? WHERE livro_id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Erro na preparação da declaração SQL: " . $conn->error);
            }
            $stmt->bind_param('iii', $nova_quantidade, $livro_id, $_SESSION['user_id']);

            if ($stmt->execute()) {
                echo "Quantidade atualizada com sucesso!";
            } else {
                echo "Erro ao atualizar a quantidade: " . $stmt->error;
            }
        } else {
            echo "A quantidade deve ser maior que zero.";
        }
    } else {
        // Formulário de edição da quantidade
        echo '<form method="post" action="edit_cart.php?livro_id=' . htmlspecialchars($livro_id) . '">';
        echo '<label for="quantidade">Nova quantidade:</label>';
        echo '<input type="number" id="quantidade" name="quantidade" min="1" required>';
        echo '<button type="submit">Atualizar</button>';
        echo '</form>';
    }
} else {
    echo "Parâmetros inválidos.";
}
?>
<a href="carrinho.php">Voltar para o carrinho</a>
