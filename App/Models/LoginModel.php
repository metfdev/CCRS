<?php

namespace App\Models;

use App\Models\MainModel;

class LoginModel extends MainModel
{

  /**
   * Funcion para obtener informacion de un usuario
   *
   * @param string $email Correo del usuario
   * @var string $sql Consulta a la base de datos
   * @var object $query Consulta a la base de datos
   * @var array $result Informacion del usuario
   * @var boolean $status Status de la consulta
   * @return array Regresa un array con el status de la consulta y la informacion del usuario
   *
   */
  public function getUser($email)
  {
    $sql = "SELECT * FROM users WHERE  email = :email";
    $query = $this->connect()->prepare($sql);
    $query->execute(['email' => $this->limpiarCadena($email)]);
    $result = $query->fetchAll();
    if (count($result) > 0) {
      return [
        'status' => true,
        'user' => $result
      ];
    } else {
      return [
        'status' => false,
        'user' => $result
      ];
    }
  }

  /**
   * Funcion para verificar si existe el correo del usuario
   *
   * @param string $email Correo del usuario
   * @var string $sql Consulta a la base de datos
   * @var object $query Consulta a la base de datos
   * @var array $result Informacion del usuario
   * @return boolean Regresa un booleano
   *
   */
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

  /**
   * Funcion para registrar un nuevo usuario
   *
   * @param array $dataRegistro Datos del nuevo usuario
   * @var string $sql Consulta a la base de datos
   * @var object $query Consulta a la base de datos
   * @return boolean Regresa un booleano
   *
   */
  public function registrar($dataRegistro, $passHash)
  {
    $sql = "INSERT INTO users (name, last_name, email, pass, cargo, departamento,rol) VALUES (:name, :apellido, :email, :pass, :cargo, :departamento, :rol)";
    $query = $this->connect()->prepare($sql);
    $query->execute([
      ':name' => $this->limpiarCadena($dataRegistro['nombre']),
      ':apellido' => $this->limpiarCadena($dataRegistro['apellido']),
      ':email' => $this->limpiarCadena($dataRegistro['email']),
      ':pass' => $this->limpiarCadena($passHash),
      ':cargo' => $this->limpiarCadena($dataRegistro['cargo']),
      ':departamento' => $this->limpiarCadena($dataRegistro['departamento']),
      ':rol' => $this->limpiarCadena($dataRegistro['rol']),
    ]);

    if ($query) {
      return true;
      exit;
    }
    return false;
  }
}
