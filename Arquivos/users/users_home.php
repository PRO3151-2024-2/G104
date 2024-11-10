<?php
    session_start();

    include '../connection.php';

    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
        header("Location: ../login.php");
        exit();
    }

    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área interna</title>
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
<h2>Welcome, <?php echo $username; ?>!</h2>
<p><a href="../logout.php">Logout</a></p>

</body>
</html>
