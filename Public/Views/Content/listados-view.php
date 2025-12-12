<section class="listados-section">
  <h1 class="text-center">Listados</h1>
  <div class="listados-container">
    <div class="listados-buscador">
      <input type="text" name="buscador" id="buscador" placeholder="Buscar...">
      <button>
        <i class="fas fa-search"></i>
      </button>
    </div>
    <section class="listados-table">
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
            use App\Controllers\listadosController;
            $listados = new listadosController();
            $listados->listarAll();
          ?>
        </tbody>
      </table>
    </section>
  </div>
</section>