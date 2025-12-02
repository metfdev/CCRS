<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class MailController
{

  public function sendMailRecovery($email, $token)
  {

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {

      $mail->isSMTP();
      $mail->Host = MAIL_HOST;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'ssl';
      $mail->Port = MAIL_PORT;

      $mail->Username = MAIL_USERNAME;
      $mail->Password = MAIL_PASS;

      $mail->setFrom('PRUEBA@example.com', 'Recuperar contraseña');
      $mail->addAddress($email);

      $mail->isHTML(true);
      $mail->CharSet = 'UTF-8';

      $mail->Subject = 'Recuperar contraseña';
      $mail->Body = 'Para recuperar tu contraseña haz click en el siguiente enlace: <a href="' . APP_URL . 'recover/' . $token . '">Recuperar contraseña</a>';

      if ($mail->send()) {
        return "Correo enviado exitosamente";
      }
    } catch (\PHPMailer\PHPMailer\Exception $e) {
      echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
  }
}
