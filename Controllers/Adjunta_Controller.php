<?php
/**Controlador para las vistas de la tabla adjunta y el modelo de la ADJUNTA
 * autor:  Juan Márquez 
 * 17-12-2018
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
    //variable para el parámetro
    if(isset($_GET["param3"])){
        $param3 = $_GET["param3"];
    }
    //función que llama a la función add del modelo
    function ADD($clavet, $clavef){
        if(!isset($_POST['submit']))
        {
            
            include '../Models/ADJUNTA_Model.php';
            $archivos = new ADJUNTA_Model($clavet,$clavef,'');
            $datosc = $archivos->Showall();
            include '../Views/Adjunta_Views/Adjunta_ADD.php';
            new Adjunta_ADD($clavef, $clavet, $datosc);

        }else{
            include '../Models/ADJUNTA_Model.php';
            $ADJUNTA = new ADJUNTA_Model($clavet, $clavef,'');
            
            $respuesta = $ADJUNTA->Exists();
            if($respuesta === true)
            {
                if(isset($_FILES['file']))
                    {
                        $name_file = $_FILES['file']['name'];
                        $tmp_name = $_FILES['file']['tmp_name'];
                        $local_image = "../Files/Attached_files/";
                        move_uploaded_file($tmp_name, $local_image.$name_file);
                    }
                include  '../Models/ARCHIVO_Model.php';
                $archivo = new ARCHIVO_Model('', $_POST['desc'], $_FILES['file']['name']);  
                $archivo->ADD();
                $id = $archivo->getID();
                $ADJUNTA = new ADJUNTA_Model($clavet, $clavef,$id[0]);
                $ADJUNTA->ADD();
                $respuesta = 'Inserción realizada con éxito';
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, "./Tarea_Controller.php?accion=SHOWCURRENT&param=$clavet");

            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Adjunta_Controller.php?accion=SHOWALL');
            }
        }
    }



     //método muestra pantalla de confirmación de borrado 
     //$clave: PK de la tupla
     function DELETE($clavet, $clavef, $id){
        include '../Models/ADJUNTA_Model.php';
        $ADJUNTA = new ADJUNTA_Model($clavet, $clavef, $id);
        $respuesta = $ADJUNTA->DELETE();
        include '../Views/MESSAGE.php';
        new MESSAGE($respuesta, "./ADJUNTA_Controller.php?accion=SHOWALL&param=$clavet&param2=$clavef");

    }

    //método que muestra todos los contactos de una fase
    function SHOWALL($clavet, $clavef){
        
            include '../Models/ADJUNTA_Model.php';
            $archivos = new ADJUNTA_Model($clavet,$clavef,'');
            $datos = $archivos->ShowallFase();
            if(sizeof($datos) != 0)
            {
                include '../Views/Adjunta_Views/Adjunta_SHOWALL.php';
                new  Adjunta_SHOWALL($datos, $clavet, $clavef);
            }else{
                $mens = "No hay archivos registrados";
                include '../Views/Adjunta_Views/Adjunta_SHOWALL.php';
                new  Adjunta_SHOWALL($mens, $clavet, $clavef);
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
            if(!isset($param3)){
                $accion($param, $param2);
                }else{
                    $accion($param, $param2, $param3);
                }
        }
    }
}
