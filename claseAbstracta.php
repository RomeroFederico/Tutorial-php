<?php
namespace VEHICULO; # Los 'namespace' deben declarase antes de cualquier impresion.

// Los 'namespace' permiten agrupar clases, funciones y variables que esten relacionadas.
// Esto evita que dos clases/funciones/variables con el mismo nombre pero distinta funcionalidad no puedan coexistir en el codigo.
// Al declarase un namespace (namespace NOMBRE), todos las clases/funciones/variables declaradas en el archivo perteneceran a este tipo.

// ------------------------------------------------------------

// Clases abstractas

// Define metodos pero no los implementa (lo que hace), sino que sus hijos deben implementarlos.
// Una clase absracta debe contener al menos un metodo de este tipo.

abstract class Vehiculo {

	protected $patente;

	public function __construct($patente, $color) {
		$this->patente = $patente;
		$this->color = $color;
	}

	abstract protected function set_patente($value); # Definicion de un metodo abstracto.

	abstract public function get_patente(); # Las clases hijas deben tener metodo con el mismo nombre y las mismas o menos restricciones.

	abstract protected function set_color($value); # Es decir, si es protegida, los metodos sobreescritos deben ser o protegidos o publicos.

	abstract public function get_color(); # Acerca de los argumentos, deben tener los mismos tipos y numeros, pero pueden tener mas argumetosopcionales.

	abstract protected function get_type(); # Los metodos no pueden ser privados.

	abstract public function retornar_datos();
}

class Auto extends Vehiculo {

	public $ruedas; # Una clase heredada de una clase abstracta puede tener mas atruibutos y metodos.
	public static $medio = "Tierra"; # Atributo estatico.

	public function __construct($patente, $color) {
		parent::__construct($patente, $color);
		$this->ruedas = 4;
	}

	public function set_patente($value) {
		$this->patente = $value;
	}

	public function get_patente() {
		return $this->patente;
	}

	public function set_color($value) {
		$this->color = $value;
	}

	public function get_color() {
		return $this->color;
	}

	protected function get_type() {
		return get_class($this);
	} 

	public function retornar_datos() {
		return "<b><i>" . $this->get_type() . "</i></b>" . " - Medio: " . self::$medio . "<br><b><i>Patente</i></b>: $this->patente<br><b><i>Color</i></b>: $this->color<br><b><i>Ruedas</i></b>: $this->ruedas<br>";
	} # El acceso al atributo estatico se realiza con 'self::$atributo'.

	// Metodo estatico.
	// Puede ser invocado sin la necesidad de instanciar un nuevo objeto.
	public static function crearAuto($patente, $color) {
		return new Auto($patente, $color);
	}

	public static function soy_un_metodo_estatico() {
		echo "Hola soy un metodo estatico de la clase Auto<br>";
	}

	public function clonar($patente) {
		return self::crearAuto($patente, $this->color); # Para llamar a un metodo estatico dentro de un objeto se utiliza la palabra clave 'self'.
	}
}

class Avion extends Vehiculo {

	protected $pasajeros;

	use Vuelo, Limpieza; # Implementacion de un trait con la palabra clave 'use'.
	//use Limpieza; # Se pueden implementar multiples traits.

	public function __construct($patente, $color, $pasajeros) {
		parent::__construct($patente, $color);
		$this->pasajeros = $pasajeros;
	}

	public function set_patente($value, $pais = "") { # Si se agrega mas parametros, deben ser OPCIONALES.
		$this->patente = $value . "-" . strtoupper(substr($pais, 0, 3));
	}

	public function get_patente() {
		return $this->patente;
	}

	public function set_color($value) {
		$this->color = $value;
	}

	public function get_color() {
		return $this->color;
	}

	protected function get_type() {
		return get_class($this);
	}

	public function set_pasajeros($value) {
		$this->pasajeros = $value;
	}

	public function get_pasajeros() {
		return $this->pasajeros;
	}

	public function retornar_datos() {
		return "<b><i>" . $this->get_type() . "</i></b><br><b><i>Patente</i></b>: $this->patente<br><b><i>Color</i></b>: $this->color<br><b><i>Pasajeros</i></b>: $this->pasajeros<br>";
	}

	public function despegar() { # Notese que si se sobreescribe un metodo (no abstract) de un trait, no se puede llamar al metodo original con parent!
		if (empty($this->piloto))
			echo "No se ha asignado un piloto al vuelo!!!<br>";
		else
			echo "El avion ha despegado.<br>";
	}

	public function asignarPiloto($piloto) {
		$this->piloto = $piloto;
		echo "El piloto " .  $this->piloto . " ha sido asignado.<br>";
	}
}

// ------------------------------------------------------------

// Interfaces

// Define metodos pero no los implementa (lo que hace), sino que sus hijos deben implementarlos.
// Son similiares a las clases abstractas, pero difieren en:
// - Las interfaces no pueden tener atributos.
// - Los metodos deben ser publicos.
// - Todos sus metodos deben ser abstractos, y no requiere la palabra clave 'abstract'.
// - Una clase puede implementar una o mas interfaces, pero solo una clase abstracta a la vez.

interface VehiculoDeportivo { # Declarada con la palabra clave 'interface'.
	public function acelerar();
	public function frenar();
}

class Ferrari extends Auto implements VehiculoDeportivo { # Implementada con la palabra clave 'implements'.
	protected $piloto;

	public function __construct($patente, $color, $piloto) {
		parent::__construct($patente, $color);
		$this->piloto = $piloto;
	}

	public function acelerar() {
		echo "El vehiculo " . $this->get_escuderia() . ", " . $this->get_patente() . " ha acelerado<br>";
	}

	public function frenar() {
		echo "El vehiculo " . $this->get_escuderia() . ", " . $this->get_patente() . " ha frenado<br>";
	}

	protected function get_escuderia() {
		return get_class($this);
	}

	public function retornar_datos() {
		$string = parent::retornar_datos();
		$string .= "<b><i>Escuderia</i></b>: " . $this->get_escuderia() . "<br><b><i>Piloto</i></b>: $this->piloto<br>";
		return $string;
	}

	public function utilizar_metodo_estatico_del_padre() {
		parent::soy_un_metodo_estatico(); # Para que un hijo pueda utilizar un metodo estatico del padre se utiliza la palabra clave 'parent'.
	}
}

// Rasgos (traits)

// Como en PHP una clase hija solo puede heredar de un padre, los traits solucionan esto.
// Los traits son usados para declarar metodos que pueden ser usados por multiples clases. Pueden contener metodos y metodos abstractos,
// y estos pueden contener cualquier modificador de acceso.
// Ademas pueden tener atributos.
// En definitiva, permite reducir el codigo ya que basicamente PHP lo interpretara como un copiar y pegar.

trait Vuelo { # Se definen con la palabra clave 'trait'.

	protected $piloto;

	public function despegar() {
		echo "El avion ha despegado.<br>";
	}

	public function aterrizar() {
		echo "El avion ha aterrizado.<br>";
	}

	abstract function asignarPiloto($piloto);
}

trait Limpieza {
	public function limpiar() {
		echo "El vehiculo se ha limpiado!<br>";
	}
}

/*
//$mi_auto = new Auto("ABC 132", "Naranja");
$mi_auto = Auto::crearAuto("ABC 132", "Naranja"); # Llamado a un metodo estatico.
$mi_auto_clonado = $mi_auto->clonar("ABC 456");
$mi_avion = new Avion("BC 123 A1", "Blanco", 100);
$mi_ferrari = new Ferrari("ZXI 158", "Roja", "Federico");

$mi_avion->set_patente("BC 123 A1", "Alemania");

$mis_vehiculos = [$mi_auto, $mi_auto_clonado, $mi_avion, $mi_ferrari];

foreach ($mis_vehiculos as $vehiculo) {
	echo $vehiculo->retornar_datos() . "<br>";
}

$mi_ferrari->acelerar();
$mi_ferrari->frenar();

$mi_avion->asignarPiloto("Fede");
$mi_avion->despegar();
$mi_avion->aterrizar();
$mi_avion->limpiar();

$mi_ferrari->utilizar_metodo_estatico_del_padre();

echo "<br>Auto es un medio de " . Auto::$medio . "<br>";
*/