<?php

$sesion = session_start();

session_unset(); # Remueve las variables asociadas a la sesion.

session_destroy(); # Destruye la sesion.

?>