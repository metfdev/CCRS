<?php

namespace App\Models;

use App\Models\MainModel;

class cotizacionModel extends MainModel
{

  public function getResumen() {
    $sql = "SELECT * FROM cotizaciones";
    $query = $this->connect()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }
}