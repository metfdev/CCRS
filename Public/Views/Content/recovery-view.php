<?php
use App\Controllers\MailController;

$mail = new MailController();
$email ="miguelticaray@gmail.com";
$token = "token";
echo $mail->sendMailRecovery($email, $token);