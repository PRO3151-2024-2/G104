<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Limpa o carrinho após a conclusão
include 'connection.php';
$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM carrinho WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();

echo '<h1>Obrigado pela sua compra!</h1>';
echo '<p>Sua compra está em processamento. Em breve, entraremos em contato com você.</p>';
?>
