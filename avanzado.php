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

		require "funciones.php";
		require "componente.php";

		saludar();

		?>

	</body>
</html>