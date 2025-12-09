<?php

namespace App\Models;

use App\Models\MainModel;

class cotizacionModel extends MainModel
{

  public function getResumen()
  {
    $sql = "SELECT * FROM cotizaciones";
    $query = $this->connect()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  public function registrarCotizacionModel($datosRegistro) {

    $sql = "INSERT INTO cotizaciones (id_users, departamento, nombre_cliente, modelo_carro, ano_carro, placa_carro, vin_carro, data_repuestos, notas,fecha, estado) VALUES ( :id_users, :departamento, :cliente, :modelo, :ano, :placa, :vin, :data_repuestos, :notas, :fecha, :estado)";
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
      'estado' => $datosRegistro['estado']
    ]);

    if ($query) {
      return true;
      exit;
    }
    return false;

  }
}
