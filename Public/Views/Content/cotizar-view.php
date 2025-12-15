<?php

use App\Controllers\listadosController;

$listados = new listadosController();
?>

<section class="cotizar-section">
  <h1 class="cotizar-titulo">
    <?php $_SESSION['departamento'] == 'Repuestos' ? print('Cotizaciones') : print('Cotizar');  ?>
  </h1>
  <?php if ($_SESSION['departamento'] == 'Servicio') : ?>
    <form id="cotizar-form" class="cotizar-form">
      <div class="cotizar-form-container">
        <header class="cotizar-header">
          <div class="cotizar-header-solicitante">
            <div>
              <label for="nro">Nro.:</label>
              <input class="nro" type="text" name="nro" id="nro" disabled>
            </div>
            <div>
              <label for="solicitante">Solicitante:</label>
              <input type="hidden" id="id_solicitante" value="<?php echo $_SESSION['id']; ?>" disabled>
              <input type="text" name="solicitante" id="solicitante" value="<?php echo $_SESSION['user']; ?>" disabled>
            </div>
            <div>
              <label for="dpto">Dpto.:</label>
              <input class="dpto" type="text" name="dpto" id="dpto" value="<?php echo $_SESSION['departamento']; ?>" disabled>
            </div>
          </div>
          <div class="cotizar-header-fecha">
            <label for="fecha">Fecha:</label>
            <input type="text" name="fecha" id="fecha" value="<?php echo date('d-m-Y'); ?>" disabled>
          </div>
        </header>
        <section class="cotizar-main">
          <div class="contenedor-datos-cliente">
            <div>
              <label for="cliente">Cliente:</label>
              <input type="text" name="cliente" id="cliente">
            </div>
            <div>
              <label for="modelo">Modelo:</label>
              <input type="text" name="modelo" id="modelo">
            </div>
            <div>
              <label for="ano">Año:</label>
              <input class="input-ano" type="number" name="ano" id="ano">
            </div>
            <div>
              <label for="placa">Placa:</label>
              <input type="text" name="placa" id="placa">
            </div>
            <div>
              <label for="vin">VIN:</label>
              <input type="text" name="vin" id="vin" maxlength="17" minlength="17">
            </div>
          </div>
          <section class="cotizar-main-contenedor">
            <div class="cotizar-main-contenedor-left">
              <div id="form-repuestos" class="contenedor-datos-repuestos">
                <div>
                  <label for="nroparte">Nro. parte:</label>
                  <input type="text" name="nroparte" id="nroparte">
                </div>
                <div>
                  <label for="nombre">Nombre:</label>
                  <input type="text" name="nombre" id="nombre">
                </div>
                <div>
                  <label for="cantidad">Cantidad:</label>
                  <input class="input-cantidad" type="number" name="cantidad" id="cantidad">
                </div>
                <button id="button-agregar-repuestos" class="button-agregar-repuesto">
                  <i class="fa-solid fa-plus"></i>
                </button>
              </div>
              <div class="contenedor-notas">
                <label for="notas">Notas:</label>
                <textarea class="notas" type="text" name="notas" id="notas"></textarea>
              </div>
            </div>
            <div class="cotizar-main-contenedor-right">
              <table>
                <thead>
                  <tr>
                    <th>Nro. parte</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody id="tbody_cotizacion_repuestos"></tbody>
              </table>
            </div>
          </section>
        </section>
        <div class="form-container-buttons">
          <button id="button-cotizar" class="button-cotizar">Cotizar</button>
          <button id="button-limpiar" class="button-limpiar">Limpiar</button>
        </div>
      </div>
    </form>
  <?php else : ?>
    <!-- Cotizaciones lado Repuestos -->
    <section class="listados-section">
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
  <?php endif; ?>
</section>