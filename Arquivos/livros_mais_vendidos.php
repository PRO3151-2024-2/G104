<!-- livros_mais_vendidos.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab08";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ajustar la consulta para contar las ventas de cada libro
$sql = "SELECT livros.id, livros.titulo, livros.autor, COUNT(vendas.id) as total_vendido
        FROM vendas
        INNER JOIN livros ON vendas.id_livro = livros.id
        GROUP BY livros.id
        ORDER BY total_vendido DESC
        LIMIT 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros Más Vendidos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Portal do Saber</h1>
        <nav>
            <ul>
            <li><a href="index.html">Página Principal</a></li>
                <li><a href="about.html">Sobre Nós</a></li>
                <li><a href="http://localhost/lab09/login.php">Login</a></li>
                <li><a href="http://localhost/lab09/catalogo.php">Catálogo</a></li> <!-- Nuevo enlace -->
                <li><a href="http://localhost/lab09/livros_mais_vendidos.php">Livros Mais Vendidos</a></li> <!-- Nuevo enlace -->
                <li><a href="http://localhost/lab09/busca.php">Localizar Livro</a></li> <!-- Nuevo enlace -->
            </ul>
        </nav>
    </header>
    <h2>Libros Más Vendidos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Total Vendido</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["titulo"] . "</td>";
                echo "<td>" . $row["autor"] . "</td>";
                echo "<td>" . $row["total_vendido"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay datos disponibles</td></tr>";
        }
        ?>
    </table>
    <?php $conn->close(); ?>
</body>
</html>
