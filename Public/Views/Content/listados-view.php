<?php

use App\Controllers\listadosController;

$listados = new listadosController();
$_SESSION['url'] = "listados";

?>

<section class="listados-section" id="listados-section">
  <h1 class="text-center" id="title-listados">Listados</h1>
  <div class="listados-container" id="listados-container">
    <section class="listados-table" id="listados-table">
      <div class="listados-button-exportar">
        <button id="exportar-listados"><i class="fas fa-file-export"></i>
          Exportar</button>
      </div>
      <table>
        <thead>
          <tr>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Modelo</th>
            <th>Placa</th>
            <th>Año</th>
            <th>Creador</th>
            <th>Vendedor</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="tbody-listados">
          <?php
            $listados->listarAll();
          ?>
        </tbody>
      </table>
    </section>
  </div>
</section>