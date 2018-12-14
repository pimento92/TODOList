<?php
/**Controlador para las vistas del contacto y el modelo de la Contacto
 * autor:  Juan Márquez 
 * 12-12-2018
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
            include '../Views/Contacto_Views/Contacto_ADD.php';
            new Contacto_ADD();

        }else{
            include '../Models/CONTACTO_Model.php';
            $Contacto = new CONTACTO_Model($_POST['email'],$_POST['nombre'],$_POST['desc'], $_POST['telf']);

            $respuesta = $Contacto->Exists();
            if($respuesta === true)
            {
                $Contacto->ADD();
                $respuesta = 'Inserción realizada con éxito';
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Contacto_Controller.php?accion=ADD');

            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Contacto_Controller.php?accion=ADD');
            }
        }
    }


    //método que llama a la función SEARCH del modelo
    function SEARCH(){
        if(!isset($_POST['submit']))
        {
            include '../Views//Contacto_Views/Contacto_SEARCH.php';
            new Contacto_SEARCH();

        }else{
            include '../Models/CONTACTO_Model.php';
            $Contacto = new CONTACTO_Model($_POST['email'],$_POST['nombre'],$_POST['desc'], $_POST['telf']);
            $datos = $Contacto->SEARCH();
            if(is_array($datos) === true){
                include '../Views/Contacto_Views/Contacto_SHOWALL.php';
                new Contacto_SHOWALL($datos);
            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($datos, './Contacto_Controller.php?accion=SEARCH');
            }
        }
    }

     //método muestra pantalla de confirmación de borrado 
     //$clave: PK de la tupla
     function DELETE($clave){
        include '../Models/CONTACTO_Model.php';
        $Contacto = new CONTACTO_Model($clave,'','','');
        if(!isset($_POST['submit']))
        {
            $datos = $Contacto->SEARCH();
            include '../Views/Contacto_Views/Contacto_DELETE.php';
            new Contacto_DELETE($datos);
        }else{
            $respuesta = $Contacto->DELETE($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Contacto_Controller.php?accion=SHOWALL');

        }
    }

    //método muestra pantalla de edición y edita en caso de submit
     //$clave: PK de la tupla
     function EDIT($clave){
        if(!isset($_POST['submit']))
        {
            include '../Models/CONTACTO_Model.php';
            $Contacto = new CONTACTO_Model($clave, '','', '');
            $datos = $Contacto->SEARCH();
            include '../Views/Contacto_Views/Contacto_EDIT.php';
            new Contacto_EDIT($datos);

        }else{
            include '../Models/CONTACTO_Model.php';
            $Contacto = new CONTACTO_Model($_POST['email'],$_POST['nombre'],$_POST['desc'], $_POST['telf']);
            $respuesta = $Contacto->Edit($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Contacto_Controller.php?accion=SHOWALL');
         
        }
    }

     //método muestra la información de una tupla 
     //$clave: PK de la tupla
     function SHOWCURRENT($clave){
            include '../Models/CONTACTO_Model.php';
            $Contacto = new CONTACTO_Model($clave,'','', '');
            $datos = $Contacto->SEARCH();
            include '../Views/Contacto_Views/Contacto_SHOWCURRENT.php';
            new Contacto_SHOWCURRENT($datos);
    }

    //método que muestra todos los boletos
    function SHOWALL(){
        
            include '../Models/CONTACTO_Model.php';
            $Contacto = new CONTACTO_Model('','','', '');
            $datos = $Contacto->Showall();
            if(sizeof($datos) != 0)
            {
                include '../Views/Contacto_Views/Contacto_SHOWALL.php';
                new  Contacto_SHOWALL($datos);
            }else{
                $mens = "No hay Contactos registrados";
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
