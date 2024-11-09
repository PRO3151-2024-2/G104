<?php
session_start();
include 'connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Exibe os valores recebidos para depuração
    var_dump($username, $password);

    // Inclua aspas invertidas (`) ao redor de `username` se for uma palavra reservada do banco de dados
    $sql = "SELECT id, `username`, password, role FROM users WHERE `username` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Exibe o usuário encontrado
        var_dump($user);

        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username']; // Corrigido para usar a chave correta
            $_SESSION['role'] = $user['role'];

            // Verifica qual redirecionamento será feito
            if ($_SESSION['role'] == 'admin') {
                //echo "Redirecionando para admin/admin_home.php";
                header("Location: admin/admin_home.php");
                exit;
            } else {
                //echo "Redirecionando para users/users_home.php";
                header("Location: users/users_home.php");
                exit;
            }
        } else {
            echo 'Usuário ou senha incorretos.';
        }
    } else {
        echo 'Usuário ou senha incorretos.';
    }
}
?>


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
            <li><a href="http://localhost/PRO3151/Lab11/index.php">Página Principal</a></li>
                <li><a href="http://localhost/PRO3151/Lab11/about.html">Sobre Nós</a></li>
                <li><a href="http://localhost/PRO3151/Lab11/login.php">Login</a></li>
                <li><a href="http://localhost/PRO3151/Lab11/catalogo.php">Catálogo</a></li>
                <li><a href="http://localhost/PRO3151/Lab11/busca.php">Localizar Livro</a></li>
                <li><a href="http://localhost/PRO3151/Lab11/users/carrinho.php">Carrinho</a></li>
            </ul>
        </nav>
    </header>

    <main class="login-container">
        <h2>Login</h2>
        <!-- Formulario de login -->
        <form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="username">Usuário:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Senha:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit" class="button">Entrar</button>
        </form>

        <p id="errorMessage" style="color: red;"></p>

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
