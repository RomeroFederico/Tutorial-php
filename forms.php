<!DOCTYPE html>
<html lang = "ES">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FORMS</title>
		<link rel = "stylesheet" type = "text/css" href = "./Estilos/style.css">
	</head>
	<body class = "centrar fuente">

		<!-- El metodo GET se utiliza cuando se envia informacion no sensitiva, es visible al usuario y es posible 'guardar' la pagina. Ademas es 
				limitada la cantidad de informacion que se puede enviar. -->
		<!-- El metodo POST se utiliza cuando se envia informacion sensitiva, es oculta al usuario y y no es posible 'guardar' la pagina. -->

		<form action = "destino.php" method = "post" class = "divForm centrar vertical">

			<h3>FORM SIN VALIDACION</h3>
			 
			<span class = "spanNombre">NOMBRE :</span><input type = "text" name = "varNombre" placeholder = "Nombre...">

			<span class = "spanEmail">EMAIL :</span><input type = "text" name = "varEmail" placeholder = "Email...">

			<input type = "submit" class = "myButton fuente">
		</form>

		<!-- htmlspecialchars() convierte caracteres especiales a entidades HTML. Proteje contra hackeos. 
		-->
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" class = "divForm masGrande centrar vertical otroColor">

			<h3>FORM CON VALIDACION</h3>
			 
			<span class = "spanNombre">NOMBRE : <?php echo comprobar_POST('Nombre'); ?> </span>
			<input type = "text" name = "varNombre" placeholder = "Nombre...">
			<span class = "spanEmail">EMAIL : <?php echo comprobar_POST('Email'); ?> </span>
			<input type = "text" name = "varEmail" placeholder = "Email...">
			<span class = "spanWeb">WEB :</span>
			<input type = "text" name = "varWeb" placeholder = "Sitio WEB...">
			<span class = "spanWeb">COMENTARIOS :</span>
			<textarea name = "varComentarios" rows = '5' placeholder = "Comentarios..."></textarea>

			<span class = "spanGenero">GENERO : <?php echo comprobar_POST('Genero'); ?> </span>
			<div class = "seleccionGenero centrar">
				<input type = "radio" name = "varGenero" value = "Femenino">F
				<input type = "radio" name = "varGenero" value = "Masculino">M
				<input type = "radio" name = "varGenero" value = "Otro">O
			</div>

			<input type = "submit" class = "myButton fuente">
		</form>

		<?php

			function comprobar_POST($campo) {
				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{
					if (empty($_POST["var" . $campo]))
						return "<span class = 'error'>Campo requerido!</span>";
				}
				else
					return "";
			}

			function filtrar($dato) {
				$dato = trim($dato); 				# Elimina caracteres innecesarios como espacios extras, tab, lineas de salto, etc.
				$dato = stripslashes($dato);		# Elimina '\'.
				$dato = htmlspecialchars($dato);	# Evita que se ejecuten scripts maliciosos.
				return $dato;
			}

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$nombre = filtrar($_POST["varNombre"]);
				$email = filtrar($_POST["varEmail"]);
				$website = filtrar($_POST["varWeb"]);
				$comment = filtrar($_POST["varComentarios"]);
				$genero = array_key_exists("varGenero", $_POST) ? filtrar($_POST["varGenero"]) : '';

				echo '<div class = "divForm centrar vertical otroColor">';
				echo	'<span class = "spanNombre">Nombre : <br>' . $nombre . ' </span>';
				echo	'<span class = "spanEmail">Email : <br>' . $email . '</span>';
				echo	'<span class = "spanEmail">WEB : <br>' . $website . '</span>';
				echo	'<span class = "spanEmail">Comentarios : <br>' . $email . '</span>';
				echo	'<span class = "spanEmail">Genero : <br>' . $genero . '</span>';
				echo '</div>';
			}


		?>

	</body>
</html>