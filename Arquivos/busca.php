<!-- busca.php -->
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

$search = "";
if (isset($_POST["search"])) {
    $search = $conn->real_escape_string($_POST["search"]);
    // Modificamos la consulta SQL para incluir un JOIN con la tabla pre__os
    $sql = "SELECT livros.id, livros.titulo, livros.autor, pre__os.preco 
            FROM livros
            LEFT JOIN pre__os ON livros.id = pre__os.id_livro 
            WHERE livros.titulo LIKE '%$search%' OR livros.autor LIKE '%$search%'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Libros</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Portal do Saber</h1>
        <nav>
            <ul>
                <li><a href="index.html">Página Principal</a></li>
                <li><a href="about.html">Sobre Nós</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="http://localhost/LAb08/catalogo.php">Catálogo</a></li> <!-- Nuevo enlace -->
                <li><a href="http://localhost/LAb08/livros_mais_vendidos.php">Livros Mais Vendidos</a></li> <!-- Nuevo enlace -->
                <li><a href="http://localhost/LAb08/busca.php">Localizar Livro</a></li> <!-- Nuevo enlace -->
            </ul>
        </nav>
    </header>
    <h2>Buscar Libros</h2>
    <form method="POST" action="busca.php">
        <input type="text" name="search" placeholder="Ingrese título o autor" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Buscar</button>
    </form>
    <br>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Precio</th>
        </tr>
        <?php
        if (isset($result) && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["titulo"] . "</td>";
                echo "<td>" . $row["autor"] . "</td>";
                echo "<td>R$" . $row["preco"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
        }
        ?>
    </table>
    <?php $conn->close(); ?>
</body>
</html>