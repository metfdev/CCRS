<?php

namespace App\Controllers;

require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../libraries/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../libraries/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../../libraries/PHPMailer/src/Exception.php';


class MailController
{

  public function sendMailRecovery($email, $token)
  {

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {

      $mail->isSMTP();
      $mail->Host       = MAIL_HOST;   // Servidor SMTP (Ej: smtp.gmail.com)
      $mail->SMTPAuth   = true;
      $mail->Username   = MAIL_USERNAME;  // Tu correo
      $mail->Password   = MAIL_PASS;      // Tu contraseña
      $mail->SMTPSecure = 'tls';          // Encriptación TLS o ssl
      $mail->Port       = MAIL_PORT;      // Puerto SMTP

      $mail->setFrom('PRUEBA@example.com', 'Recuperar contraseña');
      $mail->addAddress($email);

      $mail->isHTML(true);
      $mail->CharSet = 'UTF-8';

      $mail->Subject = 'APP CCRS Recuperar contraseña';
      $mail->Body = 'Este es tu codigo de recuperacion:"'. $token ;

      if ($mail->send()) {
        return "Correo enviado exitosamente";
      }
    } catch (\PHPMailer\PHPMailer\Exception $e) {
      echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
  }
}
