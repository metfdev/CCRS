<?php

require_once('../../Config/app.php');
require_once('../../autoload.php');

if (isset($_POST['action'])) {

  $insContizacion = new App\Controllers\cotizacionController();

  if ($_POST['action'] == "resumen") {
    echo $insContizacion->calculoResumen();
  }

  if ($_POST['action'] == "conteo") {
    echo $insContizacion->getNroCotizaciones();
  }

  if ($_POST['action'] == "registrar") {
    echo json_encode($insContizacion->registrarCotizacion());
  }

}
