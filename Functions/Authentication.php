<?php
/*
function IsAuthenticated()
 autor:  t45qxz 
12/11/2018
Esta función valida si existe la variable de session login
Si no existe redirige a la pagina de login
Si existe comprueba si el usuario tiene permisos para ejecutar la accion de ese controlador
*/
function IsAuthenticated(){
	if (!isset($_SESSION['login'])){
		//header('Location:USUARIOS_Controller.php?accion=Login');	
		return false;
	}
	else{
		/*if (!HavePermissions($controller, $_REQUEST['accion']))
			new Mensaje('No tiene permisos para ejecutar esta acción','index.php');	
		*/
		//header('Location:USUARIOS_Controller.php');
		return true;
	}
} //end of function IsAuthenticated()
?>

