<?php

require_once('../../Config/app.php');
require_once('../../autoload.php');

use App\Controllers\LoginController;

if (isset($_POST['sesion'])) {

  $insLogin = new LoginController();

  if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    echo $insLogin->iniciarSesion($user, $pass);
  }

}
