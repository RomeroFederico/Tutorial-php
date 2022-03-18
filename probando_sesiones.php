<?php

$sesion = session_start(); # Si se ha iniciado una sesion anteriormente, la abre. En caso contrario crea una nueva.

# Al momento de crear una sesion se crea una llave de usuario, que se utilizara cada vez que se quiera comenzar una sesion.
# Si encuentra esta clave, la sesion asociada a esta iniciara.

if (!$sesion)
	die("No se pudo iniciar sesion");

$fecha_creacion = isset($_SESSION['fecha_creacion']) ? $_SESSION['fecha_creacion'] : "";
$valor = isset($_SESSION['saludo']) ? $_SESSION['saludo'] : "";

echo "La sesion se ha iniciado. ";

if ($fecha_creacion && $valor)
	echo "Valor : " . $valor . ", fecha de creacion : " . $fecha_creacion . ".<br>";
else
	echo "No se inicializaron las variables de sesion.<br>";

?>