<?php
/**Controlador para las vistas de la POSEE y el modelo de la POSEE
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
    //variable para el parámetro
    if(isset($_GET["param2"])){
        $param2 = $_GET["param2"];
    }

    //función que llama a la función add del modelo
    function ADD($clavet, $clavef){
        if(!isset($_POST['submit']))
        {
            
            include '../Models/CONTACTO_MODEL.php';
            $contactos = new CONTACTO_MODEL('','','','');
            $datosc = $contactos->Showall();
            include '../Models/POSEE_Model.php';
            include '../Views/POSEE_Views/POSEE_ADD.php';
            new POSEE_ADD($clavef, $clavet, $datosc);

        }else{
            include '../Models/POSEE_Model.php';
            $POSEE = new POSEE_Model($clavef,$_POST['con']);
            
            $respuesta = $POSEE->Exists();
            if($respuesta === true)
            {
                $POSEE->ADD();
                $respuesta = 'Inserción realizada con éxito';
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, "./Tarea_Controller.php?accion=SHOWCURRENT&param=$clavet");

            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './POSEE_Controller.php?accion=SHOWALL');
            }
        }
    }



     //método muestra pantalla de confirmación de borrado 
     //$clave: PK de la tupla
     function DELETE($clave){
        include '../Models/POSEE_Model.php';
        $POSEE = new POSEE_Model($clave,'','','');
        if(!isset($_POST['submit']))
        {
            $datos = $POSEE->SEARCH();
            include '../Views/POSEE_Views/POSEE_DELETE.php';
            new POSEE_DELETE($datos);
        }else{
            $respuesta = $POSEE->DELETE($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './POSEE_Controller.php?accion=SHOWALL');

        }
    }

    //método que muestra todos los boletos
    function SHOWALL($clavet, $clavef){
        
            include '../Models/POSEE_Model.php';
            $POSEE = new POSEE_Model('',$clavef);
            $datos = $POSEE->Showall();
            if(sizeof($datos) != 0)
            {
                include '../Views/POSEE_Views/Posee_SHOWALL.php';
                new  Posee_SHOWALL($datos, $clavet, $clavef);
            }else{
                $mens = "No hay contactos registrados";
                include '../Views/MESSAGE.php';
                new MESSAGE($mens, '../Controllers/Index_Controller.php');
            }
            
        
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
