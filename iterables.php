<?php

// ------------------------------------------------------------

// Iterables

// Es cualquier valor que puede ser iterado (looped) a traves del bucle 'foreach()'.
// El pseudo-tipo 'iterable' fue introducido en PHP 7.1, pudiendo ser utilizado como un tipo de dato para los argumetnos y valores de rotorno de los
// metodos. 

function capitalizar_array(iterable $array) # Puedo indicar el tipo de dato 'iterable' en la lista de argumentos.
:iterable { # idem en el valor de retorno.
	return array_map( function($cadena) { return strtoupper($cadena); }, $array);
}

$mi_array = ["uno", "DOS", "TreS"];

echo var_dump($mi_array) . "<br>";
echo "<br>";
echo var_dump(capitalizar_array($mi_array)) . "<br>";

// Crear iterables:
// ARRAYS-> Todos los arrays son iterables.
// OBJETOS -> Cualquier objeto que implemente la interfaz 'Iterator' es considerado iterable por lo que puede ser utilizado como argumento/valor de 
// 			  retorno de un metodo.

// ITERATOR:
// Un iterador contiene una lista de items y provee metodos para iterarlos. Mantiene un puntero apuntado a uno de los elementos de la lista.
// Cada item es esta tiene una llave que puede ser utilizada para encontrarla.

// Metodos que debe inplementar un iterador:
// current() -> Retorna el elemento apuntado por el puntero actual. Puede ser de cualquier tipo de dato.
// key() 	 -> Retorna la llave asociada con el elemento apuntado actual. Puede ser 'integer', 'float', 'boolean' o 'string'.
// next() 	 -> Mueve el puntero al siguiente elemento de la lista.
// rewind()	 -> Mueve el puntero al primer elemento de la lista.
// valid()	 -> Si el puntero interno no esta apuntando a ningun elemento (ej: si 'next()' fue llamado al alcanzar el ultimo item), este deberia 
//				retornar 'false'. En caso contrario, 'true'.

class MiIterador implements Iterator { # Implementacion de la interfaz 'Iterator'.
	private $array = []; # Lista de items.
	private $puntero = 0; # Valor inicial del puntero.

	public function __construct($items) {
		$this->array = array_values($items); # 'array_values()' toma un array y devuelve un array indexeado.
	}

	public function current() {
		return $this->array[$this->puntero]; # Retorno el elemento apuntado por el puntero.
	}

	public function key() {
		return $this->puntero; # Retarno el puntero.
	}

	public function next() {
		$this->puntero++; # Incremento el puntero.
	}

	public function rewind() {
		$this->puntero = 0; # Restablezco el puntero al valor inicial.
	}

	public function valid() {
		return $this->puntero < count($this->array); # Solo si el puntero es menor al largo de la lista de items retornara 'true'.
	}
}

function imprimir_iterable(iterable $miIterable) {
	foreach($miIterable as $item) {	# Automaticamente 'foreach' reconoce a 'miIterable' como iterable y recorre el array de items que contenga.
		echo $item . "<br>";
	}
}

// Proceso del 'foreach' en objetos que implementan la interfaz 'Iterator': 
// 1. Antes de la primera iteracion => Se llama a Iterator::rewind().
// 2. Antes de cada iteracion => Se llama a Iterator::valid().
// 3a. Si Iterator::valid() retorna 'false' => El bucle termina.
// 3b. Si Iterator::valid() retorna 'true' => Se llama a Iterator::current() y a Iterator::key().
// 4. El cuerpo del bucle se evalua.
// 5. Al final de cada bucle => Se llama a Iterator::next() y se vuevle al paso 2.

$iterador = new MiIterador(["a", "b", "c"]);
imprimir_iterable($iterador);

?>