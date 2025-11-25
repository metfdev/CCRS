<?php

namespace App\Models;

use App\Models\MainModel;

class LoginModel extends MainModel
{

  public function veriftUser($user, $pass)
  {
    $sql = "SELECT * FROM users WHERE user = :user AND pass = :pass";
    $query = $this->connect()->prepare($sql);
    $query->execute(['user' => $this->limpiarCadena($user), 'pass' => $this->limpiarCadena($pass)]);
    $result = $query->fetchAll();
    return $result;
  }

  public function verifytEmail($email)
  {
    $sql = "SELECT * FROM users WHERE email = :email";
    $query = $this->connect()->prepare($sql);
    $query->execute(['email' => $this->limpiarCadena($email)]);
    $result = $query->fetchAll();
    if ($result->rowCount() > 0) {
      return true;
      exit;
    }
    return false;
  }

  public function registrarUsuario($dataRegistro)
  {
    $sql = "INSERT INTO users (name, last_name, email, pass, cargo, departamento) VALUES (:name, :last_name, :email, :user, :pass, :cargo, :departamento)";
    $query = $this->connect()->prepare($sql);
    $query->execute([
      'name' => $this->limpiarCadena($dataRegistro['nombre']),
      'apellido' => $this->limpiarCadena($dataRegistro['last_name']),
      'email' => $this->limpiarCadena($dataRegistro['email']),
      'pass' => $this->limpiarCadena($dataRegistro['pass']),
      'cargo' => $this->limpiarCadena($dataRegistro['cargo']),
      'departamento' => $this->limpiarCadena($dataRegistro['departamento'])
    ]);

    if ($query) {
      return true;
      exit;
    }
    return false;
  }
}
