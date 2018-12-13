<?php
/**Controlador para las vistas de la prioridad y el modelo de la prioridad
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
            include '../Views/Prioridad_Views/Prioridad_ADD.php';
            new Prioridad_ADD();

        }else{
            include '../Models/PRIORIDAD_Model.php';
            $prioridad = new PRIORIDAD_Model('',$_POST['nombre'],$_POST['color'],$_POST['desc']);

            $respuesta = $prioridad->Exists();
            if($respuesta === true)
            {
                $prioridad->ADD();
                $respuesta = 'Inserción realizada con éxito';
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Prioridad_Controller.php?accion=ADD');

            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Prioridad_Controller.php?accion=ADD');
            }
        }
    }


    //método que llama a la función SEARCH del modelo
    function SEARCH(){
        if(!isset($_POST['submit']))
        {
            include '../Views//Prioridad_Views/Prioridad_SEARCH.php';
            new Prioridad_SEARCH();

        }else{
            include '../Models/PRIORIDAD_Model.php';
            $boleto = new PRIORIDAD_Model('',$_POST['nombre'],'',$_POST['desc']);
            $datos = $boleto->SEARCH();
            if(is_array($datos) === true){
                include '../Views/Prioridad_Views/Prioridad_SHOWALL.php';
                new Prioridad_SHOWALL($datos);
            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($datos, './Prioridad_Controller.php?accion=SEARCH');
            }
        }
    }

     //método muestra pantalla de confirmación de borrado 
     //$clave: PK de la tupla
     function DELETE($clave){
        include '../Models/PRIORIDAD_Model.php';
        $prioridad = new Prioridad_Model($clave,'','','');
        if(!isset($_POST['submit']))
        {
            $datos = $prioridad->SEARCH();
            include '../Views/Prioridad_Views/Prioridad_DELETE.php';
            new Prioridad_DELETE($datos);
        }else{
            $respuesta = $prioridad->DELETE($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Prioridad_Controller.php?accion=SHOWALL');

        }
    }

    //método muestra pantalla de edición y edita en caso de submit
     //$clave: PK de la tupla
     function EDIT($clave){
        if(!isset($_POST['submit']))
        {
            include '../Models/PRIORIDAD_Model.php';
            $prioridad = new PRIORIDAD_Model($clave, '','','');
            $datos = $prioridad->SEARCH();
            include '../Views/Prioridad_Views/Prioridad_EDIT.php';
            new Prioridad_EDIT($datos);

        }else{
            include '../Models/PRIORIDAD_Model.php';
            $boleto = new PRIORIDAD_Model($_POST['id'],$_POST['nombre'],$_POST['color'],$_POST['desc']);

            $respuesta = $boleto->EDIT($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Prioridad_Controller.php?accion=SHOWALL');
         
        }
    }

     //método muestra la información de una tupla 
     //$clave: PK de la tupla
     function SHOWCURRENT($clave){
            include '../Models/PRIORIDAD_Model.php';
            $prioridad = new PRIORIDAD_Model($clave,'','','');
            $datos = $prioridad->SEARCH();
            include '../Views/Prioridad_Views/Prioridad_SHOWCURRENT.php';
            new Prioridad_SHOWCURRENT($datos);
    }

    //método que muestra todos los boletos
    function SHOWALL(){
        
            include '../Models/PRIORIDAD_Model.php';
            $prioridad = new PRIORIDAD_Model('','','','');
            $datos = $prioridad->Showall();
            if(sizeof($datos) != 0)
            {
                include '../Views/Prioridad_Views/Prioridad_SHOWALL.php';
                new  Prioridad_SHOWALL($datos);
            }else{
                $mens = "No hay prioridades registradas";
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
