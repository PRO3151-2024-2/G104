<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="login.js" defer></script>
    <title>Portal do Saber - Login</title>
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

    <main class="login-container">
        <h2>Login</h2>
        <?php
        session_start();
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Consulta SQL para verificar el nombre de usuario y contraseña
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];

                // Redirigir según el rol del usuario
                if ($_SESSION['role'] == 'admin') {
                    header("Location: admin/admin_home.php");
                } else {
                    header("Location: users/users_home.php");
                }
            } else {
                $error = "Usuario o contraseña inválido";
            }
        }
        $conn->close();
        ?>

        <!-- Formulario de login -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="username">Usuário:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Senha:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit" class="button">Entrar</button>
        </form>

        <!-- Mostrar mensaje de error, si existe -->
        <?php if (isset($error)): ?>
            <div id="errorMessage" class="error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>© 2024 Portal do Saber. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
