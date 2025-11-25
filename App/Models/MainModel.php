<?php

namespace App\Models;

use \PDO;
use \PDOException;

if (file_exists(__DIR__ . "/../../config/server.php")) {
  require_once __DIR__ . "/../../config/server.php";
}

class MainModel
{

  /**
   * Funcion para conectar a la base de datos
   *
   * @return object $pdo Retorna la conexion a la base de datos
   */
  protected function connect()
  {
    try {
      $pdo = new PDO(DNS, DB_USER, DB_PASS, OPTIONS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
      return $pdo;
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  /**
   * Funcion para ejecutar consultas a la base de datos
   *
   * @param string $consulta Consulta a la base de datos
   * @return object $sql Retorna la consulta a la base de datos
   */
  protected function ejecutarConsulta($consulta)
  {
    $sql = $this->connect()->prepare($consulta);
    $sql->execute();
    return $sql;
  }

  /**
   * Funcion para limpiar cadenas
   *
   * @param string $cadena Cadena a limpiar
   * @var array $palabras Palabras prohibidas
   * @return string $cadena Cadena limpia
   */
  public function limpiarCadena($cadena)
  {

    $palabras = ["<script>", "</script>", "<script src", "<script type=", "SELECT * FROM", "SELECT ", " SELECT ", "DELETE FROM", "INSERT INTO", "DROP TABLE", "DROP DATABASE", "TRUNCATE TABLE", "SHOW TABLES", "SHOW DATABASES", "<?php", "?>", "--", "^", "<", ">", "==", ";", "::"];

    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);

    foreach ($palabras as $palabra) {
      $cadena = str_ireplace($palabra, "", $cadena);
    }

    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);

    return $cadena;
  }

}
