<?php

ini_set('session.gc_maxlifetime', 250);
ini_set('session.cookie_lifetime', 0);
ini_set('session.use_strict_mode', 1);
ob_start();


require_once "../config/app.php";
require_once "../autoload.php";
require_once "./Views/Inc/session.php";


if (isset($_GET['views'])) {
  $url = explode("/", $_GET['views']);
} else {
  $url = ["login"];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <?php
  require_once "./views/inc/head.php";
  ?>
</head>

<body>
  <?php

  use \App\Controllers\viewsController;
  use \App\Controllers\LoginController;

  $insLogin = new LoginController();
  $viewsController = new viewsController();
  $vista = $viewsController->obtenerVistasControlador($url[0]);
  if ($vista == "login" || $vista == "404" || $vista == "recovery") {
    require_once "./views/Content/" . $vista . "-view.php";
  } else {

  ?>
    <main>
      <?php
      if ((!isset($_SESSION['id']) || $_SESSION['id'] == "") || (!isset($_SESSION['user']) || $_SESSION['user'] == "") || (!isset($_SESSION['rol']) || $_SESSION['rol'] == "")) {
        $insLogin->cerrarSesion();
        exit();
      }
      require_once "./Views/Inc/aside.php";
      ?>
      <section>
        <?php
        require_once $vista;
        ?>
      </section>
    </main>
  <?php
  }
  require_once "./Views/Inc/script.php";
  ?>
</body>
<?php ob_end_flush(); ?>

</html>