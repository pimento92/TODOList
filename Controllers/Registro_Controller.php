<?php
/**Controlador para el REGISTRO
 * autor:  t45qxz
 * 12-11-2018
 */
session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';

//session_start();
if(!isset($_POST['action'])){
	include '../Views/REGISTRO_View.php';
	$register = new REGISTRO();
}
else{

	include '../Models/USUARIO_Model.php';
	$usuario = new USUARIO_Model($_POST['nombre'],$_POST['apellidos'],$_POST['telefono'],$_POST['email'],
	$_POST['password'],$_POST['fecha'],$_POST['tipo']);

	$respuesta = $usuario->Register();
	if ($respuesta == 'true'){
		$respuesta = $usuario->registrar();

		Include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}
	else{
		include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Registro_Controller.php');
	}

}

?>
