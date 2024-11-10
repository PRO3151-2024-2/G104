<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP para Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'PortaldoSaber3151@gmail.com';
        $mail->Password = 'qdxq ejji rvaz ovps';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurações do e-mail
        $mail->setFrom('PortaldoSaber3151@gmail.com', 'Portal Do Saber - Livraria');
        $mail->addAddress($email, $nome);

        $mail->isHTML(true);
        $mail->Subject = 'Obrigado pelo seu contato!';
        $mail->Body    = "<h1>Obrigado, $nome!</h1><p>Recebemos sua mensagem: \"$mensagem\". Retornaremos em breve.</p>";

        $mail->send();
        header('Location: obrigado.php');
        exit();
    } catch (Exception $e) {
        echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
} else {
    echo "Acesso inválido.";
}
