<!DOCTYPE html>
<html lang = "ES">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FORMS</title>
		<link rel = "stylesheet" type = "text/css" href = "./Estilos/style.css">
	</head>
	<body class = "centrar fuente">

			<?php

			$nombre = "";
			$email = "";
			$web = "";
			$comentarios = "";
			$genero = "";

			function comprobar_vacio_POST($campo) {
				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{
					if (empty($_POST["var" . $campo]))
						return "<span class = 'error'>Campo requerido!</span>";
					else
						return validar_POST($campo);
				}
				else
					return "";
			}

			function validar_POST($campo) {

				if ($_SERVER["REQUEST_METHOD"] != "POST")
					return "";

				$valor = $_POST["var" . $campo];

				if (empty($valor))
					return "";

				switch ($campo) {
					case 'Nombre':
						if (!comprobar_nombre($valor))
							return "<span class = 'error'>Nombre invalido!</span>";
						break;
					case 'Email':
						if (!comprobar_email($valor))
							return "<span class = 'error'>Email invalido!</span>";
						break;
					case 'Web':
						if (!comprobar_web($valor))
							return "<span class = 'error'>Pagina Web invalida!</span>";
						break;
					default:
							return "";
						break;
				}
			}

			function filtrar($dato) {
				$dato = trim($dato); 				# Elimina caracteres innecesarios como espacios extras, tab, lineas de salto, etc.
				$dato = stripslashes($dato);		# Elimina '\'.
				$dato = htmlspecialchars($dato);	# Evita que se ejecuten scripts maliciosos.
				return $dato;
			}

			function comprobar_nombre($nombre) {
				if (!preg_match("/^[a-zA-Z-' ]*$/", $nombre))
				 	return false;
				return true;
			}

			function comprobar_email($email) {
				if (!filter_var($email, FILTER_VALIDATE_EMAIL))
					return false;
				return true;
			}

			function comprobar_web($web) {
				if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $web))
					return false;
				return true;
			}

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$nombre = filtrar($_POST["varNombre"]);
				$email = filtrar($_POST["varEmail"]);
				$web = filtrar($_POST["varWeb"]);
				$comentarios = filtrar($_POST["varComentarios"]);
				$genero = array_key_exists("varGenero", $_POST) ? filtrar($_POST["varGenero"]) : '';

				echo '<div class = "divForm centrar vertical otroColor">';
				echo	'<span class = "spanNombre">Nombre : <br>' . $nombre . ' </span>';
				echo	'<span class = "spanEmail">Email : <br>' . $email . '</span>';
				echo	'<span class = "spanEmail">WEB : <br>' . $web . '</span>';
				echo	'<span class = "spanEmail">Comentarios : <br>' . $comentarios . '</span>';
				echo	'<span class = "spanEmail">Genero : <br>' . $genero . '</span>';
				echo '</div>';
			}
		?>

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
			 
			<span class = "spanNombre">NOMBRE : <?php echo comprobar_vacio_POST('Nombre'); ?> </span>
			<input type = "text" name = "varNombre" placeholder = "Nombre..." value = <?php echo $nombre ?> >
			<span class = "spanEmail">EMAIL : <?php echo comprobar_vacio_POST('Email'); ?> </span>
			<input type = "text" name = "varEmail" placeholder = "Email..."  value = <?php echo $email ?> >
			<span class = "spanWeb">WEB : <?php echo validar_POST('Web'); ?> </span>
			<input type = "text" name = "varWeb" placeholder = "Sitio WEB..." value = <?php echo $web ?> >
			<span class = "spanWeb">COMENTARIOS :</span>
			<textarea name = "varComentarios" rows = '5' placeholder = "Comentarios..."><?php echo $comentarios ?></textarea>

			<span class = "spanGenero">GENERO : <?php echo comprobar_vacio_POST('Genero'); ?> </span>
			<div class = "seleccionGenero centrar">
				<input type = "radio" name = "varGenero" value = "Femenino" <?php if ($genero == "Femenino") echo 'checked'; ?> >F
				<input type = "radio" name = "varGenero" value = "Masculino"  <?php if ($genero == "Masculino") echo 'checked'; ?> >M
				<input type = "radio" name = "varGenero" value = "Otro"  <?php if ($genero == "Otro") echo 'checked'; ?> >O
			</div>

			<input type = "submit" class = "myButton fuente">
		</form>

	</body>
</html>