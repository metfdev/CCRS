<?php

  spl_autoload_register(function($clase){

    $archivo= __DIR__."/".$clase.".php";
    $archivo=str_replace("\\","/",$archivo);

    if(is_file($archivo)){
      require_once $archivo;
    }else {
        die("No se encontró la clase: $clase en $ruta");
    }
  });