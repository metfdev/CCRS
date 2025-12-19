<aside class="aside">
  <img class="aside-logo" src="<?php echo APP_URL; ?>Public/Views/Img/ToyorienteLogo.png" alt="logoToyoriente">
  <div class="aside-Container">
    <section>
      <ul class="aside-Menu">
        <li class="aside-list">
          <a href="home" id="home" class="aside-enlance aside-enlace-Active">
            <div class="aside-List-Container">
              <img width="10px" src="<?php echo APP_URL; ?>Public/Views/Img/icons/casa.png" alt="iconoHome" class="aside-icono">
            </div>
            Inicio
          </a>
        </li>
        <?php if($_SESSION['departamento'] == "Servicio"): ?>
        <li class="aside-list">
          <a href="cotizar" id="cotizar" class="aside-enlance">
            <div class="aside-List-Container">
              <img width="10px" src="<?php echo APP_URL; ?>Public/Views/Img/icons/solicitar.png" alt="iconoSolicitar" class="aside-icono">
            </div>
            Cotizar
          </a>
        </li>
        <?php else: ?>
          <li class="aside-list">
          <a href="aprobacion" id="aprobacion" class="aside-enlance">
            <div class="aside-List-Container">
              <img width="10px" src="<?php echo APP_URL; ?>Public/Views/Img/icons/solicitar.png" alt="iconoSolicitar" class="aside-icono">
            </div>
            Aprobacion
          </a>
        </li>
        <?php endif; ?>
        <li class="aside-list">
          <a href="listados" id="listados" class="aside-enlance">
            <div class="aside-List-Container">
              <img width="10px" src="<?php echo APP_URL; ?>Public/Views/Img/icons/portapapeles.png" alt="iconoPortapapeles" class="aside-icono">
            </div>
            Listados
          </a>
        </li>
      </ul>
    </section>
    <section>
      <ul class="aside-Menu">
        <li class="aside-list">
          <a href="perfil" id="perfil" class="aside-enlance">
            <div class="aside-List-Container">
            <img width="10px" src="<?php echo APP_URL; ?>Public/Views/Img/icons/avatar.png" alt="iconoAvatar" class="aside-icono">
          </div>
            <?php echo $_SESSION['user']; ?>
          </a>
        </li>
        <li class="aside-list">
          <a href="<?php echo APP_URL; ?>logout" class="aside-enlance">
            <div class="aside-List-Container">
              <img width="10px" src="<?php echo APP_URL; ?>Public/Views/Img/icons/cerrarSesion.png" alt="iconoCerrarSesion" class="aside-icono">
            </div>
            Cerrar Sesión
          </a>
        </li>
      </ul>
    </section>
  </div>
</aside>