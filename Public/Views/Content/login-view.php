<?php

  // use App\Controllers\LoginController;

  // $login = new LoginController();
  // $data =[
  //   "nombre" => "Aurelis",
  //   "apellido" => "Dommar",
  //   "email" => "aurelisdc21@gmail.com",
  //   "pass" => "123456",
  //   "cargo" => "Soporte Tecnico",
  //   "departamento" => "Desarrollo",
  //   "rol" => "Administrador"
  // ];

  // $login->registrarUsuario($data);

?>

<section class="login">
  <form class="login-form" id="login-form" autocomplete="off">
    <h2 class="login-form-title">Iniciar sesión</h2>
    <div class="login-form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>
    </div>
    <div class="login-form-group">
      <label for="password">Contraseña</label>
      <input type="password" name="pass" id="pass" required>
    </div>
    <div class="login-form-group-buttons">
      <button>Login</button>
      <a href="<?php echo APP_URL; ?>recovery">¿Olvido su contraseña?</a>
    </div>
  </form>
</section>