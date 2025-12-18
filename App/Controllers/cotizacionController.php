<?php

namespace App\Controllers;

use App\Models\cotizacionModel;
use App\Models\MainModel;

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
      $ultima_cotizacion = $cotizacion['max_id'] + 1;
    }
    return $ultima_cotizacion;
  }

  /**
   * Registra una nueva cotizacion
   * @var string $fecha , $idCotizacion , $idUsers , $nombreCliente , $modeloCarro , $anoCarro , $placaCarro , $vinCarro , $datosRepuestos , $notas, $departamento
   * @var array $dataCotizacion
   *
   *
   * @return json Regresa un json con la informacion de la accion
   *
   */
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
    } else {
      return ([
        "tipo" => "simple",
        "titulo" => 'Error al registrar la cotizacion',
        "icono" => "error"
      ]);
    }
  }

  public function detallesCotizacion($idCotizacion, $operacion)
  {
    $mainModel = new MainModel();
    if ($operacion == "Ver") {
      $cotizacion = $this->getDetallesCotizacionModel($idCotizacion);
      if ($cotizacion == null || count($cotizacion) == 0 || $cotizacion == false || $cotizacion == [] || $cotizacion == "[]" || $cotizacion == "null") {
        return ([
          "tipo" => "simple",
          "titulo" => 'No se encontro la cotizacion',
          "icono" => "error"
        ]);
      }
      foreach ($cotizacion as $detallesCotizacion) {
        $id = $detallesCotizacion['id'];
        $fecha = $detallesCotizacion['fecha'];
        $idUsers = $detallesCotizacion['id_users'];
        $nombreCliente = $detallesCotizacion['nombre_cliente'];
        $modeloCarro = $detallesCotizacion['modelo_carro'];
        $anoCarro = $detallesCotizacion['ano_carro'];
        $placaCarro = $detallesCotizacion['placa_carro'];
        $vinCarro = $detallesCotizacion['vin_carro'];
        $datosRepuestos = $detallesCotizacion['data_repuestos'];
        $notas = $detallesCotizacion['nota'];
        $departamento = $detallesCotizacion['departamento'];
      }

      $usuario = $mainModel->ejecutarConsulta("SELECT * FROM users WHERE id = " . $idUsers . "");
      foreach ($usuario as $user) {
        $solicitante = $user['name'] . ' ' . $user['last_name'];
      }

      $datosRepuestos = json_decode($datosRepuestos);


      $Detalles = '
      <h1 class="text-center" id="title-listados">Vista de Cotizacion</h1>
      <div class="listados-container" id="listados-container">
        <div id="Aprobacion-form" class="Aprobacion-form">
          <div class="cotizar-form-container">
            <header class="cotizar-header">
              <div class="cotizar-header-solicitante">
                <div>
                  <label for="nro">Nro.:</label>
                  <input class="nro" type="text" name="nro" id="nro" value="' . $id . '" disabled>
                </div>
                <div>
                  <label for="solicitante">Solicitante:</label>
                  <input type="hidden" id="id_solicitante" value= disabled>
                  <input type="text" name="solicitante" id="solicitante" value="' . $solicitante . '" disabled>
                </div>
                <div>
                  <label for="dpto">Dpto.:</label>
                  <input class="dpto" type="text" name="dpto" id="dpto" value="' . $departamento . '" disabled>
                </div>
              </div>
              <div class="cotizar-header-fecha">
                <label for="fecha">Fecha:</label>
                <input type="text" name="fecha" id="fecha" value="' . $fecha . '" disabled>
              </div>
            </header>
            <section class="cotizar-main">
              <div class="contenedor-datos-cliente">
                <div>
                  <label for="cliente">Cliente:</label>
                  <input type="text" name="cliente" id="cliente" value="' . $nombreCliente . '" disabled>
                </div>
                <div>
                  <label for="modelo">Modelo:</label>
                  <input type="text" name="modelo" id="modelo" value="' . $modeloCarro . '" disabled >
                </div>
                <div>
                  <label for="ano">Año:</label>
                  <input class="input-ano" type="number" name="ano" id="ano" value="' . $anoCarro . '" disabled>
                </div>
                <div>
                  <label for="placa">Placa:</label>
                  <input type="text" name="placa" id="placa" value="' . $placaCarro . '" disabled>
                </div>
                <div>
                  <label for="vin">VIN:</label>
                  <input type="text" name="vin" id="vin" maxlength="17" minlength="17" value="' . $vinCarro . '" disabled>
                </div>
              </div>
              <section class="cotizar-main-contenedor">
                <div class="cotizar-main-contenedor-left">
                  <div class="contenedor-notas">
                    <label for="notas">Notas:</label>
                    <textarea class="notas" type="text" name="notas" id="notas" disabled>' . $notas . '</textarea>
                  </div>
                </div>
                <div class="cotizar-main-contenedor-right">
                  <table>
                    <thead>
                      <tr>
                        <th>Nro. parte</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Monto</th>
                      </tr>
                    </thead>';

      for ($i = 0; $i < count($datosRepuestos); $i++) {
        $Detalles .= '
                      <tbody id="tbody_cotizacion_repuestos">
                        <tr>
                          <td>' . $datosRepuestos[$i]->nroParte . '</td>
                          <td>' . $datosRepuestos[$i]->nombre . '</td>
                          <td>' . $datosRepuestos[$i]->cantidad . '</td>
                          <td class="monto_repuesto">' . $datosRepuestos[$i]->monto . '</td>
                        </tr>
                      </tbody>';
      }

      $Detalles .= '
                  </table>
                </div>
              </section>
            </section>
            <div class="form-container-buttons">
              <button id="button-exportar" class="button-cotizar">Exportar</button>
              <button id="button-cerrar" class="button-limpiar">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      ';
      return ([
        "Detalles" => $Detalles,
        "icono" => "success"
      ]);
    } elseif ($operacion == "Aprobar") {
      $cotizacion = $this->getDetallesCotizacionModel($idCotizacion);
      if ($cotizacion == null || count($cotizacion) == 0 || $cotizacion == false || $cotizacion == [] || $cotizacion == "[]" || $cotizacion == "null") {
        return ([
          "tipo" => "simple",
          "titulo" => 'No se encontro la cotizacion',
          "icono" => "error"
        ]);
      }
      foreach ($cotizacion as $detallesCotizacion) {
        $id = $detallesCotizacion['id'];
        $fecha = $detallesCotizacion['fecha'];
        $idUsers = $detallesCotizacion['id_users'];
        $nombreCliente = $detallesCotizacion['nombre_cliente'];
        $modeloCarro = $detallesCotizacion['modelo_carro'];
        $anoCarro = $detallesCotizacion['ano_carro'];
        $placaCarro = $detallesCotizacion['placa_carro'];
        $vinCarro = $detallesCotizacion['vin_carro'];
        $datosRepuestos = $detallesCotizacion['data_repuestos'];
        $notas = $detallesCotizacion['nota'];
        $departamento = $detallesCotizacion['departamento'];
      }

      $usuario = $mainModel->ejecutarConsulta("SELECT * FROM users WHERE id = " . $idUsers . "");
      foreach ($usuario as $user) {
        $solicitante = $user['name'] . ' ' . $user['last_name'];
      }

      $datosRepuestos = json_decode($datosRepuestos);

      $Detalles = '
      <h1 class="text-center" id="title-listados">Aprobar Cotizacion</h1>
      <div class="listados-container" id="listados-container">
        <div id="Aprobacion-form" class="Aprobacion-form">
          <div class="cotizar-form-container">
            <header class="cotizar-header">
              <div class="cotizar-header-solicitante">
                <div>
                  <label for="nro">Nro.:</label>
                  <input class="nro" type="text" name="nro" id="nro" value="' . $id . '" disabled>
                </div>
                <div>
                  <label for="solicitante">Solicitante:</label>
                  <input type="hidden" id="id_solicitante" value= disabled>
                  <input type="text" name="solicitante" id="solicitante" value="' . $solicitante . '" disabled>
                </div>
                <div>
                  <label for="dpto">Dpto.:</label>
                  <input class="dpto" type="text" name="dpto" id="dpto" value="' . $departamento . '" disabled>
                </div>
              </div>
              <div class="cotizar-header-fecha">
                <label for="fecha">Fecha:</label>
                <input type="text" name="fecha" id="fecha" value="' . $fecha . '" disabled>
              </div>
            </header>
            <section class="cotizar-main">
              <div class="contenedor-datos-cliente">
                <div>
                  <label for="cliente">Cliente:</label>
                  <input type="text" name="cliente" id="cliente" value="' . $nombreCliente . '" disabled>
                </div>
                <div>
                  <label for="modelo">Modelo:</label>
                  <input type="text" name="modelo" id="modelo" value="' . $modeloCarro . '" disabled >
                </div>
                <div>
                  <label for="ano">Año:</label>
                  <input class="input-ano" type="number" name="ano" id="ano" value="' . $anoCarro . '" disabled>
                </div>
                <div>
                  <label for="placa">Placa:</label>
                  <input type="text" name="placa" id="placa" value="' . $placaCarro . '" disabled>
                </div>
                <div>
                  <label for="vin">VIN:</label>
                  <input type="text" name="vin" id="vin" maxlength="17" minlength="17" value="' . $vinCarro . '" disabled>
                </div>
              </div>
              <section class="cotizar-main-contenedor aprobacion">
                <div class="cotizar-main-contenedor-right">
                  <table>
                    <thead>
                      <tr>
                        <th>Nro. parte</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Monto</th>
                      </tr>
                    </thead>';

      for ($i = 0; $i < count($datosRepuestos); $i++) {
        $Detalles .= '
                      <tbody id="tbody_cotizacion_repuestos">
                        <tr>
                          <td>' . $datosRepuestos[$i]->nroParte . '</td>
                          <td>' . $datosRepuestos[$i]->nombre . '</td>
                          <td>' . $datosRepuestos[$i]->cantidad . '</td>
                          <td><input class="input-monto" type="text" name="monto" id="monto" value=""></td>
                        </tr>
                      </tbody>';
      }

      $Detalles .= '</tbody>
                  </table>
                </div>
                <div class="cotizar-main-contenedor-left">
                  <div class="contenedor-notas">
                    <label for="notas">Notas:</label>
                    <textarea class="notas" type="text" name="notas" id="notas" disabled>' . $notas . '</textarea>
                  </div>
                </div>
              </section>
            </section>
            <div class="form-container-buttons">
              <button id="button-aprobar" class="button-cotizar">Aprobar</button>
              <button id="button-rechazar" class="button-rechazar">Rechazar</button>
              <button id="button-cerrar" class="button-limpiar">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      ';
      return ([
        "Detalles" => $Detalles,
        "icono" => "success"
      ]);
    }
  }


  public function updateStatusCotizacion($id, $status,$repuestos=[])
  {
    session_start();
    if($this->updateRepuestosModel($id, $repuestos)){
      if($this->updateStatusCotizacionModel($id, $status, $_SESSION['id'],$repuestos=[])){
        return json_encode([
          "icono" => "success",
          "texto" => "Cotizacion " . $status,
          "tipo" => "recargar"
        ]);
      }else{
        return  json_encode([
          "icono" => "error",
          "texto" => "Error al " . $status,
          "tipo" => "recargar"
        ]);
      }
    }else{
      return  json_encode([
        "icono" => "error",
        "texto" => "Error al " . $status,
        "tipo" => "recargar"
      ]);
    }
  }

  public function deleteCotizacion($id)
  {
    if($this->deleteCotizacionModel($id)){
      return ([
        "icono" => "success",
        "texto" => "Cotizacion Eliminada",
        "tipo" => "recargar"
      ]);
    }else{
      return ([
        "icono" => "error",
        "texto" => "Error al Eliminar",
        "tipo" => "recargar"
      ]);
    }
  }

}
