<section class="cotizar-section">
  <h1 class="text-center">
    <?php $_SESSION['departamento'] == 'Repuestos' ? print('Cotizaciones') : print('Cotizar');  ?>
  </h1>
  <?php if($_SESSION['departamento'] == 'Servicio') : ?>
  <form class="cotizar-form">
    <header class="cotizar-header">
      <div>
        <div>
          <label for="nro">Nro.:</label>
          <input type="text" name="nro" id="nro">
        </div>
        <div>
          <label for="nro">Solicitante:</label>
          <input type="text" name="solictante" id="solictante" value="<?php echo $_SESSION['user']; ?>" disabled>
        </div>
        <div>
          <label for="nro">Dpto.:</label>
          <input type="text" name="dpto" id="dpto" value="<?php echo $_SESSION['departamento']; ?>" disabled>
        </div>
      </div>
      <div>
        <label for="nro">Fecha:</label>
        <input type="text" name="fecha" id="fecha" value="<?php echo date('d-m-Y'); ?>" disabled>
      </div>
    </header>
  </form>
  <?php else : ?>
  <!-- Cotizaciones pendientes -->
  <?php endif; ?>
</section>