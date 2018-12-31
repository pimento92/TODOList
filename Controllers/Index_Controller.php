<?php
/**Controlador para el index
 * autor:  t45qxz 
 * 12-11-2018
 */
//session
session_start();
//incluir funcion autenticacion
include '../Functions/Authentication.php';
//si no esta autenticado
if (!IsAuthenticated()){
	header('Location: ../index.php');
}
//esta autenticado
else{
	header ("Location: ../Controllers/Tarea_Controller.php?accion=SHOWALL&param=fecha");
}

?>