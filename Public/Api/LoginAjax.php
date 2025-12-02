<?php

require_once('../../Config/app.php');
require_once('../../autoload.php');

if (isset($_POST['action'])) {

  $insLogin = new App\Controllers\LoginController();

  if ($_POST['action'] == "login") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    echo $insLogin->iniciarSesion($email, $pass);
  }

}
