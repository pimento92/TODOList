<?php
/**
 * Clase para mostrar la página índice
 *	autor:  t45qxz 
 *	12/11/2018 
 */
class Index {

	function __construct(){
		$this->render();
	}

	function render(){
	
		include '../Locales/Strings_SPANISH.php';
		include '../Views/Header.php';
		include '../Views/Intro_View.php';
		include '../Views/Footer.php';
	}

}

?>