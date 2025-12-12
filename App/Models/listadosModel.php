<?php

namespace App\Models;

use App\Models\MainModel;

class listadosModel extends MainModel
{
  public function listarAll()
  {
    $sql = "SELECT * FROM listados";
    $query = $this->connect()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  public function listarFiltrados($filtro)
  {
    $sql = "SELECT * FROM cotizaciones WHERE estado = :filtro";
    $query = $this->connect()->prepare($sql);
    $query->execute([
      'filtro' => $this->limpiarCadena($filtro)
    ]);
    return $query->fetchAll();
  }

  public function listarBuscador($busqueda)
  {

    $sql = "SELECT * FROM cotizaciones WHERE cliente LIKE :busqueda OR placa LIKE :busqueda OR modelo LIKE :busqueda OR ano LIKE :busqueda OR vin LIKE :busqueda";
    $query = $this->connect()->prepare($sql);
    $query->execute([
      'busqueda' => $this->limpiarCadena($busqueda)
    ]);
    return $query->fetchAll();
  }
}
