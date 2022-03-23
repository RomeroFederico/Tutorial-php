<?php

// ------------------------------------------------------------

// Manejo de JSON

// JSON (Javascript Object Notation) es una sintaxis para el almacenamiento e intercambio de data.
// Ya que es un formato basado en texto, puede ser enviado y recibido facilmente desde un servidor, y tambien ser usado como un formato de datos
// en cualquier lenguaje de programacion.

// Composicion de un objeto JSON.

// "{"atributo":variable,"otro_atributo":"variable"}" -> Notese las comillas que encapsulan al objeto.


# json_encode() -> Encodea un valor a formato JSON.

$variable = "Hola soy una variable";

$array_asociativo = ["llave1" => 123, "llave2" => "...Adios!", "llave3" => false];

$array_indexeado = [123, "...Adios!", false];

$objeto = (object) ["atributo" => 456.789, "otro_atributo" => "789!"]; # Casteo un array a objeto.

$variable_json = json_encode($variable);
$array_asociativo_json = json_encode($array_asociativo);
$array_indexeado_json = json_encode($array_indexeado);
$objeto_json = json_encode($objeto);

echo $variable_json . "<br>"; 			  # "Hola soy una variable"
echo $array_asociativo_json . "<br>";	  # "{"llave1":123,"llave2":"...Adios!","llave3":false}"
echo $array_indexeado_json . "<br>";	  # "[123,"...Adios!",false]"
echo $objeto_json . "<br>";	  			  # "{"atributo":456.789,"otro_atributo":"789!"}"

// Tanto el array asociativo como el objeto son transformados de la misma manera.

# json_decode() -> Encodea un objeto JSON a un objeto PHP.

$objeto_json_a_php = json_decode($objeto_json);

echo "<br>";
echo var_dump($objeto_json_a_php) . "<br>"; # object(stdClass)#2 (2) { ["atributo"]=> float(456.789) ["otro_atributo"]=> string(4) "789!" }
											# {"atributo" : 456.789, "otro_atributo" : "789!"}

echo "<br><b>Atributos del objeto json a objeto php:</b><br>";
/*
echo "<br><b>Atributos del objeto json a objeto php:</b><br>";
echo "atributo: " . $objeto_json_a_php->atributo . "<br>";
echo "otro_atributo: " . $objeto_json_a_php->otro_atributo . "<br>";
*/
foreach ($objeto_json_a_php as $key => $value) {
	echo "<b>" . $key . ":</b> " . $value . "<br>";
}

// La conversion por defecto es a un objeto 'stdClass'.

$array_asociativo_json_a_php = json_decode($array_asociativo_json, true);

echo "<br>";
echo var_dump($array_asociativo_json_a_php) . "<br>"; # array(3) { ["llave1"]=> int(123) ["llave2"]=> string(9) "...Adios!" ["llave3"]=> bool(false) }
													  # ["llave1" => 123, "llave2" => "...Adios!", "llave3" => false];

echo "<br><b>Atributos del objeto json a array asociativo php:</b><br>";
/*
echo "llave1: " . $array_asociativo_json_a_php["llave1"] . "<br>";
echo "llave2: " . $array_asociativo_json_a_php["llave2"] . "<br>";
echo "llave3: " . $array_asociativo_json_a_php["llave3"] . "<br>";
*/
foreach ($array_asociativo_json_a_php as $key => $value) {
	echo "<b>" . $key . ":</b> " . $value . "<br>";
}

// El segundo argumento (opcional) de 'json_decode' si se le asigna 'true' convierte a un array asociativo.