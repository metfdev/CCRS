<?php

namespace App\Controllers;

use App\Models\LoginModel;

class LoginController extends LoginModel
{

  /**
   * Funcion para iniciar sesion
   *
   * @param string $email Correo del usuario
   * @param string $pass Contraseña del usuario
   * @var string $userVerify Informacion del usuario
   *
   * @return array Regresa un array con la informacion de inicio de sesion
   *
   */
  public function iniciarSesion($email, $pass)
  {

    if (empty($email) || empty($pass)) {
      return([
        "tipo" => "simple",
        "titulo" => 'Error al iniciar sesion',
        "texto" => 'No has llenado todos los campos que son obligatorios',
        "icono" => "error"
      ]);
    };

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return([
        "tipo" => "simple",
        "titulo" => 'Error al iniciar sesion',
        "texto" => 'El correo es incorrecto',
        "icono" => "error"
      ]);
    };

    $userVerify = $this->getUser($email);

    if ($userVerify['status'] == true) {

      if (!password_verify($pass, $userVerify['user'][0]['pass'])) {
        return([
          "tipo" => "simple",
          "titulo" => 'Error al iniciar sesion',
          "texto" => 'La contraseña es incorrecta',
          "icono" => "error"
        ]);
      } else {

        $_SESSION['id'] = $userVerify['user'][0]['id'];
        $_SESSION['user'] = $userVerify['user'][0]['name'] . ' ' . $userVerify['user'][0]['last_name'];
        $_SESSION['email'] = $userVerify['user'][0]['email'];
        $_SESSION['cargo'] = $userVerify['user'][0]['cargo'];
        $_SESSION['departamento'] = $userVerify['user'][0]['departamento'];
        $_SESSION['rol'] = $userVerify['user'][0]['rol'];

        return([
          "tipo" => "simple",
          "titulo" => 'Bienvenido ' . $userVerify['user'][0]['name'] . ' ' . $userVerify['user'][0]['last_name'],
          "icono" => "success",
        ]);
      }
    }else{
      return([
        "tipo" => "simple",
        "titulo" => 'Error al iniciar sesion',
        "texto" => 'Usuario no registrado',
        "icono" => "error"
      ]);
    }
  }

  /**
   * Funcion para registrar un nuevo usuario
   *
   * @param array $dataRegistro Datos del nuevo usuario
   * @var string $passHash Contraseña encriptada
   * @return json Regresa un json con la informacion de la accion
   *
   */
  public function registrarUsuario($dataRegistro)
  {

    if (empty($dataRegistro)) {
      return ([
        "tipo" => "simple",
        "titulo" => 'No has llenado todos los campos que son obligatorios',
        "icono" => "error"
      ]);
    }

    if (empty($dataRegistro['nombre']) || empty($dataRegistro['apellido']) || empty($dataRegistro['cargo']) || empty($dataRegistro['departamento'])) {
      return ([
        "tipo" => "simple",
        "titulo" => 'No has llenado todos los campos que son obligatorios',
        "icono" => "error"
      ]);
    }

    if (!filter_var($dataRegistro['email'], FILTER_VALIDATE_EMAIL)) {
      return ([
        "tipo" => "simple",
        "titulo" => 'El correo no es valido',
        "icono" => "error"
      ]);
    }

    if ($this->verifytEmail($dataRegistro['email'])) {
      return ([
        "tipo" => "simple",
        "titulo" => 'El correo ya se encuentra registrado',
        "icono" => "error"
      ]);
    }

    if ($dataRegistro['pass'] != $dataRegistro['pass2']) {
      return ([
        "tipo" => "simple",
        "titulo" => 'Las contraseñas no coinciden',
        "icono" => "error"
      ]);
    }

    $passHash = $this->encryptPassword($dataRegistro['pass']);

    if ($this->registrar($dataRegistro, $passHash)) {
      return ([
        "tipo" => "simple",
        "titulo" => 'El usuario se ha registrado correctamente',
        "icono" => "success"
      ]);
    } else {
      return ("error");
    }
  }

  /**
   * Funcion para encriptar la contraseña
   *
   * @param string $pass Contraseña a encriptar
   * @return string Contraseña encriptada
   *
   */
  protected function encryptPassword($pass)
  {
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    return $pass;
  }

  /**
   * Funcion para cerrar la sesion
   *
   * @return json Regresa un json con la informacion de la accion
   *
   */
  public function cerrarSesion()
  {
    session_start();
    session_unset();
    session_destroy();
    return json_encode([
      "tipo" => "simple",
      "titulo" => 'Sesion cerrada correctamente',
      "icono" => "success",
      "url" => "login"
    ]);
  }
}
