<?php
/**función para el logout
 *  autor:  t45qxz 
*12/11/2018
 */
session_start();
session_destroy();
header('Location:../index.php');

?>
