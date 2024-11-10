<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Entre em Contato</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Entre em Contato Conosco</h2>
    <form action="enviar.php" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="mensagem">Mensagem:</label><br>
        <textarea id="mensagem" name="mensagem" required></textarea><br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
