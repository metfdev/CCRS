<?php

require_once('../../Config/app.php');
require_once('../../autoload.php');

if (isset($_POST['action'])) {

  $insListados = new App\Controllers\listadosController();

  if ($_POST['action'] == "todos") {
    echo $insListados->listarAll();
  }

  if ($_POST['action'] == "filtradoEstatus") {
    echo $insListados->listarFiltradosEstatus($_POST['filtro']);
  }

  if ($_POST['action'] == "buscador") {
    echo $insListados->listarBuscador($_POST['busqueda']);
  }
}
