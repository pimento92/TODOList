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
		
	include '../Models/USUARIOS_Model.php';
	$usuario = new USUARIOS_Model($_POST['log'],$_POST['password'],$_POST['DNI'],
	$_POST['nombre'],$_POST['apellidos'],$_POST['telefono'],$_POST['email'],
	$_POST['fecha'],$_FILES['file']['name'],$_POST['sexo']);
	
	$respuesta = $usuario->Register();
	if ($respuesta == 'true'){
		$respuesta = $usuario->registrar();
		if(isset($_FILES['file']))
                    {
                        $name_file = $_FILES['file']['name'];
                        $tmp_name = $_FILES['file']['tmp_name'];
                        $local_image = "../Files/ProfilePics/";
                        move_uploaded_file($tmp_name, $local_image.$name_file);
					}
		
		Include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}
	else{
		include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Registro_Controller.php');
	}

}

?>

