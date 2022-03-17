<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AVANZADO</title>
	</head>
	<body>

		<h3>FUNCIONES PARA EL MANEJO DE FECHAS Y HORAS</h3>

		<?php
		date_default_timezone_set('America/Buenos_Aires'); # Cambio la zona horaria.

		// ------------------------------------------------------------

		// Funciones de fecha y hora -> date(formato, timestamp -> default : tiempo actual)
		//								Devuelve la fecha y hora formateada (string) del timestamp provisto (unix).
		//								En caso de no pasarse un timestamp, se utliza el tiempo actual del servidor 
		//								(zona horaria default del servidor: Europe/Berlin).

		// time() => Devuelve la fecha actual (timestamp unix).

		// CARACTERES DE FORMATO FECHA
		// d - dia (1 a 31) 	D - dia (palabra)
		// m - mes (1 a 12) 	M - mes (palabra)
		// y - año (2 digitos)	Y - dia (4 digitos)
		// l (lowercase 'L') - dia de la semana


		echo "Hoy es " . date("l d - m - Y") . "<br>"; # Thursday 17 - 03 - 2022.

		$formato_fecha = "l d - m - Y";
		$formato_fecha_extendido = $formato_fecha . " h::i::s a";

		// CARACTERES DE FORMATO HORA
		// H - hora (0 a 23) 	h - hora (1 a 12)
		// i - minutos (00 a 59)
		// s - segundos (00 a 59)
		// a - antes del mediodia o despues del mediodia (am - pm)

		echo date("h::i::s a") . "<br>"; # 08::07::55 pm. NOTA: Si no se cambia la zona horaria, el resultado difiere.

		// CREAR A TIMESTAMP
		// mktime(parametros...) => Retorna un timestamp unix de una fecha especificada.
		// mktime(hora, minuto, segundo, mes, dia, año).

		$mi_fecha = mktime(0, 0, 0, 6, 28, 1995);
		$mi_fecha_formateada = date("d-m-Y", $mi_fecha);

		echo "Mi fecha de nacimiento es: " . $mi_fecha_formateada . "<br>";

		// CONVERTIR FECHA FORMATEADA A TIMESTAMP UNIX
		// strtotime() => Convierte una cadena de fecha formateada a un timestamp unix.
		//				  En caso de pasar uno de los parametros de ejemplo, se toma como referencia la fecha actual
		//				  Si se desea cambiar la referencia, se utiliza otro parametro.
		// strtotime(parametro, fecha_de_referencia) => Siendo la referencia un timestamp unix.

		echo "Mi fecha de nacimiento convertida a un timestamp unix es " . strtotime($mi_fecha_formateada) . "<br>";

		// ALGUNOS PARAMETROS QUE PUEDE TOMAR...
		// TOMORROW
		echo "Mañana es " . date($formato_fecha, strtotime("tomorrow")) . "<br>";
		// NEXT 'DAY'/'MONTH'/'YEAR'.
		echo "La semana que viene es " . date($formato_fecha, strtotime("next week")) . "<br>"; # Comienzo de la semana que viene.
		// +3 'DAY'/'MONTH'/'YEAR'.
		echo "En 5 meses es " . date($formato_fecha_extendido, strtotime("+5 month")) . "<br>"; # En 5 meses (-1 dia).
		// Ejemplo con fecha de referencia distinta a la actual.
		echo "Mi cumpleaño numero 15 fue en esta fecha: " . date($formato_fecha, strtotime("+15 years", $mi_fecha)) . "<br>";

		$mi_proximo_cumple_27 = strtotime("+27 years", $mi_fecha);
		$mi_proximo_cumple_27_formateado = date($formato_fecha, $mi_proximo_cumple_27);

		$dias_faltantes = ceil(($mi_proximo_cumple_27 - time()) / 60 / 60 / 24); # Obtengo un dia.

		echo "Mi cumpleaño numero 27 es el dia: " . $mi_proximo_cumple_27_formateado . "<br>";

		if ($dias_faltantes > 0)
			echo "Faltan " . $dias_faltantes . " dias para mi cumpleaños 27.<br>";
		else if ($dias_faltantes == 0)
			echo "Hoy es mi cumpleaño 27!!!<br>";
		else
			echo "Pasaron " . abs($dias_faltantes) . " dias de mi cumpleaños 27.<br>";

		// ------------------------------------------------------------

		// include y request

		// Toma todo el contenido de un texto/codigo/markup que existe en un archivo especificado y lo incluye en el archivo de origen.
		// Ambos funcionan igual, pero se diferencian en el manejo de errores.
		// require => produce un error fatal (E_COMPILE_ERROR) y para el script.
		// include => produce una advertencia (E_WARNING), mientras que el script continua su curso.

		// require "ruta_del_archivo";

		require "funciones.php"; # Importo funciones, directamente las puedo invocar en este archivo.
		require "componente.php"; # Importo un bloque de codigo que "imprime" diversos tags html.
		require "variables.php"; # Importo variables listas para utilizarse.

		saludar();

		echo $variable_importada . "<br>";
		echo $numero_importado . "<br>";

		// ------------------------------------------------------------

		// Manejo de archivos

		// readfile(ruta) -> Lee un archivo y lo escribe al 'buffer'. Retorna el numero de bytes leidos en caso de suceso.

		echo readfile("texto.txt") . "<br>"; # Imprime el archivo concatenado con el tamaño del mismo.

		readfile("texto.txt"); # Imprimo solo el archivo.

		echo "<br>";

		// fopen(ruta, modo) -> Ofrece mas opciones que el metodo anterior. Retorna el "puntero" del archivo en caso de exito y false en caso contrario.

		// MODOS DE APERTURA
		// 'r'	SOLO LECTURA -- PUNTERO AL COMIENZO DEL ARCHIVO
		// 'r+'	LECTURA Y ESCRITURA -- PUNTERO AL COMIENZO DEL ARCHIVO
		// 'w'	SOLO ESCRITURA -- PUNTERO AL COMIENZO DEL ARCHIVO -- BORRA EL CONTENIDO DEL ARCHIVO -- CREA UN ARCHIVO SI NO EXISTE
		// 'w+'	LECTURA Y ESCRITURA -- PUNTERO AL COMIENZO DEL ARCHIVO -- BORRA EL CONTENIDO DEL ARCHIVO -- CREA UN ARCHIVO SI NO EXISTE
		// 'a'	SOLO ESCRITURA -- PUNTERO AL FINAL DEL ARCHIVO -- CREA UN ARCHIVO SI NO EXISTE.
		// 'a+'	LECTURA Y ESCRITURA -- PUNTERO AL FINAL DEL ARCHIVO -- CREA UN ARCHIVO SI NO EXISTE.
		// 'x'	SOLO ESCRITURA -- CREA UN ARCHIVO NUEVO -- LANZA ERROR Y FALSE SI YA EXISTE.
		// 'x+'	LECTURA Y ESCRITURA -- CREA UN ARCHIVO NUEVO -- LANZA ERROR Y FALSE SI YA EXISTE.


		// $mi_archivo_imaginario = fopen("archivo_imaginario.txt", "r") or die("No se pudo abrir el archivo.");
		// Si falla en abrir, se lanza un warning y retorna false.
		// die(mensaje) o exit(mensaje) finalizan el script de manera abrupta y lanzan el mensaje inidicado. 

		$mi_archivo = fopen("texto.txt", "r") or die("ERROR");		# Apertura del archivo en modo "solo lectura".
		echo fread($mi_archivo, filesize("texto.txt")) . "<br>";	# Leo el archivo.
		fclose($mi_archivo);										# Cierre del archivo.

		// fread(archivo, tamaño_a_leer) -> Lee un archivo abierto por 'fopen', leyendose tantos bytes como se especifique.
		// filesize(ruta) -> Retorna el tamaño en bytes del archivo en la ruta especificada, false en caso de error.
		// fclose(archivo) -> Cierra un archivo abierto.

		$mi_archivo = fopen("texto.txt", "r") or die("ERROR");

		// fgets(archivo) -> Lee solo la primera linea marcada por el puntero del archivo y corre el puntero a la proxima linea.
		// echo fgets($mi_archivo) . "<br>"; # Imprimo la primera linea del archivo.
		// echo fgets($mi_archivo) . "<br>"; # El puntero se corrio una linea, por lo que leo la segunda linea.

		// fgetc(archivo) -> Lee solo el primer caracter marcado por el puntero del archivo y corre el puntero al proximo caracter.

		// feof(archivo) -> retorna true si el puntero del archivo alcanzo el final del mismo (EOF).

		do {

			//echo fgets($mi_archivo) . "<br>"; # Imprimo una linea del archivo de acuerdo a la posicion del puntero.
			echo fgetc($mi_archivo); # Imprime un unico caracter y corre el puntero al siguiente.

		}
		while (!feof($mi_archivo)); # Se imprimira hasta que se alcanze el final del archivo.

		fclose($mi_archivo);

		$nuevo_archivo = fopen("archivo_creado_por_php.txt", "w"); # Abro para solo escritura, si no existe un archivo lo creo.
																   #  Si el archivo existe, lo deja en blanco.

		// fwrite(archivo, string) -> Escribe sobre un archivo segun donde se encuentre el puntero, luego lo mueve al final de lo insertado.

		fwrite($nuevo_archivo, "Linea agregada por php 1\n"); # Agrego un string y se corre el puntero.
		fwrite($nuevo_archivo, "Linea agregada por php 2\n"); # Agrego otro string al lado del anterior.

		fclose($nuevo_archivo);

		$nuevo_archivo_append = fopen("archivo_creado_y_modificado_por_php.txt", "a"); # A diferencia del modo 'w', 'append' no deja en blanco 
																					   # al abrir un archivo ya existente.

		fwrite($nuevo_archivo_append, "Linea agregada a la hora : " . date($formato_fecha_extendido) . "\n");

		fclose($nuevo_archivo_append);

		?>

	</body>
</html>