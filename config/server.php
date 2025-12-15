<?php

// define("DB_SERVER", "192.168.100.3");
// define("DB_USER", "admin");
// define("DB_PASS", "Toyoriente2024**");
// define("DB_NAME", "ccrs");

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "ccrs");

CONST DNS = "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";";

Const OPTIONS = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];
