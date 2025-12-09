<section class="home-section">
  <h1>
    Bienvenido
    <?php echo $_SESSION['user']; ?>
    -
    <?php echo $_SESSION['cargo']; ?>
  </h1>
  <div class="home-resumen">
    <h2>Resumen</h2>
    <ul class="home-resumen-list">
      <li>
        <p>Pendientes:</p>
        <span id="pendientes"></span>
      </li>
      <li>
        <p>Aprobadas:</p>
        <span id="aprobadas"></span>
      </li>
      <li>
        <p>Rechazadas:</p>
        <span id="rechazadas"></span>
      </li>
    </ul>
  </div>

</section>