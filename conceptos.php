<!DOCTYPE html>
<html>
	<body>

		<h1>CONCEPTOS BASICOS DE PHP</h1>

		<?php # Indica el comienzo de un bloque de codigo PHP.

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
			else if (is_object($variable))
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

		echo rand(1, 10) . '<br';

		?>

		<br>
		FIN DEL DOCUMENTO.

	</body>
</html>