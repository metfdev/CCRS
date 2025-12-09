<?php

  /*----------  Configuración de la app  ----------*/
	const APP_URL="http://192.168.100.3/CCRS/";
	const APP_NAME="Control de Cotizaciones";
	const APP_LOCATE="Anaco, Venezuela";
  const APP_SESSION_NAME="POS";
  const APP_LOGO = "http://192.168.100.3/CCRS/public/views/img/ToyorienteLogo.png";
  define('APP_PATH', realpath(__DIR__ . '/../') . '/');

  /*----------  Configuración de correo  ----------*/
  const MAIL_HOST="smtp.gmail.com";
  const MAIL_USERNAME="informacionccrs@gmail.com";
  const MAIL_PASS="cyoexbrqmdwvhqxk";
  const MAIL_PORT=587;

	/*----------  Configuración de moneda  ----------*/
	const MONEDA_SIMBOLO="bs";
	const DATOS_PAGO=[""];

	/*----------  Marcador de campos obligatorios (Font Awesome) ----------*/
	const CAMPO_OBLIGATORIO='&nbsp; <i class="fas fa-edit"></i> &nbsp;';


	/*----------  Zona horaria  ----------*/
	date_default_timezone_set("America/Caracas");