<?php

if ($_SERVER["REQUEST_METHOD"] == "GET")
	die("No se permite el acceso por GET!");

$directorio_destino = ""; # El directorio donde se almacenara el archivo y esta pagina.

$archivo_destino = $directorio_destino . basename($_FILES["varArchivo"]["name"]);

# basename() devuelve el nombre del archivo extraido de la ruta completa.
# $_FILES almacena los archivos subidos durante la ejecucion del codigo. Notese que almacena la ruta completa al momento de subirse (CLIENTE).
# "archivo" es el 'ID' asociado al input tipo 'file'. Devuelve la informacion del archivo asociado (array).

// ATRIBUTOS ASOCIADOS AL "ARCHIVO"
# "name" => Devuelve el nombre original del fichero subido (CLIENTE).
# "type" => Devuelve el tipo del archivo proporcionado por el navegador ("image/gif" por ejemplo).
# "size" => Retorna el tamaño en bytes del fichero.
# "tmp_name" => Es el nombre temporal del archivo ya alojado en el servidor. (Almacenamiento temporal)
# "error" => Codigo de error asociado a la subida.

# $archivo_destino dara como resultado la ruta del archivo al moverlo (ruta donde se quiere almacenar + nombre original del lado del cliente).

$tipo = strtolower(pathinfo($archivo_destino, PATHINFO_EXTENSION)); # Pongo en minuscula la extension.

# pathinfo(archivo, opcion) proporciona diversa informacion acerca de una ruta dada.
# Si no se especifina una opcion, se devuelve un array asociativo con todas las opciones.
// OPCIONES QUE ACEPTA
# PATHINFO_DIRNAME -> Direcorio donde se aloja (ruta completa - (nombre del archivo + extension del archivo)).
# PATHINFO_BASENAME -> Nombre del archivo (nombre del archivo + extension del archivo).
# PATHINFO_EXTENSION -> Extension del archivo, en caso de multiples solo la ultima.
# PATHINFO_FILENAME -> Nombre del archivo sin su extension, en caso de multiples, elimina la ultima.

# Verificar que el archivo sea una imagen.
function check_image() {
	$imagen_correcta = getimagesize($_FILES["varArchivo"]["tmp_name"]);
	# getimagesize(archivo, opcion) devuelve informacion referida al tamaño de una imagen dada. En caso de error (que no sea imagen) retorna false.
	# opcion por default no se agrega, pero en caso de agregarse devuelve mas informacion.

	if($imagen_correcta !== false) {
		# echo "El archivo subido es una imagen " . $imagen_correcta["mime"] . ". <br>";
		# "mime" es el tipo asociaciado (image/png por ejemplo).
		return true;
	} 
	else {
		# echo "El archivo no es una imagen<br>";
		return false;
	}
}

# Verificar si el archivo ya existe en el servidor.
function check_is_new($archivo_destino) {
	# file_exists($archivo) retorna true si existe un archivo en la ruta especificada.
	if (file_exists($archivo_destino)) {
		# echo "El archivo ya existe en el servidor.<br>";
		return false;
	}
	return true;
}

# Verificar que el tamaño no sea superior al maximo establecido.
function check_size($max_size) {
	if ($_FILES["varArchivo"]["size"] > $max_size) {
		# echo "Archivo my grande para subir.<br>";
		return false;
	}
	return true;
}

# Verificar que el tipo asociado de la imagen sea uno de los permitidos.
function check_type($tipo) {
	if($tipo != "jpg" && $tipo != "png" && $tipo != "jpeg"
	&& $tipo != "gif" ) {
		# echo "Solo los tipos de archivo JPG, JPEG, PNG & GIF son soportados.<br>";
		return false;
	}
	return true;
}

# Mueve el archivo de la carpeta temporal del servidor a la carpeta de destino establecida.
function mover_archivo($archivo_destino) {
	# move_uploaded_files($archivo_tmp, $archivo_destino) mueve un archivo (que haya sido subido) a la ruta especificada y retorna true en caso de exito.
	if (move_uploaded_file($_FILES["varArchivo"]["tmp_name"], $archivo_destino))
		return true;
	return false;
}

# Averiguar si la imagen subida ha sido subida por el form asociado.
# isset(variable) devuelve true solo si la variable esta definida y es distinta a 'null'. 
if(isset($_POST["varSubir"])) {

	# Realizo las verificaciones sobre el archivo.
	if (check_is_new($archivo_destino) && check_image() && check_size(500000) && check_type($tipo)) {
		if (mover_archivo($archivo_destino)) {
			echo "El archivo ". htmlspecialchars(basename( $_FILES["varArchivo"]["name"])) . " se ha podido subir.<br>";
		} 
		else {
			echo "Ocurrio un error al subir el archivo.<br>";
		}
	}
	else
		echo "El archivo no cumplio las validaciones.<br>";
}

?>
