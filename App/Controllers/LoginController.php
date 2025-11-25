<?php

namespace App\Controllers;

use App\Models\LoginModel;

class LoginController extends LoginModel
{

  /**
   * Funcion para iniciar sesion
   *
   * @param string $user Correo del usuario
   * @param string $pass Contraseña del usuario
   *
   */
  public function iniciarSesion($user, $pass)
  {

    if (empty($user) || empty($pass)) {
      return json_encode([
        "tipo" => "simple",
        "titulo" => 'No has llenado todos los campos que son obligatorios',
        "icono" => "error"
      ]);
    };

    if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
      return json_encode([
        "tipo" => "simple",
        "titulo" => 'El correo no es valido',
        "icono" => "error"
      ]);
    };

    if ($this->veriftUser($user, $pass)) {
      return json_encode([
        "tipo" => "simple",
        "titulo" => 'El usuario se ha logueado correctamente',
        "icono" => "success"
      ]);
    }
  }

  public function registrarUsuario($dataRegistro)
  {

    if (empty($dataRegistro)) {
      return json_encode([
        "tipo" => "simple",
        "titulo" => 'No has llenado todos los campos que son obligatorios',
        "icono" => "error"
      ]);
    }

    if (!filter_var($dataRegistro['email'], FILTER_VALIDATE_EMAIL)) {
      return json_encode([
        "tipo" => "simple",
        "titulo" => 'El correo no es valido',
        "icono" => "error"
      ]);
    }

    if ($dataRegistro['pass'] != $dataRegistro['pass2']) {
      return json_encode([
        "tipo" => "simple",
        "titulo" => 'Las contraseñas no coinciden',
        "icono" => "error"
      ]);
    }
    if (empty($dataRegistro['nombre']) || empty($dataRegistro['apellido']) || empty($dataRegistro['cargo']) || empty($dataRegistro['departamento'])) {
      return json_encode([
        "tipo" => "simple",
        "titulo" => 'No has llenado todos los campos que son obligatorios',
        "icono" => "error"
      ]);
    }

    if ($this->verifytEmail($dataRegistro['email'])) {
      return json_encode([
        "tipo" => "simple",
        "titulo" => 'El correo ya se encuentra registrado',
        "icono" => "error"
      ]);
    }

    $passHash = $this->encryptPassword($dataRegistro['pass']);

    if($this -> registrarUsuario($dataRegistro)){
      return json_encode([
        "tipo" => "simple",
        "titulo" => 'El usuario se ha registrado correctamente',
        "icono" => "success"
      ]);
    }else {
      return json_encode("error");
    }

  }

  protected function encryptPassword($pass)
  {

    $pass = password_hash($pass, PASSWORD_DEFAULT);
    return $pass;
  }

  public function cerrarSesion() {}
}
