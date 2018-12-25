<?php
/**Controlador para las vistas de Fase y el modelo de la Fase
 * autor:  Juan Márquez 
 * 18-12-2018
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



     //método muestra pantalla de confirmación de borrado 
     //$clave: PK de la tupla
     function DELETE($clavet, $clavef){
        include '../Models/FASE_Model.php';
        $fase = new FASE_Model($clavet, $clavef,'','', '');
        if(!isset($_POST['submit']))
        {
            $datos = $fase->SEARCH();
            include '../Views/Fase_Views/Fase_DELETE.php';
            new Fase_DELETE($datos);
        }else{
            $respuesta = $fase->DELETE();
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, "./Tarea_Controller.php?accion=SHOWCURRENT&param=$clavet");

        }
    }

    //método muestra pantalla de edición y edita en caso de submit
     //$clave: PK de la tupla
     function EDIT($clavet, $clavef){
        if(!isset($_POST['submit']))
        {
            include '../Models/FASE_MODEL.php';
            $fase = new FASE_MODEL($clavet,$clavef,'','','');
            $result = $fase->SEARCH();
            include '../Views/Fase_Views/Fase_EDIT.php';
            new Fase_EDIT($clavet, $clavef, $result);

        }else{
            include '../Models/FASE_MODEL.php';
            $fase = new FASE_MODEL($clavet,$clavef,'','',$_POST['desc']);
            $respuesta = $fase->Edit();
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, "./Tarea_Controller.php?accion=SHOWCURRENT&param=$clavet");
         
        }
    }

     //método muestra la información de una tupla 
     //$clave: PK de la tupla
     function SHOWCURRENT($clavet, $clavef){
            include '../Models/FASE_Model.php';
            $Tarea = new FASE_Model($clavet, $clavef,'','','');
            $contactos = $Tarea->getCont();
            $archivos = $Tarea->getArch();
            $datos = $Tarea->SEARCH();
            include '../Views/Fase_Views/Fase_SHOWCURRENT.php';
            new Fase_SHOWCURRENT($datos, $contactos, $archivos);
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
    function CLOSE($clavet, $clavef){
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
