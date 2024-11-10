<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    // Verificar si el nombre de usuario existe en la base de datos
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $old_password = $user['password'];

        // Validar que la nueva contraseña no repita al menos 4 caracteres consecutivos de la anterior
        $is_similar = false;
        for ($i = 0; $i <= strlen($old_password) - 4; $i++) {
            $substring = substr($old_password, $i, 4);
            if (strpos($new_password, $substring) !== false) {
                $is_similar = true;
                break;
            }
        }

        if ($is_similar) {
            echo "<p style='color: red;'>Erro: A nova senha deve ser diferente da anterior. Não pode conter 4 ou mais caracteres consecutivos iguais.</p>";
        } else {
            // Actualizar la contraseña en la base de datos sin encriptarla (¡No recomendado para producción!)
            $update_sql = "UPDATE users SET password = ? WHERE username = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param('ss', $new_password, $username); // Se almacena sin encriptar

            // Depuración para verificar si la consulta de actualización funciona
            if ($update_stmt->execute()) {
                echo "<p style='color: green;'>Senha atualizada com sucesso!</p>";
            } else {
                echo "<p style='color: red;'>Erro ao atualizar a senha: " . $conn->error . "</p>";
            }
        }
    } else {
        echo "<p style='color: red;'>Usuário não encontrado.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Recuperar Senha</title>
    <style>
        .back-to-login {
            font-size: 14px;
            text-align: center;
            margin: 15px 0;
        }

        .back-to-login a {
            text-decoration: none;
            color: #007bff;
        }

        .back-to-login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Portal do Saber</h1>
    </header>
    <main>
        <h2>Recuperar Senha</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="username">Digite seu nome de usuário:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="new_password">Digite sua nova senha:</label><br>
            <input type="password" id="new_password" name="new_password" required><br><br>
            <button type="submit" class="button">Alterar Senha</button>
        </form>

        <!-- Enlace para volver a la página de login -->
        <p class="back-to-login"><a href="login.php">Voltar para a página de login</a></p>
    </main>
    <footer>
        <p>© 2024 Portal do Saber. Todos os direitos reservados.</p>
    </footer>
</body>
</html>

