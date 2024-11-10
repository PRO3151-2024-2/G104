<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT c.id, c.livro_id, l.titulo, l.capa, c.preco, c.quantidade
        FROM carrinho c
        JOIN livros l ON c.livro_id = l.id
        WHERE c.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Carrinho de Compras</title>
</head>
<body>
    <header>
        <h1>Portal do Saber</h1>
        <nav>
            <ul>
                <li><a href="http://localhost/PRO3151/Lab12/index.php">Página Principal</a></li>
                <li><a href="http://localhost/PRO3151/Lab12/about.html">Sobre Nós</a></li>
                <li><a href="http://localhost/PRO3151/Lab12/login.php">Login</a></li>
                <li><a href="http://localhost/PRO3151/Lab12/catalogo.php">Catálogo</a></li>
                <li><a href="http://localhost/PRO3151/Lab12/busca.php">Localizar Livro</a></li>
                <li><a href="http://localhost/PRO3151/Lab12/users/carrinho.php">Carrinho</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Seu Carrinho de Compras</h2>
        <form method="post" action="carrinho.php">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Capa</th>
                        <th>Livro</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars('../' . $row['capa'] . '.jpg'); ?>" alt="Capa do livro" style="width: 200px; height: auto;"></td>
                            <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                            <td>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
                            <td>
                                <input type="number" name="quantidade[<?php echo $row['livro_id']; ?>]" value="<?php echo $row['quantidade']; ?>" min="1">
                            </td>
                            <td>
                                <a href="delete_cart.php?livro_id=<?php echo htmlspecialchars($row['livro_id']); ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button type="submit" name="atualizar">Atualizar Quantidades</button>
        </form>
        <div class="action-buttons">
            <a href="http://localhost/PRO3151/Lab12/catalogo.php"><button class="button">Continuar Comprando</button></a>
            <a href="concluir_compra.php"><button class="button">Concluir Compra</button></a>
        </div>
    </main>

    <footer>
        <p>© 2024 Portal do Saber. Todos os direitos reservados.</p>
    </footer>
</body>
</html>

<?php
// Processa a atualização da quantidade após a submissão do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    foreach ($_POST['quantidade'] as $livro_id => $nova_quantidade) {
        $nova_quantidade = (int)$nova_quantidade;

        if ($nova_quantidade > 0) {
            $update_sql = "UPDATE carrinho SET quantidade = ? WHERE livro_id = ? AND user_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            if ($update_stmt === false) {
                die("Erro na preparação da declaração SQL: " . $conn->error);
            }
            $update_stmt->bind_param('iii', $nova_quantidade, $livro_id, $_SESSION['user_id']);
            $update_stmt->execute();
        }
    }
    // Redireciona para recarregar a página após a atualização
    header("Location: carrinho.php");
    exit();
}
?>
