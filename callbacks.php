<?php

// ------------------------------------------------------------

// Funciones Callbacks (CB)

// Permite utilizar funciones como argumentos. Simplemente se escribe el nombre de la funcion como 'string' y se lo pasa como argumento de la funcion.


function CBCapitalizar($value) { // Funcion CB.
	return strtoupper($value);	 // Retorna un valor a la vez, el cb se ejecutara en cada elemento del array.
} 

function CBimprimirArray($key, $value) { // 'array_map' toma como argumento la funcion callback y el array a mapear.
										 // En condiciones normales, la funcion callback solo necesita como argumento el valor en el index actual.
										 // Pero si se necesita la clave, debe enviarse dos veces el array.
	echo "<i>LLave</i> => " . $key . ", <i>Valor</i> => " . $value . "<br>";
	return [$key, $value];
}

$miArray = ["Marca" => "Ford", "Color" => "Azul", "Patente" => "123456"];

$miArray = array_map("CBCapitalizar", $miArray);
array_map("CBimprimirArray", $miArray, $miArray);

echo "<br>";

// Tambien se puede enviar funciones anonimas.

var_dump( array_map(function($value) { return strlen($value); }, $miArray)); // ["Marca" => 4, "Color" => 4, "Patente" => 6;

echo  "<br>";

function CBcursiva($value) {
	return strtolower($value);
}

function imprimir_con_formato($value, $CB) {
	echo $CB($value) . "<br>"; // Para utilizar un cb simplemente se la escribe con '$' adelante y se adjunta los parentesis propios de una funcion.
}

imprimir_con_formato("Federico", "CBcursiva");
imprimir_con_formato("Federico", "CBCapitalizar");