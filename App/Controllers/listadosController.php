<?php

namespace App\Controllers;

use App\Models\listadosModel;
use App\Models\MainModel;

class listadosController extends listadosModel
{
  /**
   * Funcion para listar todas las cotizaciones
   * @var array $cotizaciones - Informacion de las cotizaciones
   * @var string $row - Informacion de las cotizaciones
   *
   * @return string $row - Retorna la informacion de las cotizaciones
   *
  */
  public function listarAll()
  {
    $insListados = new listadosModel();
    $mainModel = new MainModel();

    foreach ($insListados->listarAll() as $cotizacion) {
      $usuario = $mainModel->ejecutarConsulta('SELECT * FROM users WHERE id = ' . $cotizacion['id_users'].'');

      $row = '
        <tr>
            <td>
              ' . $cotizacion['id'] . '
            </td>
            <td>
              ' . $this->formatearFecha($cotizacion['fecha']) . '
            </td>
            <td>
              ' . $cotizacion['nombre_cliente'] . '
            </td>
            <td>
              ' . $cotizacion['placa_carro'] . '
            </td>
            <td>
              ' . $cotizacion['modelo_carro'] . '
            </td>
            <td>
              ' . $cotizacion['ano_carro'] . '
            </td>
            <td>
              '.$usuario[0]['name'].' '.$usuario[0]['last_name'].'
            </td>
            <td>
              ' . $cotizacion['estado'] . '
            </td>
            <td>
              <div class="button-table-container">
                <button href="#"><i class="fas fa-eye"></i></button>
                <button href="#"><i class="fas fa-trash-alt"></i></button>
              </div>
            </td>
          </tr>

    ';

      echo $row;
    }
  }
  /**
   * Funcion para formatear la fecha
   * @var string $fecha - Informacion de la fecha
   *
   * @return string $fecha - Retorna la informacion de la fecha
  */
  private function formatearFecha($fecha){
    return date('d-m-Y', strtotime($fecha));
  }

  public function listarFiltradosEstatus($filtro)
  {
    $insListados = new listadosModel();
    return $insListados->listarFiltrados($filtro);
  }

  public function listarBuscador($busqueda)
  {
    $insListados = new listadosModel();
    return $insListados->listarBuscador($busqueda);
  }
}