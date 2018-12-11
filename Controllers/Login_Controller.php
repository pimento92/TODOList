<?php
/**Controlador para el LOGIN
 * autor:  t45qxz 
 * 12-11-2018
 */
session_start();

if(!isset($_REQUEST['login']) && !(isset($_REQUEST['password']))){
	include '../Views/LOGIN_View.php';
	$login = new Login();
}
else{

	include '../Models/Access_DB.php';

	include '../Models/USUARIOS_Model.php';
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','','','','');
	$respuesta = $usuario->login();

	if ($respuesta == 'true'){
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];
		header('Location:../index.php');
	}
	else{
		include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}

}

?>

