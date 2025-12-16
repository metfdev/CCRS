<?php

namespace App\Models;

class viewsModel
{
  /**
   * obtenerVistasModelo
   *
   * @param string $vista
   * @var array $listaBlanca
   * @var string $contenido
   * @return string $contenido
   */
  protected function obtenerVistasModelo($vista)
  {
    $listaBlanca = ["home", "logout", "cotizar", "listados", "perfil", "aprobacion", "detalles"];

    if (in_array($vista, $listaBlanca)) {
      if (is_file("./Views/Content/" . $vista . "-view.php")) {
        $contenido = "./Views/Content/" . $vista . "-view.php";
      } else {
        $contenido = "404";
      }
    } elseif ($vista == "recovery") {
      $contenido = "recovery";
    } elseif ($vista == "login" || $vista == "index") {
      $contenido = "login";
    } else {
      $contenido = "404";
    }
    return $contenido;
  }
}
