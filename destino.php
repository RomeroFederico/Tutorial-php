<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>DESTINO</title>
		<link rel = "stylesheet" type = "text/css" href = "./Estilos/style.css">
	</head>
	<body class = "centrar fuente vertical">

		<?php 

		if ($_SERVER["REQUEST_METHOD"] == "GET" or (empty($_POST['varNombre']) or empty($_POST['varEmail'])))
		{
			echo "<div class = 'divForm centrar vertical'>";
			echo 	"<div class = ''>ERROR!!!</div>";
			echo    "<form method = 'get' action = 'forms.php'>";
			echo 		"<input class = 'myButton' type = 'submit' value = 'Volver al inicio'></input";
			echo    "</form>";
			echo "</div>";
		}
		else if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			echo '<h1>Bienvenido</h1>';

			echo '<div class = "divForm centrar vertical">';
			echo	'<span class = "spanNombre">Nombre : <br>' . $_POST["varNombre"] . ' </span>';
			echo	'<span class = "spanEmail">Email : <br>' . $_POST["varEmail"] . '</span>';
			echo '</div>';
		}

		?>

	</body>
</html>