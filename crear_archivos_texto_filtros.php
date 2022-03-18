<?php

	foreach (filter_list() as $idFiltro => $filtro) {

		$nuevo_archivo = fopen("./archivos_filtros/filter_" . $filtro . ".txt", "w");

		if ($nuevo_archivo == false)
			echo "El archivo 'filter_" . $filtro . ".txt' no se pudo crear.<br>";
		else
		{
			echo "El archivo 'filter_" . $filtro . ".txt' se pudo crear.<br>";
			fwrite($nuevo_archivo, "<b></b>");
			fclose($nuevo_archivo);
		}
	}

?>