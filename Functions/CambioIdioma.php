<?php
/** funciñon para el cambio de idioma
 *  autor:  t45qxz 
*12/11/2018
 */
session_start();
$idioma = $_POST['idioma'];
$_SESSION['idioma'] = $idioma;
header('Location:' . $_SERVER["HTTP_REFERER"]);
?>