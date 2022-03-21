<?php 

// ------------------------------------------------------------

// Programacion Orientada a Objetos.

// Objetos => Contienen tanto metodos como atributos (variables).

// BENEFICIOS:

// + Rapida y facil de ejecutar.
// Estructura mas limpia de codigo.
// Codigo con menos repeticiones, haciendolo mas facil de mantener, modificar y debugear.
// Permite reutilizar el codigo para escribir nuevas aplicaciones en menor cantidad de tiempo.

// Clases => Es el esqueleto/base de los objetos que instancia. En estas se definen los metodos y atributos comunes a cada objeto,
// Objetos => Instancia de una clase. Cada objeto tendran los mismos metodos y atributos, pero podran contener distintos valores.

// MODIFICADORES DE ACCESO DE LAS PROPIEDADES O METODOS:

// public -> Puede ser accedido en todos lados (defecto).
// protected -> Solo puede ser accedido dentro de la clase y las que sean derivadas de esta.
// private -> Solo puede ser accedido dentro de la clase.

/**
 * Clase Fruta.
 */
class Fruta # NOMBRE DE LA CLASE
{
	public $color;	# ATRIBUTOS DE LA CLASE (PUBLICOS).
	public $nombre; # CADA OBJETO INSTANCIADA TENDRA ACCESOS A ESTOS ATRIBUTOS.
	protected $codigo;# ATRIBUTO DE LA CLASE PROTEGIDO.
	
	function __construct($nombre, $color, $codigo) # CONSTRUCTOR DE LA CLASE, CADA VEZ QUE SE INSTANCIA UN OBJETO PRIMERO SE EJECUTA ESTE METODO.
	{
		$this->nombre = $nombre; # PARA ACCEDER UN PARAMETRO/METODO DE UN OBJETO SE UTILIZA '->'.
		$this->color = $color;	 # '$this' ES UNA REFERENCIA AL OBJETO QUE ESTA LLAMANDO A LA FUNCION.
		$this->codigo = $codigo; # EN ESTE CASO SE INSTANCIA UN NUEVO OBJETO, SE LLAMA AL CONSTRUCTOR Y DENTRO DE ESTE '$this' REFERENCIARA AL NUEVO
								 # OBJETO QUE SE ESTA CREANDO.
	}

	function __destruct() { # METODO QUE SE EJECUTARA CUANDO EL OBJETO SEA DESTRUIDO O SE ALCANZE EL FIN DEL SCRIPT (CERRAR LA PAGINA O QUE SE DETENGA).
		echo "<br>El siguiente objeto sera destruido:<br>" . $this->devolver_datos(); 
	}

	function devolver_datos() {	# METODO DE LA CLASE, ACCESIBLES A CADA INSTANCIA.
		return "<b><i>Nombre</i></b>: $this->nombre<br><b><i>Color</i></b>: $this->color<br><b><i>Codigo</i></b>: " . 
		$this->devolver_codigo_completo() . "<br>";
	}

	function set_codigo($value) {
		$this->codigo = $value;
	}

	function devolver_codigo_completo() {
		return strtoupper(substr($this->nombre, 0, 3)) . "-$this->codigo";	
	}
}

$banana = new Fruta("Banana", "Amarilla", "001"); # INSTANCIA DE UN NUEVO OBJETO DE LA CLASE 'Fruta'.
$naranja = new Fruta("Naranja", "Naranja", "002");

$banana->color = "Verde";		 # Puedo acceder y modificar los atributos ya sea referenciando al atributo en si mismo...
$naranja->set_codigo("001"); # O puedo hacerlo desde metodos.
//$naranja->codigo = "NAR-003";  # Notese que si intento accder/modificar esta variable que es PROTEGIDA el codigo lanzara error.
								 # Por ese motivo son utiles los metodos getter y setter.

echo $banana->devolver_datos();	# EL OBJETO LLAMA A UN METODO PROPIO.
echo $naranja->devolver_datos();

// OBJETO instanceof CLASS -> Retorna 'true' en caso de que el objeto sea una instancia de la clase indicade, 'false' en caso contrario.

echo ($banana instanceof Fruta? "Banana es una instancia de Fruta" : "Banana no es una instancia de Fruta") . "<br>";


// HERENCIA DE CLASES.

/**
 * Clase FrutaTropical
 */
final class FrutaTropical extends Fruta { # Clase heredada (hija) de la clase padre.
	public $pais;
	const PADRE = "Fruta"; # Constante. No puede modificarse.

	function __construct($nombre, $color, $codigo, $pais)
	{
		//$this->nombre = $nombre;
		//$this->color = $color;
		//$this->codigo = $codigo; # Notese que si el atributo era privado, no puedo acceder a el y queda nulo, no lanza error.
		parent::__construct($nombre, $color, $codigo); # Llamo al metodo constructor de la clase padre.
		$this->pais = $pais;
	}

	function set_pais($value) {
		$this->pais = strtoupper($value);
	}

	function devolver_datos() { // SOBREESCRIBO EL METODO DE LA CLASE PADRE.
		//$datos = "<b><i>Nombre</i></b>: $this->nombre<br><b><i>Color</i></b>: $this->color<br><b><i>Codigo</i></b>: $this->codigo<br>";
		//$datos .= "<b><i>Pais</i></b>: $this->pais<br>";

		return parent::devolver_datos() . "<b><i>Pais</i></b>: $this->pais<br>Hereda de <b><i>" . self::PADRE . "</i></b><br>";
	}

	function devolver_codigo_completo() {
		return parent::devolver_codigo_completo() . "-" . strtoupper(substr($this->pais, 0, 3));
	}
}

$mango = new FrutaTropical("Mango", "Amarrillo", "004", "ECUADOR");
$mango->set_pais("COLOMBIA");

//echo $mango->devolver_datos(); # Llamo al metodo de clase 'Fruta', no al de la clase 'FrutaTropical'.
echo $mango->devolver_datos(); # Una vez sobreeescrito, cada vez que un objeto de la clase heredada llame a este metodo, la funcion que 
							   # se ejecutara sera la propia a su clase.

// Si una clase se indica como 'final', esta no podra heredar.
// Asi mismo, un metodo indicado como 'final' no puede sobreescribirse.

// class FrutaTropicalDelCaribe extends FrutaTropical { # ERROR FATAL.

// LLamada a constantes

// $objeto::CONSTANTE -> LLAMADA DESDE UN OBJETO INSTANCIADO.
// CLASE::CONSTANTE -> LLAMADA DESDE LA CLASE.
// self::CONSTANTE -> LLAMADA DENTRO DE LA CLASE.  

echo "El padre de la clase " . get_class($mango) . " es " . $mango::PADRE . "<br>";
echo "El padre de la clase " . get_class($mango) . " es " . FrutaTropical::PADRE . "<br>";