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
    $cotizaciones = $this->getResumenModel();

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
    $cotizaciones = $this->getNroCotizacionesModel();

    foreach ($cotizaciones as $cotizacion) {
      $cotizaciones = $cotizacion['last_insert_id()'];
    }
    print_r($cotizaciones);
    // if ($cotizaciones == null || $cotizaciones == ""  || $cotizaciones == 0) {
    //   return 1;
    // }else{
    //   return json_encode($cotizaciones);
    // }
  }

  public function registrarCotizacion()
  {

    $fecha = $_POST['fecha'];
    $idCotizacion = $_POST['id_cotizacion'];
    $idUsers = $_POST['solicitante'];
    $nombreCliente = $_POST['cliente'];
    $modeloCarro = $_POST['modelo'];
    $anoCarro = $_POST['ano'];
    $placaCarro = $_POST['placa'];
    $vinCarro = $_POST['vin'];
    $datosRepuestos = $_POST['repuestos'];
    $notas = $_POST['notas'];
    $departamento = $_POST['departamento'];

    if (
      $nombreCliente == "" || $nombreCliente == null ||
      $modeloCarro == "" || $modeloCarro == null ||
      $anoCarro == "" || $anoCarro == null ||
      $placaCarro == "" || $placaCarro == null ||
      $vinCarro == "" || $vinCarro == null ||
      $notas == "" || $notas == null
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

    $datos_cotizacion = [
      "idCotizacion" => $idCotizacion,
      "fecha" => $fecha,
      "idUsers" => $idUsers,
      "nombreCliente" => $nombreCliente,
      "modeloCarro" => $modeloCarro,
      "anoCarro" => $anoCarro,
      "placaCarro" => $placaCarro,
      "vinCarro" => $vinCarro,
      "datosRepuestos" => $datosRepuestos,
      "notas" => $notas,
      "departamento" => $departamento
    ];

    if ($this->registrarCotizacionModel($datos_cotizacion)) {
      return ([
        "tipo" => "info",
        "titulo" => "Cotizacion registrada con exito",
        "icono" => "success"
      ]);
    }
  }
}
