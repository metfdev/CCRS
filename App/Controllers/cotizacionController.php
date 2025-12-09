<?php

namespace App\Controllers;

use App\Models\cotizacionModel;

class cotizacionController extends cotizacionModel
{

  /**
   * Calcula el resumen de las cotizaciones
   * @var array $cotizaciones
   * @var int $pendiente , $aprobado , $rechazado
   *
   * @return json Regresa un json con la informacion
  */
  public function calculoResumen (){
    $cotizaciones = $this->getResumen();

    $pendiente = 0;
    $aprobado = 0;
    $rechazado = 0;

    foreach ($cotizaciones as $cotizacion) {
      if ($cotizacion['estado'] == "pendiente") {
        $pendiente += 1;
      }elseif ($cotizacion['estado'] == "aprobado") {
        $aprobado += 1;
      }elseif ($cotizacion['estado'] == "rechazado") {
        $rechazado += 1;
      }
    }

    return json_encode(array("pendiente" => $pendiente, "aprobado" => $aprobado, "rechazado" => $rechazado));
  }

  /**
   * Calcula el total de cotizaciones
   * @var array $cotizaciones
   *
   * @return int Regresa la cantidad de cotizaciones
  */
  public function getNroCotizaciones () {
    $cotizaciones = $this->getResumen();
    return count($cotizaciones);
  }
}