<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FILTROS</title>
		<link rel = "stylesheet" type = "text/css" href = "./Estilos/style2.css">
	</head>
	<body>

		<div class = "divContenedorPrincipal centrar">

		<?php

		// ------------------------------------------------------------

		// Filtros
		// Funciones integradas que facilitan la verificacion y validacion de los datos provistos por el usuario.

		function es_POST() {
			if ($_SERVER["REQUEST_METHOD"] == "POST")
				return true;
			return false;
		}

		function filtro_activo($id) {
			if ($_POST['filtro'] == $id)
				return true;
			return false;
		}

		function encender_opcion_menu($id) {
			if (es_POST() AND filtro_activo($id))
				return "iluminar";
			return "";
		}

		function cerrar_archivo($archivo) {
			fclose($archivo);
		}

		function abrir_y_retornar_archivo($nombre_archivo) {
			$ruta = "./archivos_filtros/" . $nombre_archivo . ".txt";
			$archivo = fopen($ruta, "r") or die("ERROR");
			$texto = fread($archivo, filesize($ruta));
			cerrar_archivo($archivo);
			return $texto;
		}

		$nombres_filtros = [];

		echo "<div class = 'divMenu miFuente'><h3 class = 'titulo'>Lista de filtros</h3><ul>";

		foreach (filter_list() as $idFiltro => $filtro) {

			echo "<li id = 'btn" . $idFiltro . "'" . " class = '" . encender_opcion_menu($idFiltro) . "'";
			echo "onclick = 'seleccionar_del_menu(" . '"' . $idFiltro . '"' . ")'>";
			echo "ID : " . $idFiltro . ",<br>FILTRO: " . $filtro . "</li>";

			$nombres_filtros[$idFiltro] = "filter_" . $filtro;
		}

		echo "</ul>";
		echo "</div>";

		echo "<div class = 'centrar vertical'>";

		echo "<div class = 'infoGeneral centrar vertical'>";
		echo "<span class = 'miFuente'>El metodo '<i>filter_var()</i>' tanto valida como sanitiza los datos. Retorna <i>false</i> en caso de fallar.</span>";
		echo "<div class = 'divCodigo miFuente centrar'>";
		echo "<span class = 'colorFuncion'>filter_var(<span class = 'colorVariable'>"; 
		echo chr(36) . "VARIABLE</span>, <span class = 'colorClave'>FILTRO</span>, ";
		echo "<span class = 'colorVariable'>" . chr(36) . "OPCIONES</span>)</span>";
		echo "</div>";
		echo "<span class = 'miFuente'><i>VARIABLE</i> => Dato a filtrar.</span>";
		echo "<span class = 'miFuente'><i>FILTRO</i> &nbsp;&nbsp;=> El tipo de filtro a utilizar.</span>";
		echo "<span class = 'miFuente'><i>OPCIONES</i> => (opcional) Array asociativo con diversas opciones.</span>";
		echo "<span class = 'miFuente'><i>BANDERA</i> &nbsp;=> (opcional) Modifica la funcionalidad del metodo.</span>";

		echo "<div class = 'divCodigo miFuente centrar vertical-left'>";
		echo "<span class = ''>" . chr(36) . "OPCIONES <span class = 'colorClave'>=</span> <span class = 'colorFuncion'>array</span>( </span>";
		echo "<span class = ''>&nbsp;&nbsp;&nbsp;<span class = 'colorString'>'options'</span> <span class = 'colorClave'>=></span> <span class = 'colorFuncion'>array</span>( </span>";
		echo "<span class = ''>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class = 'colorString'>'default'</span> <span class = 'colorClave'>=></span> <span class = 'colorExtra'><i>valor</i></span>,</span>";
		echo "<span class = ''>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class = 'colorString'><i>'opcion'</i></span> <span class = 'colorClave'>=></span> <span class = 'colorExtra'><i>valor</i></span>,</span>";
		echo "<span class = ''>&nbsp;&nbsp;&nbsp;),</span>";
		echo "<span class = ''>&nbsp;&nbsp;&nbsp;<span class = 'colorString'>'flags'</span> <span class = 'colorClave'>=></span> <span class = 'colorClave'>BANDERA</span>,</span>";
		echo "<span class = ''>);</span>";
		echo "</div>";
		echo "</div>";

		echo "<div class = 'infoFiltro centrar vertical'>";
		echo 	"<span id = 'spanNoSeleccion' class = 'miFuente'>Seleccione un filtro del menu...</span>";

		foreach ($nombres_filtros as $idFiltro => $nombre_filtro) {

			echo 	"<div id = 'divFiltroSeleccionado_" . $idFiltro . "' class = 'miFuente noMostrar divFiltro'>";
			echo 		abrir_y_retornar_archivo($nombre_filtro);
			echo 	"</div>";

		}

		echo "</div>";

		echo "</div>";

		?>

		</div>

	</body>

	<script type="text/javascript">

		var seleccion = "";

		function obtener_botones() {
			var botones = document.getElementsByTagName("li");
			return botones;
		}

		function clear_botones() {

			var botones = obtener_botones();

			for (var i = 0; i < botones.length; i++) {
				botones[i].classList.remove("iluminar");
			}
		}

		function clear_filtros() {
			var filtros = obtener_filtros();

			for (var i = 0; i < filtros.length; i++) {
				filtros[i].classList.add("noMostrar");
			}
		}

		function obtener_filtros() {
			return document.getElementsByClassName("divFiltro");
		}

		function escribir(id) {
			
			var span = document.getElementById("spanNoSeleccion");
			span.classList.add("noMostrar");

			clear_filtros();

			var filtro = document.getElementById("divFiltroSeleccionado_" + id);
			filtro.classList.remove("noMostrar");

			seleccion = id;
		}
		
		function seleccionar_del_menu(id) {
			var boton = document.getElementById("btn" + id);

			clear_botones();

			boton.classList.add("iluminar");

			seleccion = id;

			escribir(id);
		}

	</script>
</html>