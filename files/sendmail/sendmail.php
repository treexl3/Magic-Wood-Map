<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('uk', 'phpmailer/language/');
$mail->IsHTML(true);

$name = $_POST["name"];
$email = $_POST["email"];

$mail->isSMTP(); //Send using SMTP
$mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
$mail->SMTPAuth = true; //Enable SMTP authentication
$mail->Username = 'denikquadro@gmail.com'; //SMTP username
$mail->Password = 'stgkmzdqcetvdbhj'; //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
$mail->Port = 465; // 587

//Від кого лист
$mail->setFrom("denikquadro@gmail.com", "Denys"); // Вказати потрібний E-mail
//Кому відправити
$mail->addAddress($email, $name); // Вказати потрібний E-mail
//Тема листа
$mail->Subject = 'Вітання! Це "Фрілансер по життю"';

//Тіло листа
$body = '<h1>Зустрічайте супер листа!</h1>';

//if(trim(!empty($_POST['email']))){
//$body.=$_POST['email'];
//}	

/*
  //Прикріпити файл
  if (!empty($_FILES['image']['tmp_name'])) {
	  //шлях завантаження файлу
	  $filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
	  //грузимо файл
	  if (copy($_FILES['image']['tmp_name'], $filePath)){
		  $fileAttach = $filePath;
		  $body.='<p><strong>Фото у додатку</strong>';
		  $mail->addAttachment($fileAttach);
	  }
  }
  */

$mail->Body = $body;

//Відправляємо
if (!$mail->send()) {
	$message = 'Помилка';
} else {
	$message = 'Дані надіслані!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>