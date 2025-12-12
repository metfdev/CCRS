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
  public function calculoResumen()
  {
    $cotizaciones = $this->getResumen();

    $pendiente = 0;
    $aprobado = 0;
    $rechazado = 0;

    foreach ($cotizaciones as $cotizacion) {
      if ($cotizacion['estado'] == "pendiente") {
        $pendiente += 1;
      } elseif ($cotizacion['estado'] == "aprobado") {
        $aprobado += 1;
      } elseif ($cotizacion['estado'] == "rechazado") {
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
  public function getNroCotizaciones()
  {
    $cotizaciones = $this->getResumen();
    return count($cotizaciones);
  }

  public function registrarCotizacion()
  {

    $fecha = $_POST['fecha'];
    $idUsers = $_POST['idUsers'];
    $nombreCliente = $_POST['nombreCliente'];
    $modeloCarro = $_POST['modeloCarro'];
    $anoCarro = $_POST['anoCarro'];
    $placaCarro = $_POST['placaCarro'];
    $vinCarro = $_POST['vinCarro'];
    $datosRepuestos = $_POST['datosRepuestos'];
    $notas = $_POST['notas'];
    $estado = $_POST['estado'];

    if (
      $nombreCliente == "" || $nombreCliente == null ||
      $modeloCarro == "" || $modeloCarro == null ||
      $anoCarro == "" || $anoCarro == null ||
      $placaCarro == "" || $placaCarro == null ||
      $vinCarro == "" || $vinCarro == null ||
      $notas == "" || $notas == null ||
      $estado == "" || $estado == null
    ) {
      return ([
        "tipo" => "simple",
        "titulo" => 'No has llenado todos los campos que son obligatorios',
        "icono" => "error"
      ]);
    }

    if (strlen($vinCarro) != 17) {
      return ([
        "tipo" => "simple",
        "titulo" => 'VIN incorrecto',
        "texto" => 'El VIN debe tener 17 caracteres',
        "icono" => "error"
      ]);
    }

    if ($datosRepuestos == "" || $datosRepuestos == null || $datosRepuestos == "[]") {
      return ([
        "tipo" => "simple",
        "texto" => 'No has agregado ningun repuesto',
        "titulo" => 'Error al registrar la cotizacion',
        "icono" => "error"
      ]);
    }

    $datos = [
      "fecha" => $fecha,
      "idUsers" => $idUsers,
      "nombreCliente" => $nombreCliente,
      "modeloCarro" => $modeloCarro,
      "anoCarro" => $anoCarro,
      "placaCarro" => $placaCarro,
      "vinCarro" => $vinCarro,
      "datosRepuestos" => $datosRepuestos,
      "notas" => $notas,
      "estado" => $estado
    ];

    if ($this->registrarCotizacionModel($datos)){
      return ([
        "tipo" => "simple",
        "titulo" => "Cotizacion registrada con exito",
        "icono" => "success"
      ]);
    }
  }

  public function addRepuesto()
  {
    $idRepuesto = $_POST['idRepuesto'];
    $
    $cantidad = $_POST['cantidad'];
  }


}