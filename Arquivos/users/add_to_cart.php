<?php
session_start();
header('Content-Type: application/json');
include '../connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$user_id = $_SESSION['user_id'];
$livro_id = $data['bookId'];

if (!$livro_id) {
    echo json_encode(['success' => false, 'message' => 'ID do livro não fornecido']);
    exit;
}

// Busca o preço do livro na tabela pre__os
$precoQuery = "SELECT preco FROM pre__os WHERE id_livro = ?";
$precoStmt = $conn->prepare($precoQuery);
$precoStmt->bind_param('i', $livro_id);
$precoStmt->execute();
$precoResult = $precoStmt->get_result();
$preco = $precoResult->fetch_assoc()['preco'];

if ($preco === null) {
    echo json_encode(['success' => false, 'message' => 'Preço não encontrado']);
    exit;
}

// Insere o item no carrinho com o preço
$sql = "INSERT INTO carrinho (user_id, livro_id, preco, quantidade) VALUES (?, ?, ?, 1)
        ON DUPLICATE KEY UPDATE quantidade = quantidade + 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param('iid', $user_id, $livro_id, $preco);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Livro adicionado ao carrinho']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao adicionar ao carrinho']);
}
?>
