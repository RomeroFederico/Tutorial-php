<?php
//namespace VEHICULO;
include "claseAbstracta.php";
use VEHICULO as V;
use VEHICULO\FERRARI as F;

// ------------------------------------------------------------

// Namespace

// Los 'namespace' permiten agrupar clases, funciones y variables que esten relacionadas.
// Esto evita que dos clases/funciones/variables con el mismo nombre pero distinta funcionalidad no puedan coexistir en el codigo.
// Al declarase un namespace (namespace NOMBRE), todos las clases/funciones/variables declaradas en el archivo perteneceran a este tipo.

// Dentro del archivo, no se necesita especificar el namespace al utilizar cualuquier elemento perteneciente al mismo.
// En cambio, si se requiere utilizar algunos de estos elementos en otro archivo, se debe utilizar el namespace antes del nombre del elemento a 
// utilizar.
// include "claseAbstracta.php";
// $auto = new VEHICULO\Ferrari(...);  

// Si en el archivo que requiere el namespace se incluye este al inicio con 'namespace X', no se necesita utlizar 'namespace\' antes de los elementos.
// namespace VEHICULO;
// include "claseAbstracta.php";
// $auto = new Ferrari(...); 

// Puede utilizarse un alias con los namespaces incluidos.
// include "claseAbstracta.php";
// use VEHICULO as V
// $auto = new V\Ferrari(...);

// Tambien con las clases/metodos/variables se pueden utilizar los alias..
// include "claseAbstracta.php";
// use VEHICULO\FERRARI as F
// $auto = new F(...);

// EJEMPLO SIN ALIAS NI NAMESPACE:
/*
$mi_auto = VEHICULO\Auto::crearAuto("ABC 132", "Naranja");
$mi_auto_clonado = $mi_auto->clonar("ABC 456");
$mi_avion = new VEHICULO\Avion("BC 123 A1", "Blanco", 100);
$mi_ferrari = new VEHICULO\Ferrari("ZXI 158", "Roja", "Federico");

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

echo "<br>Auto es un medio de " . VEHICULO\Auto::$medio . "<br>";
*/

// EJEMPLO CON NAMESPACE:
/*
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

// EJEMPLO CON ALIAS:

$mi_auto = V\Auto::crearAuto("ABC 132", "Naranja");
$mi_auto_clonado = $mi_auto->clonar("ABC 456");
$mi_avion = new V\Avion("BC 123 A1", "Blanco", 100);
$mi_ferrari = new F("ZXI 158", "Roja", "Federico");

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

echo "<br>Auto es un medio de " . V\Auto::$medio . "<br>";