<?php

// VARIABLES SUPERGLOBALS

// Variables predefinidas accesibles en todos lados.

// $GLOBALS => Contiene variables globales, accesibles a traves de un indice clave.

$mi_numero_global = 7;

function imprimirNumeroGlobal() {
	$GLOBALS["imprimir"]  = TRUE;	// Se puede agregar nuevas variables globales en nuevos indices clave.
	echo $GLOBALS["mi_numero_global"] . "<br>";
}

imprimirNumeroGlobal();

if ($imprimir)	// Se sigue accediendo a las variables globales de la misma manera.
	echo "Se pudo imprimir!!!<br>";
else
	echo "No se pudo imprimir...<br>";

// echo $_SERVER => Contiene informacion sobre los header, paths, localizacion de scripts, etc.

/*
echo $_SERVER['PHP_SELF'];	# Returns the filename of the currently executing script
echo "<br>";
echo $_SERVER['GATEWAY_INTERFACE'];	# Returns the version of the Common Gateway Interface (CGI) the server is using
echo "<br>";
echo $_SERVER['SERVER_ADDR'];	# Returns the IP address of the host server
echo "<br>";
echo $_SERVER['SERVER_NAME'];	# Returns the name of the host server (such as www.w3schools.com)
echo "<br>";
echo $_SERVER['SERVER_SOFTWARE'];	# Returns the server identification string (such as Apache/2.2.24)
echo "<br>";
echo $_SERVER['SERVER_PROTOCOL'];	# Returns the name and revision of the information protocol (such as HTTP/1.1)
echo "<br>";
echo $_SERVER['REQUEST_METHOD'];	# Returns the request method used to access the page (such as POST)
echo "<br>";
echo $_SERVER['REQUEST_TIME'];	# Returns the timestamp of the start of the request (such as 1377687496)
echo "<br>";
echo $_SERVER['QUERY_STRING'];	# Returns the query string if the page is accessed via a query string
echo "<br>";
echo $_SERVER['HTTP_ACCEPT'];	# Returns the Accept header from the current request
echo "<br>";
echo $_SERVER['HTTP_ACCEPT_CHARSET'];	# Returns the Accept_Charset header from the current request (such as utf-8,ISO-8859-1)
echo "<br>";
echo $_SERVER['HTTP_HOST'];	# Returns the Host header from the current request
echo "<br>";
echo $_SERVER['HTTP_REFERER'];	# Returns the complete URL of the current page (not reliable because not all user-agents support it)
echo "<br>";
echo $_SERVER['HTTPS'];	# Is the script queried through a secure HTTP protocol
echo "<br>";
echo $_SERVER['REMOTE_ADDR'];	# Returns the IP address from where the user is viewing the current page
echo "<br>";
echo $_SERVER['REMOTE_HOST'];	# Returns the Host name from where the user is viewing the current page
echo "<br>";
echo $_SERVER['REMOTE_PORT'];	# Returns the port being used on the user's machine to communicate with the web server
echo "<br>";
echo $_SERVER['SCRIPT_FILENAME'];	# Returns the absolute pathname of the currently executing script
echo "<br>";
echo $_SERVER['SERVER_ADMIN'];	# Returns the value given to the SERVER_ADMIN directive in the web server configuration file (if your script runs on a virtual host, it will be the value 
echo "<br>";					# defined for that virtual host) (such as someone@w3schools.com)
echo $_SERVER['SERVER_PORT'];	# Returns the port on the server machine being used by the web server for communication (such as 80)
echo "<br>";
echo $_SERVER['SERVER_SIGNATURE'];	# Returns the server version and virtual host name which are added to server-generated pages
echo "<br>";
echo $_SERVER['PATH_TRANSLATED'];	# Returns the file system based path to the current script
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];	# Returns the path of the current script
echo "<br>";
echo $_SERVER['SCRIPT_URI'];	# Returns the URI of the current page
echo "<br>";
*/

// $_REQUEST => Permite obtener los datos despues de subir un form.
// $_POST => Idem, solo si el metodo es 'POST'.
// $_GET => idem, solo si el metodo es 'GET'.

?>

<!-- FORM QUE ENVIA LOS DATOS A LA MISMA PAGINA -->
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>"> <!-- NOTESE QUE ACTION REFERENCIA A DONDE ENVIAR LOS DATOS, Y 'PHP_SELF' HACE REFERENCIA AL ARCHIVO ACTUAL -->
	Nombre: <input type = "text" name = "fname"> <!-- 'name' hara referencia a la variable donde se alojaran los datos enviados. -->
	<input type = "submit">
</form>

<form method = 'get' action = "<?php echo $_SERVER['PHP_SELF'];?>">
	edad: <input type = "num" name="fedad">
	<input type = "submit">
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // SI EL METODO DE PEDIDO ES POST...

  #$name = $_REQUEST['fname'];				// ACCEDO A LOS DATOS CON EL NOMBRE DEL INPUT.
  $name = $_POST['fname'];					// IDEM CON LA VARIABLE $_POST.

  if (empty($name)) {						// SI NO SE ENVIO NADA...
    echo "<br>El nombre esta vacio<br>";
  }
  else {
    echo "<br>NOMBRE: " . $name . "<br>";			// SI SE ENVIO UN VALOR...
  }
}
else if ($_SERVER["REQUEST_METHOD"] == "GET") // SI EL METODO DE PEDIDO ES GET (POR EJEMPLO AL INGRESAR A LA PAGINA POR PRIMERA VEZ O SI EXPLICITAMENTE SE ENVIAN DATOS CON GET)...
{
	if (array_key_exists('fedad', $_GET)) { // COMPRUEBO SI EXISTE UNA VARIABLE GET 'fedad'.

		$edad = $_GET['fedad'];				// SI SE ENVIO...

		if (empty($edad))
			echo "<br>La edad esta vacia<br>"; // SI EL VALOR ES ''.
		else
			echo "<br>EDAD: " . $edad . "<br>"; // EN CASO CONTRARIO.
	}
	else
		echo "<br>No se ingreso una edad...<br>"; // SI NO SE ENVIO LA VARIABLE POR GET...
}

// $_FILES
// $_ENV
// $_COOKIE
// $_SESSION