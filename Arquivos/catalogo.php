<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab12";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los libros y sus precios
$sql = "SELECT livros.id, livros.titulo, livros.autor, pre__os.preco
        FROM livros
        LEFT JOIN pre__os ON livros.id = pre__os.id_livro";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Libros</title>
    <link rel="stylesheet" href="styles.css">
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
    <h2>Catálogo de Libros</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Precio</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["titulo"] . "</td>";
                echo "<td>" . $row["autor"] . "</td>";
                echo "<td>R$" . $row["preco"] . "</td>";
                echo '<td><a href="book.html?bookId=' . $row['id'] . '"><button>Ver Detalhes</button></a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay libros disponibles</td></tr>";
        }
        ?>
    </table>
    <?php $conn->close(); ?>
</body>
</html>

