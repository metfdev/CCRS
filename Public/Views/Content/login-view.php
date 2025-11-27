<?php

use App\Controllers\LoginController;
$loginController = new LoginController();

// $dataRegistro = [
//   'email' => 'miguel@gmail.com',
//   'pass' => '123456',
//   'nombre' => 'Miguel',
//   'apellido' => 'Ticaray',
//   'cargo' => 'Soporte Tecnico',
//   'departamento' => 'Informatica',
//   'rol' => 'admin'
// ];

// echo $loginController->registrarUsuario($dataRegistro);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $email = $_POST['email'];
  $pass = $_POST['password'];
  $insLogin = $loginController->iniciarSesion($email, $pass);

  if ($insLogin['icono'] == 'success') {
    echo '<script>
      alertas_ajax(' .  json_encode($insLogin) . ');
      setTimeout(() => {
        window.location.href = "' . APP_URL . '/home";
      }, 2000);
    </script>';
  } else {
    echo '<script>
      alertas_ajax(' . json_encode($insLogin) . ');
    </script>';
  }
}



?>

<section class="login">
  <form class="login-form" action="" method="POST">
    <div class="login-form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email">
    </div>
    <div class="login-form-group">
      <label for="password">Contraseña</label>
      <input type="password" name="password" id="password">
    </div>
    <div class="login-form-group-buttons">
      <button>Login</button>
      <a href="<?php echo APP_URL; ?>recover">¿Olvido su contraseña?</a>
    </div>
  </form>
</section>