<?php

namespace App\Controllers;

use App\Models\viewsModel;

class viewsController extends viewsModel
{

  /**
   * obtenerVistasControlador
   *
   * @param string $vista
   * @var string $respuesta
   * @return string
   *
  */
  public function obtenerVistasControlador($vista)
  {
    if ($vista != "") {
      $respuesta = $this->obtenerVistasModelo($vista);
    } else {
      $respuesta = "login";
    }
    return $respuesta;
    exit();
  }
}
