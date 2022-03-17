<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SUBIDA DE ARCHIVOS</title>
		<link rel="stylesheet" type="text/css" href="./Estilos/style.css">
	</head>
	<body class = "centrar fuente">
		<div class = "divForm centrar">
			<form action = "destino_subida.php" method = "post" enctype = "multipart/form-data" class = "formSubir centrar vertical">
				<span class = "spanSubir">Selecciona una imagen para subir</span>
				<input type = "file" name = "varArchivo" id = "varArchivo">
				<input type = "submit" value = "SUBIR" name = "varSubir" class = "myButton">
			</form>
		</div>

		<?php

		// SUBIDA DE ARCHIVOS.

		// NOTA: ASEGURARSE QUE EN EL ARCHIVO 'PHP.INI' LA DIRECTIVA 'file_uploads' SEA == On. (UTILIZAR PHPINFO() PARA AVERIGUAR LA UBICACION DEL MISMO).
		// Para poder realizarse en un form:
		// 1- El metodo debe ser 'POST'.
		// 2- Debe especificarse 'enctype = "multipart/form-data"'.

		?>

	</body>
</html>