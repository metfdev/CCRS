<?php

if (!isset($_SESSION['id']) || $_SESSION['id'] == "") {
  header("Location: " . APP_URL );
}

?>

<section class="home-section">
  <h1>
    Bienvenido
    <?php echo $_SESSION['user']; ?>
    -
    <?php echo $_SESSION['cargo']; ?>
  </h1>
  <div>
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Correo</th>
          <th>Cargo</th>
          <th>Departamento</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Nombre</td>
          <td>Apellido</td>
          <td>Correo</td>
          <td>Cargo</td>
          <td>Departamento</td>
          <td>Acciones</td>
        </tr>
      </tbody>
    </table>
  </div>

</section>