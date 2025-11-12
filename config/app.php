<?php

  /*----------  Configuración de la app  ----------*/
	const APP_URL="http://localhost/CCRS/";
	const APP_NAME="Control de Cotizaciones";
	const APP_LOCATE="Anaco, Venezuela";
  const APP_SESSION_NAME="POS";
  const APP_LOGO = "http://localhost/CCRS/public/views/img/logo.png";
  define('APP_PATH', realpath(__DIR__ . '/../') . '/');

  /*----------  Configuración de correo  ----------*/
  const MAIL_HOST="smtp.gmail.com";
  const MAIL_USERNAME="mtfsystemservice@gmail.com";
  const MAIL_PASS="nqsmkmzlpjtyvpke";
  const MAIL_PORT=587;

	/*----------  Configuración de moneda  ----------*/
	const MONEDA_SIMBOLO="bs";
	const DATOS_PAGO=[""];

	/*----------  Marcador de campos obligatorios (Font Awesome) ----------*/
	const CAMPO_OBLIGATORIO='&nbsp; <i class="fas fa-edit"></i> &nbsp;';


	/*----------  Zona horaria  ----------*/
	date_default_timezone_set("America/Caracas");