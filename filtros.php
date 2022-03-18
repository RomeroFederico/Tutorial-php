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

		echo "<div class = 'divMenu miFuente'><h3 class = 'titulo'>Lista de filtros</h3><ul>";

		foreach (filter_list() as $idFiltro => $filtro) {

			echo "<li id = 'btn" . $idFiltro . "'" . " class = '" . encender_opcion_menu($idFiltro) . "'";
			echo "onclick = 'seleccionar_del_menu(" . '"' . $idFiltro . '"' . ")'>";
			echo "ID : " . $idFiltro . ",<br>FILTRO: " . $filtro . "</li>";
		}

		echo "</ul>";
		echo "</div>";

		echo "<div class = 'centrar vertical'>";

		echo "<div class = 'infoGeneral centrar vertical'>";
		echo "<span class = 'miFuente'>El metodo '<i>filter_var()</i>' tanto valida como sanitiza los datos.</span>";
		echo "<div class = 'divCodigo miFuente centrar'>filter_var(VARIABLE, FILTRO);</div>";
		echo "<span class = 'miFuente'><i>VARIABLE</i> => Dato a filtrar.</span>";
		echo "<span class = 'miFuente'><i>FILTRO</i> => El tipo de filtro a utilizar.</span>";
		echo "</div>";

		echo "<div class = 'infoFiltro centrar'>";
		echo "<span id = 'spanNoSeleccion' class = 'miFuente'>Seleccione un filtro del menu...</span>";
		echo "<div id = 'divFiltroSeleccionado' class = 'miFuente noMostrar'></div>";
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

		function escribir(id) {
			var span = document.getElementById("spanNoSeleccion");
			var div = document.getElementById("divFiltroSeleccionado");
			span.classList.add("noMostrar");
			div.classList.remove("noMostrar");
			div.innerHTML = "Hola soy el filtro " + id;
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