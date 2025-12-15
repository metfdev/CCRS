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
  public function listarAll($id = null)
  {
    $insListados = new listadosModel();
    $mainModel = new MainModel();

    $cotizaciones = $id == null ? $insListados->listarAll() : $insListados->listarPendientes();

    foreach ( $cotizaciones as $cotizacion) {
      if ($cotizacion['id_usuario_aprueba'] == null) {
        $usuario_aprueba[0]['name'] = 'No ha sido';
        $usuario_aprueba[0]['last_name'] = 'aprobado';
      } else {
        $usuario_aprueba = $mainModel->ejecutarConsulta('SELECT * FROM users WHERE id = ' . $cotizacion['id_usuario_aprueba'] . '');
      }

      $id_cotizacion = $mainModel->ejecutarConsulta('SELECT * FROM cotizaciones WHERE id = ' . $cotizacion['id_cotizacion'] . '');

      $usuario_creador = $mainModel->ejecutarConsulta('SELECT * FROM users WHERE id = ' . $id_cotizacion[0]['id_users'] . '');

      $icono_table = $cotizacion['id_usuario_aprueba'] == null && $cotizacion['estado'] == 'pendiente' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-eye"></i>';

      $row = '
        <tr>
            <td>
              ' . $cotizacion['id_cotizacion'] . '
            </td>
            <td>
              ' . $this->formatearFecha($id_cotizacion[0]['fecha']) . '
            </td>
            <td>
              ' . $id_cotizacion[0]['nombre_cliente'] . '
            </td>
            <td>
              ' . $id_cotizacion[0]['placa_carro'] . '
            </td>
            <td>
              ' . $id_cotizacion[0]['modelo_carro'] . '
            </td>
            <td>
              ' . $id_cotizacion[0]['ano_carro'] . '
            </td>
            <td>
              ' . $usuario_creador[0]['name'] . ' ' . $usuario_creador[0]['last_name'] . '
            </td>
            <td>
              ' . $usuario_aprueba[0]['name'] . ' ' . $usuario_aprueba[0]['last_name'] . '
            </td>
            <td>
              ' . $cotizacion['estado'] . '
            </td>
            <td>
              <div class="button-table-container">
                <button href="#">'. $icono_table .'</button>
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
  private function formatearFecha($fecha)
  {
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
