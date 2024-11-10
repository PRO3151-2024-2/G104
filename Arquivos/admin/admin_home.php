<?php
    session_start();

    include '../connection.php';

    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
        header("Location: ../login.php");
        exit();
    }

    $username = $_SESSION['username'];

    // Consulta a tabela livros
    $sql = "SELECT * FROM livros";
    $result = $conn->query($sql);

    if (!$result) {
        die("Erro na consulta SQL: " . $conn->error);
    }

    // Consulta para a tabela pre__os
    $sql_pre__os = "SELECT * FROM pre__os";
    $result_pre__os = $conn->query($sql_pre__os);

    if (!$result_pre__os) {
        die("Erro na consulta SQL da tabela pre__os: " . $conn->error);
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
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
<h1>Welcome, <?php echo $username; ?>!</h1>
    <a href="insert.php">Adicionar Novo livro</a><br><br>
    <table border="1">
        <tr>
            <th>id</th>
            <th>Capa</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>isbn</th>
            <th>descricao</th>
            <th>data_pub</th>
            <th>genero</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['capa'] . "</td>";
                echo "<td>" . $row['titulo'] . "</td>";
                echo "<td>" . $row['autor'] . "</td>";
                echo "<td>" . $row['isbn'] . "</td>";
                echo "<td>" . $row['descricao'] . "</td>";
                echo "<td>" . $row['data_pub'] . "</td>";
                echo "<td>" . $row['genero'] . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "'>Editar</a> | 
                        <a href='delete.php?id=" . $row['id'] . "' onclick=\"return confirm('Tem certeza que deseja excluir?');\">Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Nenhum livro encontrado</td></tr>";
        }
        ?>
    </table>
    <a href="insert.php">Modificar Preço</a><br><br>
    <table border="1">
        <tr>
            <th>Data</th>
            <th>ID do Livro</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
        <?php
           if ($result_pre__os->num_rows > 0) {
                while ($row_pre__os = $result_pre__os->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_pre__os['data'] . "</td>";
                    echo "<td>" . $row_pre__os['id_livro'] . "</td>";
                    echo "<td>" . $row_pre__os['preco'] . "</td>";
                    echo "<td>
                            <a href='edit_preco.php?id=" . $row_pre__os['id_livro'] . "'>Editar</a> | 
                            <a href='delete_preco.php?id=" . $row_pre__os['id_livro'] . "' onclick=\"return confirm('Tem certeza que deseja excluir?');\">Excluir</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum preço encontrado.</td></tr>";
            }
        ?>
    </table>
    <br>
<p><a href="../logout.php">Logout</a></p>

</body>
</html>


