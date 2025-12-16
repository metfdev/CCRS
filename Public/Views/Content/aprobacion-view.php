<?php

use App\Controllers\listadosController;

$listados = new listadosController();

$_SESSION['url'] = "aprobacion";
?>
<section class="listados-section">
  <h1 class="cotizar-titulo">
    Aprobacion
  </h1>
  <div class="listados-container">
    <section class="listados-table">
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
          <?php echo $listados->listarAll(); ?>
        </tbody>
      </table>
    </section>
  </div>
</section>
