<?php
session_start();

// define('SESSION_TIMEOUT', 250);

// if (isset($_SESSION['id'])) {

//   if (isset($_SESSION['last_activity'])) {

//     $inactividad = time() - $_SESSION['last_activity'];

//     if ($inactividad > SESSION_TIMEOUT) {
//       header("Location: " . APP_URL . "logOut/");
//     }
//   }

//   $_SESSION['last_activity'] = time();
// }
