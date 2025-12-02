<section class="login">
  <form class="login-form" id="login-form" autocomplete="off">
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
      <a href="<?php echo APP_URL; ?>recover">¿Olvido su contraseña?</a>
    </div>
  </form>
</section>