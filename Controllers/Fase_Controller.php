<?php
/**Controlador para las vistas del Tarea y el modelo de la Tarea
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
        //variable para el parámetro
        if(isset($_GET["param2"])){
            $param2 = $_GET["param2"];
        }
    //función que llama a la función add del modelo
    function ADD($clave){
        if(!isset($_POST['submit']))
        {
            include '../Models/CONTACTO_MODEL.php';
            $contactos = new CONTACTO_MODEL('','','','');
            $datosc = $contactos->Showall();


            include '../Views/Fase_Views/Fase_ADD.php';
            new Fase_ADD($clave, $datosc);

        }else{
            include '../Models/FASE_Model.php';
            $Tarea = new FASE_Model($clave,'',$_POST['fecha'],$_POST['estado'],$_POST['desc']);
            $result = $Tarea->ADD();
            include '../Views/MESSAGE.php';
            new MESSAGE($result, "../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=$clave");

        }
    }


    //método que llama a la función SEARCH del modelo
    function SEARCH(){
        if(!isset($_POST['submit']))
        {
            include '../Models/FASE_MODEL.php';
            $pri = new FASE_Model('','','','');
            $FASEes = $pri->SHOWALL();
            include '../Models/CATEGORIA_MODEL.php';
            $cat = new CATEGORIA_MODEL('','', '');
            $categorias = $cat->SHOWALL();
            include '../Views/Tarea_Views/Tarea_SEARCH.php';
            new Tarea_SEARCH($FASEes, $categorias);

        }else{
            include '../Models/TAREA_Model.php';
            $Tarea = new TAREA_Model($_POST['pri'],'',$_POST['fecha'],$_POST['estado'],$_POST['desc'],$_POST['email'],$_POST['cat']);
            $datos = $Tarea->SEARCH();
            if(is_array($datos) === true){
                include '../Views/Tarea_Views/Tarea_SHOWALL.php';
                new Tarea_SHOWALL($datos);
            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($datos, './Tarea_Controller.php?accion=SEARCH');
            }
        }
    }

     //método muestra pantalla de confirmación de borrado 
     //$clave: PK de la tupla
     function DELETE($clave){
        include '../Models/TAREA_Model.php';
        $Tarea = new TAREA_Model('', $clave,'','', '','', '');
        if(!isset($_POST['submit']))
        {
            $datos = $Tarea->SEARCH();
            include '../Views/Tarea_Views/Tarea_DELETE.php';
            new Tarea_DELETE($datos);
        }else{
            $respuesta = $Tarea->DELETE($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Tarea_Controller.php?accion=SHOWALL');

        }
    }

    //método muestra pantalla de edición y edita en caso de submit
     //$clave: PK de la tupla
     function EDIT($clave){
        if(!isset($_POST['submit']))
        {
            include '../Models/FASE_MODEL.php';
            $pri = new FASE_MODEL('','','','');
            $FASEes = $pri->SHOWALL();
            include '../Models/CATEGORIA_MODEL.php';
            $cat = new CATEGORIA_MODEL('','', '');
            $categorias = $cat->SHOWALL();
            include '../Models/TAREA_Model.php';
            $Tarea = new TAREA_Model('',  $clave, '','','','', '');
            $datos = $Tarea->SEARCH();
            include '../Views/Tarea_Views/Tarea_EDIT.php';
            new Tarea_EDIT($datos, $FASEes, $categorias);

        }else{
            include '../Models/TAREA_Model.php';
            $Tarea = new TAREA_Model($_POST['pri'],$clave,'',$_POST['estado'],$_POST['desc'],'',$_POST['cat']);
            $respuesta = $Tarea->Edit($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Tarea_Controller.php?accion=SHOWALL');
         
        }
    }

     //método muestra la información de una tupla 
     //$clave: PK de la tupla
     function SHOWCURRENT($clave){
            include '../Models/TAREA_Model.php';
            $Tarea = new TAREA_Model('', $clave,'','','','','');
            $datos = $Tarea->SEARCH();
            include '../Views/Tarea_Views/Tarea_SHOWCURRENT.php';
            new Tarea_SHOWCURRENT($datos);
    }

    //método que muestra todos los boletos
    function SHOWALL($clave){
        
            include '../Models/FASE_MODEL.php';
            $Tarea = new FASE_Model($clave,'','','','');
            $datos = $Tarea->Showall();
            if(sizeof($datos) != 0)
            {
                include '../Views/Fase_Views/Fase_SHOWALL.php';
                new  Fase_SHOWALL($datos);
            }else{
                $mens = "No hay fases registradas";
                include '../Views/MESSAGE.php';
                new MESSAGE($mens, '../Controllers/Index_Controller.php');
            }
            
        }
    //método que cierra una fase
    function CLOSE($clavef, $clavet){
            include '../Models/FASE_Model.php';
            $Fase = new FASE_Model($clavet,$clavef,'','','');
            $result = $Fase->Close();
            include '../Views/MESSAGE.php';
            new MESSAGE ($result, "../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=$clavet");

    }
    //ejecutamos el método correspondiente
    if(!isset($param))
    {
        $accion();
    }else{
        if(!isset($param2)){
        $accion($param);
        }else{
            $accion($param, $param2);
        }
    }
}
