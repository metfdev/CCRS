<?php

namespace App\Models;

use App\Models\MainModel;

class cotizacionModel extends MainModel
{

  public function getResumenModel()
  {
    $sql = "SELECT * FROM listados";
    $query = $this->connect()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  public function getNroCotizacionesModel()
  {
    $sql = "SELECT MAX(id) AS max_id FROM cotizaciones";
    $query = $this->connect()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  public function registrarCotizacionModel($datosRegistro)
  {

    $sql = "INSERT INTO cotizaciones (id_users, departamento, nombre_cliente, modelo_carro, ano_carro, placa_carro, vin_carro, data_repuestos,fecha , nota) VALUES ( :id_users, :departamento, :cliente, :modelo, :ano, :placa, :vin, :data_repuestos, :fecha, :notas)";
    $query = $this->connect()->prepare($sql);
    $query->execute([
      'id_users' => $datosRegistro['idUsers'],
      'departamento' => $datosRegistro['departamento'],
      'cliente' => $datosRegistro['nombreCliente'],
      'modelo' => $datosRegistro['modeloCarro'],
      'ano' => $datosRegistro['anoCarro'],
      'placa' => $datosRegistro['placaCarro'],
      'vin' => $datosRegistro['vinCarro'],
      'data_repuestos' => $datosRegistro['datosRepuestos'],
      'notas' => $datosRegistro['notas'],
      'fecha' => $datosRegistro['fecha'],
    ]);

    $addListados = "INSERT INTO listados (id_cotizacion, estado) VALUES ( :id_cotizacion, 'pendiente')";
    $query2 = $this->connect()->prepare($addListados);
    $query2->execute([
      'id_cotizacion' => $datosRegistro['idCotizacion']
    ]);

    if ($query && $query2) {
      return true;
      exit;
    }
    return false;
  }
}
