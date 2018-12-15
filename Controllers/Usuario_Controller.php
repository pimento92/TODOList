<?php
/**Controlador para las vistas del USUARIO y el modelo de la USUARIO
 * autor:  Juan Márquez 
 * 13-12-2018
 */
session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';
include '../Functions/Authentication.php';
//si no esta autenticado
if (!IsAuthenticated()){
	header('Location: ../index.php');
}
//esta autenticado
else{
    //Conectamos a la BBDD
    include '../Models/Access_DB.php';

    //variable para el método
    if(isset($_GET["accion"])){
        $accion = $_GET["accion"];
    }
    //variable para el parámetro
    if(isset($_GET["param"])){
        $param = $_GET["param"];
    }

    //función que llama a la función add del modelo
    function ADD(){
        if(!isset($_POST['submit']))
        {
            include '../Views/Usuario_Views/Usuario_ADD.php';
            new Usuario_ADD();

        }else{
            include '../Models/USUARIO_Model.php';
            $Usuario = new USUARIO_Model($_POST['nombre'],$_POST['apellidos'],$_POST['telf'],$_POST['email'],$_POST['password'],$_POST['fecha'],$_POST['tipo']);

            $respuesta = $Usuario->Register();
            if($respuesta === true)
            {
                $respuesta = $Usuario->ADD();
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Usuario_Controller.php?accion=SHOWALL');

            }
        }
    }


    //método que llama a la función SEARCH del modelo
    function SEARCH(){
        if(!isset($_POST['submit']))
        {
            include '../Views/Usuario_Views/Usuario_SEARCH.php';
            new Usuario_SEARCH();

        }else{
            include '../Models/USUARIO_Model.php';
            $Usuario = new USUARIO_Model($_POST['nombre'],$_POST['apellidos'],$_POST['telefono'],$_POST['email'],'',$_POST['fecha'],$_POST['tipo']);
            $datos = $Usuario->SEARCH();
            if(is_array($datos) === true){
                include '../Views/Usuario_Views/USUARIO_SHOWALL.php';
                new Usuario_SHOWALL($datos);
            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($datos, './Usuario_Controller.php?accion=SEARCH');
            }
        }
    }

     //método muestra pantalla de confirmación de borrado 
     //$clave: PK de la tupla
     function DELETE($clave){
        include '../Models/USUARIO_Model.php';
        $Usuario = new USUARIO_Model('', '', '', $clave, '','', '');
        if(!isset($_POST['submit']))
        {
            $datos = $Usuario->SEARCH();
            include '../Views/Usuario_Views/Usuario_DELETE.php';
            new Usuario_DELETE($datos);
        }else{
            $respuesta = $Usuario->DELETE($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Usuario_Controller.php?accion=SHOWALL');

        }
    }

    //método muestra pantalla de edición y edita en caso de submit
     //$clave: PK de la tupla
     function EDIT($clave){
        if(!isset($_POST['submit']))
        {
            include '../Models/USUARIO_Model.php';
            $Usuario = new USUARIO_Model('', '', '', $clave, '','', '');
            $datos = $Usuario->SEARCH();
            include '../Views/Usuario_Views/Usuario_EDIT.php';
            new Usuario_EDIT($datos);

        }else{
            include '../Models/USUARIO_Model.php';
            $Usuario = new USUARIO_Model($_POST['nombre'],$_POST['apellidos'],$_POST['telf'],$clave,$_POST['password'],$_POST['fecha'],$_POST['tipo']);
            $respuesta = $Usuario->Edit($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Usuario_Controller.php?accion=SHOWALL');
         
        }
    }

     //método muestra la información de una tupla 
     //$clave: PK de la tupla
     function SHOWCURRENT($clave){
            include '../Models/USUARIO_Model.php';
            $Usuario = new USUARIO_Model('','','', $clave,'','','');
            $datos = $Usuario->SEARCH();
            include '../Views/Usuario_Views/Usuario_SHOWCURRENT.php';
            new Usuario_SHOWCURRENT($datos);
    }

    //método que muestra todos los boletos
    function SHOWALL(){
        
            include '../Models/USUARIO_Model.php';
            $Usuario = new USUARIO_Model('','','','','','','');
            $datos = $Usuario->Showall();
            if(sizeof($datos) != 0)
            {
                include '../Views/Usuario_Views/Usuario_SHOWALL.php';
                new  USUARIO_SHOWALL($datos);
            }else{
                $mens = "No hay usuarios registrados";
                include '../Views/MESSAGE.php';
                new MESSAGE($mens, '../Controllers/Index_Controller.php');
            }
            
        
    }
    //ejecutamos el método correspondiente
    if(!isset($param))
    {
        $accion();
    }else{
        $accion($param);
    }
}
