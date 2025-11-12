<?php

ini_set('session.gc_maxlifetime', 250);
ini_set('session.cookie_lifetime', 0);
ini_set('session.use_strict_mode', 1);
ob_start();
require_once "../config/app.php";
require_once "../autoload.php";


if (isset($_GET['views'])) {
  $url = explode("/", $_GET['views']);
} else {
  $url = ["login"];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once "./views/inc/head.php";
  ?>
</head>

<body>
  <?php

  use \App\Controllers\viewsController;

  $viewsController = new viewsController();
  $vista = $viewsController->obtenerVistasControlador($url[0]);
  if ($vista == "login" || $vista == "404") {
    require_once "./views/content/" . $vista . "-view.php";
  } else {
  ?>
    <main class="flex column grid-900 column-d-900 hg-100vh column-d-1200">
      <?php
      $insLogin->vigenciaRifa();
      include_once "./views/content/modal-view.php";
      if ((!isset($_SESSION['id']) || $_SESSION['id'] == "") || (!isset($_SESSION['nombre']) || $_SESSION['nombre'] == "") || (!isset($_SESSION['rol']) || $_SESSION['rol'] == "")) {
        $insLogin->cerrarSesion();
        exit();
      }

      ?>
      <section class="sections-overflow hd-100vh">
        <?php
        require_once $vista;
        ?>
      </section>
    </main>
  <?php
  }
  ?>
</body>
<?php ob_end_flush(); ?>

</html>