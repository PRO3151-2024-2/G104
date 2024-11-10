<?php
include 'connection.php'; // Certifique-se de que a conexão está correta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Hash para maior segurança
    $role = 'user'; // Define o papel como "user" por padrão

    // Verifica se o usuário já existe
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Usuário já existe. Escolha outro nome de usuário.";
    } else {
        // Insere o novo usuário no banco de dados com o role "user"
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $password, $role);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
            header("Location: login.php");
            exit();
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cadastro de Novo Usuário</title>
</head>
<body>
    <header>
        <h1>Portal do Saber</h1>
        <nav>
            <ul>
                <li><a href="index.php">Página Principal</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <main class="register-container">
        <h2>Cadastro de Novo Usuário</h2>
        <form method="post" action="registro.php">
            <label for="username">Nome de Usuário:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Senha:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit" class="button">Cadastrar</button>
        </form>
    </main>

    <footer>
        <p>© 2024 Portal do Saber. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
