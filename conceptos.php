<?php declare(strict_types=1); # Permite poner en modo estricto el codigo, los tipos de datos deben respetarse.
?>

<!DOCTYPE html>
<html>
	<body>

		<h1>CONCEPTOS BASICOS DE PHP</h1>

		<?php # Inicio de bloque de codigo PHP

		echo '<br>'; // 'echo' imprime en pantalla, el navegador lo interpretara como codigo HTML.

		echo 'PHP version: ' . phpversion(); // Version de PHP.
											 // '.' concatena cadenas de texto.

		// Indica el fin del bloque de codigo PHP.

		$variable = '<br>soy una variable.'; // Las variables se indican con '$' al inicio. No se declaran ni requieren una palabra especifica para inicializarlas.

		echo "<br>El contenido de la variable es : $variable";
		ECHO "<br>";

		// echo "$variaBLE"; // Las palabras claves no son 'case-sensitive'. Por otro lado las variables si lo son.

		$_pruebaComentario = 123 /* 456 */ + 789; // Se puede ingresar comentarios entre el codigo.

		echo $_pruebaComentario . '<br>';

		/* ---------------------------------------------- */

		// SCOPE DE LAS VARIABLES.

		// GLOBAL : Son aquellas variables declaradas afuera de las funciones. No pueden ser accedidas por estas.
		// LOCAL : Son aquellas variables declaradas dentro de las funciones. No pueden ser accedidas fuera de estas.
		// STATIC : Idem a las locales, pero la informacion de la variable queda guardada para poder ser utilizada en otra ocasion.

		$variable_a_mostrar = "Mundo";

		function imprimirVariable() {
			// echo $variable_a_mostrar; // ERROR.
			$variable_a_mostrar = "<br>Hola"; // Variable local, puede incluso utilizar el nombre de variables globales sin repercusiones.
			echo $variable_a_mostrar;
		}

		imprimirVariable();
		echo ' ' . $variable_a_mostrar . '<br>'; // La variable local no se ha modificado por la funcion.

		function imprimirVariableV2() {
			global $variable_a_mostrar; // 'global' permite acceder a variables globales dentro de funciones. Aqui si es necesario declararlas.
			echo $variable_a_mostrar;
		}

		function imprimirVariableV3() {
			echo $GLOBALS['variable_a_mostrar']; // Tambien se puede acceder a las variables globales a traves del array '$GLOBALS'.
		}

		//imprimirVariablesV2();
		imprimirVariableV3();
		echo ' ' . $variable_a_mostrar;

		function imprimirVariableEstatica() {
			static $variable = 0; // Declaracion de variable estatica (con valor inicial). Solo se ejecuta la primera vez que se llama a la funcion.
			$variable++;
			return $variable;
		}

		echo '<br>' . imprimirVariableEstatica() . imprimirVariableEstatica() . imprimirVariableEstatica();

		/* ---------------------------------------------- */

		// PRINT Y ECHO.

		// PRINT : Imprime en pantalla, toma un solo argumento y retorna '1'. Es mas lento que 'echo'.
		// ECHO : Imprime en pantalla, acepta multiples argumentos y no retorna nada. Es mas rapido que 'print'.

		echo "<br>Hola", " mundo", "!!!"; // Con multiples argumentos (separados con coma).
		echo('<br>--------------'); // Se puede indicar con parentesis.

		print "<br>Hola" . " mundo" . "!!!"; // Notese que print solo puede tomar un unico argumento.
		print('<br>--------------');

		/* ---------------------------------------------- */

		// Tipos de datos.

		// String : Cadenas de caracteres. Se indican con comillas.
		// Integer : Numero no decimal entre -2,147,483,648 y 2,147,483,647 (32bits) o -9223372036854775808 y 9223372036854775807 (64bits).
		// Al excederse, la variable se almacenara como float. Puede indicarse con notacion decimal (base 10), hexadecimal (base 16), octal (base 8), o binario (base 2).
		// Float : Numero con punto decimal o un numero exponencial.
		// Boolean : Valor booleano 'true' o 'false'.
		// Array : Almacena multiples variables/valores en una unica variable.
		// Object : Instancia de una clase.
		// Null : Unico valor 'NULL'. Son aquellas variables iniciadas sin un valor indicado. Tambien pueden asignarse con este valor para indicar que estan 'vacias'.
		// Resource : No es un tipo de dato, es una referencia a funciones y recursos externos a PHP.

		class Car {
			public $color;
			public $model;
			private $patente;

			public function __construct($color, $model) {
				$this->color = $color;
				$this->model = $model;
				$this->patente = 999;
			}
			public function mensaje() {
				return "Mi auto es de color " . $this->color . " y su modelo es " . $this->model . "!";
			}
		}

		$variable_string = "123";
		$variable_integer = 123;
		$variable_float = 1.23;
		$variable_boolean = true; // NOTA: Al imprimirse en pantalla, 'true' se muestra como '1', mientras que 'false' como ''.
		$variable_array = array(1, "2", 3.0); // No se puede imprimir el array directamente.
		$variable_object = new Car("Naranja", 'Toyota'); // Idem.
		$variable_null = null;

		function imprimir_variable_y_tipo($variable) {

			if (is_array($variable))
				echo 'variable : -array- <br>';
			elseif (is_object($variable))
				echo 'variable : -objeto clase "' . get_class($variable) .'"- <br>';
			else
				echo 'variable : ' . $variable . '<br>';

			var_dump($variable);
			echo '<br>';
		}

		echo '<br>';
		imprimir_variable_y_tipo($variable_string);
		imprimir_variable_y_tipo($variable_integer);
		imprimir_variable_y_tipo($variable_float);
		imprimir_variable_y_tipo($variable_boolean);
		imprimir_variable_y_tipo($variable_array);
		imprimir_variable_y_tipo($variable_object);
		imprimir_variable_y_tipo($variable_null);

		/* ---------------------------------------------- */

		// Manejo de strings.

		$cadena_a_manejar = "Hola mundo";

		// strlen(cadena) -> Retorna el largo de la cadena pasada como argumento.

		echo strlen($cadena_a_manejar); //10.
		echo "<br>";

		// str_word_count(cadena) -> Retorna la cantidad de palabras.

		echo str_word_count($cadena_a_manejar); //2
		echo "<br>";

		// strrev(cadena) -> Retorna el reverso de la cadena.

		echo strrev($cadena_a_manejar); //odnum aloH.
		echo "<br>";

		// strpos(cadena, buscar) -> Retorna la posicion del primer elemento que coincida, false si no encuentra nada.

		echo strpos($cadena_a_manejar, 'mundo'); //5
		echo "<br>";

		// str_replace(busca, reemplaza, cadena) -> Reemplaza lo buscado con la cadena indicada. Si no encuentra devuelve la cadena original.

		echo str_replace('mundo', 'Argentina', $cadena_a_manejar); // Hola Argentina
		echo "<br>";

		/* ---------------------------------------------- */

		// Manejo de numeros.

		// PHP_FLOAT_MAX -> El numero mas largo que puede ser representado por una variable float. Un numero superior a este es considerado infinito (INF).

		// is_finite() -> True si es un numero finito, false en caso contrario.
		// is_infinite() -> True si es un numero infinito, false en caso contrario.
		// is_nan() -> True si el valor indicado no es un numero (NAN), false en caso contrario.
		// is_numeric() -> True si el valor indicado es un numero o es una cadena numerica (hexadecimales no cuentan), false en caso contrario.
		// (int) -> 'Cast' de float o string a entero, redondea para abajo. Tambien se puede indicar con intval() o (integer).

		/* ---------------------------------------------- */

		// PHP MATH.

		//pi() -> Retorna el valor de pi.

		echo pi() . '<br>';

		// min(var1, ..., varx) -> Retorna el valor minimo de la lista de argumentos o el array pasado como el mismo.

		echo min([1, 2, 5, -9, 0]) . '<br>';

		// max(var1, ..., varx) -> idem, pero retorna el valor maximo.

		echo max(1, 2, 5, -9, 0) . '<br>';

		// abs(var) -> Retorna el valor absoluto (positivo) del argumento pasado.

		echo abs(-10.5) . '<br>';

		// sqrt(var) -> Retorna la raiz cuadrada del valor pasado.

		echo sqrt(9) . '<br>';

		// round(var) -> Retorna el valor redondeado al valor mas cercano del argumento pasado.

		echo round(7.5) . '<br>'; // 8
		echo round(7.49) . '<br>'; // 7
		echo round(7.51) . '<br>'; // 8

		// rand(min, max) -> Retorna un valor aleatorio entre min y max (inclusive).

		echo rand(1, 10) . '<br>';

		/* ---------------------------------------------- */

		// PHP Constantes

		// Variables que una vez definidas no pueden modificarse. Se indican comenzando con '_' o una letra, no utilizan '$'. Son de tipo global.

		define('_NOMBRE', 'valor', false); // case-insensitive, default -> false. NOTA: YA NO ES SOPORTADO QUE SEA CASE-INSENSITIVE.

		// _NOMBRE = 'nuevo valor'; // ERROR.

		echo _NOMBRE . '<br>';

		define('_ARRAY', ['valor1', 'valor2', 'valor3'], false);

		echo _ARRAY[1] . '<br>'; // valor2 

		function imprimir_array_constante() {

			$retornar = 'Los valores del array son: <br>';

			for ($i = 0; $i < count(_ARRAY); $i++) { // Se puede acceder a el sin utilizar 'global' o el array $GLOBALS.
				$retornar = $retornar . 'indice : ' . $i . ' , valor : ' . _ARRAY[$i] . '<br>';
			}

			return $retornar;
		}

		echo imprimir_array_constante();

		/* ---------------------------------------------- */

		// OPERADORES

		// ARITMETICOS:
		// +	SUMA
		// -	RESTA
		// *	MULTIPLICACION
		// /	DIVISION
		// %	MODULO
		// **	EXPONENCIAL	-> Eleva el primer numero al segundo (exponente).

		// DE ASIGNACION:
		// x = y	->	x = y
		// x += y	->	x = x + y
		// x -= y	->	x = x - y
		// x *= y	->	x = x * y
		// x /= y	->	x = x / y
		// x %= y	->	x = x % y

		// DE COMPARACION:
		// ==	IGUAL
		// ===	IDENTICO	
		// !=	NO IGUAL
		// <>	NO IGUAL
		// !==	NO IDENTICO
		// >	MAYOR A
		// <	MENOR A
		// >=	MAYOR O IGUAL A
		// <=	MENOR O IGUAL A
		// <=>	Spaceship	$x <=> $y -> RETORNA UN ENTERO DEPENDIENDO DE:	si x es menor a y -> < 0
		//																	si x es mayor a y -> > 0
		//																	si x es igual a y -> === 0

		// INCREMENTALES/DECREMENTALES:
		// ++$X -> INCREMENTA, LUEGO RETORNA $X.
		// $X++ -> RETORNA $X, LUEGO INCREMENTA.
		// --$X -> DECREMENTA, LUEGO RETORNA $X.
		// $X-- -> RETORNA $X, LUEGO DECREMENTA.

		// LOGICOS:
		// and	AND	$x and $y
		// or	OR	$x or $y
		// xor	XOR	$x xor $y -> true si uno de los dos valores es true, pero no los dos al mismo tiempo.
		// &&	AND	$x && $y
		// ||	OR	$x || $y
		// !	NOT !x

		// OPERADORES DE STRINGS:
		// . CONCATENACION.
		// .= CONCATENACION CON ASIGNACION.

		// OPERADORES DE ARRAYS:
		// + UNION
		// == IGUAL -> Si ambos arrays tienen los mismos pares de key/value.
		// === IDENTICO -> Si ambos arrays tienen los mismos pares de key/value, en el mismo orden y del mismo tipo.
		// != NO IGUAL
		// <> NO IGUAL
		// !== NO IDENTICO

		// DE ASIGNACION CONDICIONAL
		// ?: TERNARIO x === y ? 'nuevo valor' : 'otro valor';
		// ?? NULL COALESCING x = $GLOBALS["color"] ?? 'red'; -> Aplica la primera expresion si existe y no es nula, caso contrario 'x' tomara el valor de la segunda expresion.

		$PRUEBA_X = $GLOBALS["color"] ?? 'red';

		$PRUEBA_Y = $PRUEBA_X ?? 'azul';

		echo $PRUEBA_X . '<br>';
		echo $PRUEBA_Y . '<br>';

		/* ---------------------------------------------- */

		// EXPRESIONES IF...ELSEIF...ELSE...SWITCH (IGUAL A JS)

		// BUCLES WHILE...DO WHILE...FOR (IGUAL A JS)
		// break y continue funcionan igual a JS.

		$array_a_recorrer = [1, 2, 8, 10];
		$array_a_recorrer_v2 = ['valor1' => 1, 'valor2' => 3, 'valor3' => 8, 'valor4' => 10];

		foreach ($array_a_recorrer as $valor) { // Solo puede recorrer arrays.
			echo $valor . '<br>';
		}

		foreach ($array_a_recorrer_v2 as $clave => $valor) { // Idem, pero permite visualizar los pares clave/valor.
			echo $clave . ' => ' . $valor . '<br>';
		}

		/* ---------------------------------------------- */

		// FUNCIONES

		function saludar(string $nombre = "Federico") { // En modo estricto, si se indica el tipo de dato, no puede pasarse un valor de otro tipo.
			echo "Hola " . $nombre . "<br>";			// En caso contrario, se convertiran los valores.
		}

		saludar(); // Si no se pasa nada como argumento se toma el por default.
		saludar("Antonio");
		#saludar(123); // ERROR

		function sumar(int $x = 0, int $y = 0) : int { // Tambien se puede especificar el tipo de dato devuelto.
			return (int)($x + $y); // Tambien se puede castear para que el retorno sea del tipo deseado.
		}

		echo sumar(3, 5) . "<br>";

		$variable_a_pasar_con_referencia = 10;

		function incrementar(int $variable) { // Al pasar una variable como argumento, se genera una copia de esta para usarse en la funcion.
			$variable++;					  // Cualquier modificacion a la misma no afectara a la variable original.
		}

		function incrementar_por_referencia(int &$variable) { // Se puede pasar una referencia a la variable con el caracter '&'.
			$variable++;									  // Cualquier modificacion a la misma afectara a la variable original.
		}

		incrementar($variable_a_pasar_con_referencia);

		echo $variable_a_pasar_con_referencia . "<br>"; // 10

		incrementar_por_referencia($variable_a_pasar_con_referencia);

		echo $variable_a_pasar_con_referencia . "<br>"; // 11

		/* ---------------------------------------------- */

		// ARRAYS

		// INDEXEADOS => Arreglos con indices numericos.
		// ASOCIATIVOS => Arreglos con indices con palabras (key/value).
		// MULTIDIMENSIONALES => Arreglos que contienen uno o mas arrays.

		$almacen_de_frutas = ["PERA", "MANZANA", "BANANA"];
		$almacen_de_frutas_V2 = [
									"PERAS" => ["PERAS AMARILLAS", "PERAS ROJAS", "PERAS VERDES"] , 
									"MANZANAS" => ["MANZANAS VERDES", "MANZANAS ROJAS"],
									"BANANAS" => ["BANANAS"]
								];

		echo "Hay " . count($almacen_de_frutas) . " frutas almacenadas." . "<br>"; // Count devuelve la cantidad de elementos del array.
		echo "Hay " . count($almacen_de_frutas_V2) . " frutas almacenadas." . "<br>"; // En caso de arrays anidados, cuenta el primer nivel.

		$almacen_de_frutas_v3 = ["DURAZNO"];

		$almacen_de_frutas_v3[1] = ["UVAS"]; // Se puede agregar valores directamente indicanco el indice.
		$almacen_de_frutas_v3[3] = ["KIWI"]; // Incluso se puede saltear indices.

		#echo $almacen_de_frutas_v3[2] . "<br>"; // Tratar de acceder un elemento en un indice no definido dara error.

		function imprimir_almacen($almacen_de_frutas)
		{
			echo "<ol>";

			foreach($almacen_de_frutas as $frutas => $tipos) { // Recorrido de un array asociativo.

				echo "<li>FRUTA : " . $frutas . "<ul>";

				for ($i = 0; $i < count($tipos); $i++) {  // Recorrido de un array indexeado.
					echo "<li>" . $tipos[$i] . "</li>";
				}

				echo "</ul></li>";
			}

			echo "</ol>";
		}

		imprimir_almacen($almacen_de_frutas_V2);

		// ORDENAMIENTO DE ARRAYS.

		// sort() - DE FORMA ASCENDENTE
		// rsort() - DE FORMA DESCENDENTE
		// asort() - ASOCIATIVOS -> DE ACUERDO AL VALOR, ASCENDENTE.
		// ksort() - ASOCIATIVOS -> DE ACUERDO A LA CLAVE, ASCENDENTE.
		// arsort() - ASOCIATIVOS -> DE ACUERDO AL VALOR, DESCENDENTE.
		// krsort() - ASOCIATIVOS -> DE ACUERDO A LA CLAVE, DESCENDENTE.

		ksort($almacen_de_frutas_V2);
		imprimir_almacen($almacen_de_frutas_V2);

		arsort($almacen_de_frutas_V2);
		imprimir_almacen($almacen_de_frutas_V2); // En caso de ordenar array contra array, cuenta la cantidad de variables.

		?>

		<br>
		FIN DEL DOCUMENTO.

	</body>
</html>