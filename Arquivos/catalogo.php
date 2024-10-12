<!-- catalogo.php -->
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
    <h1>Catálogo de Libros</h1>
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

