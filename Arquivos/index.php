<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab12";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para contar as vendas e trazer as capas dos livros mais vendidos
$sql = "SELECT livros.titulo, livros.autor, livros.capa, COUNT(vendas.id) as total_vendido
        FROM vendas
        INNER JOIN livros ON vendas.id_livro = livros.id
        GROUP BY livros.id
        ORDER BY total_vendido DESC
        LIMIT 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Mais Vendidos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Portal do Saber</h1>
        <nav>
            <ul>
                <li><a href="index.php">Página Principal</a></li>
                <li><a href="about.html">Sobre Nós</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="catalogo.php">Catálogo</a></li>
                <li><a href="busca.php">Localizar Livro</a></li>
                <li><a href="users/carrinho.php">Carrinho</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Livros Mais Vendidos</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Total Vendido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='" . htmlspecialchars($row['capa']) . ".jpg' alt='Capa do livro' style='width: 200px; height: auto;'></td>";
                        echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['autor']) . "</td>";
                        echo "<td>" . $row['total_vendido'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum dado disponível</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 Portal do Saber. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
