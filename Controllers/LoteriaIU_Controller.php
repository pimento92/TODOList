<?php
/**Controlador para las vistas de la lotería y el modelo de la lotería
 * autor:  t45qxz 
 * 12-11-2018
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
            include '../Views/LoteriaIU_ADD.php';
            new LoteriaIU_ADD();

        }else{
            include '../Models/LOTERIAIU_Model.php';
            $boleto = new LOTERIAIU_Model($_POST['email'],$_POST['nombre'],$_POST['apellidos'],$_POST['participacion'],$_FILES['file']['name'],$_POST['ingresado'],$_POST['premio'],$_POST['pagado']);

            $respuesta = $boleto->Register($_POST['email']);
            if($respuesta === true)
            {
                $respuesta = $boleto->ADD();
                if($respuesta === true)
                {
                    
                    if(isset($_FILES['file']))
                    {
                        $name_file = $_FILES['file']['name'];
                        $tmp_name = $_FILES['file']['tmp_name'];
                        $local_image = "../Files/Resguardos/";
                        move_uploaded_file($tmp_name, $local_image.$_POST['email']."-".$name_file);
                    }
                    $respuesta = 'Inserción realizada con éxito';
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './LoteriaIU_Controller.php?accion=ADD');

                }else{
                    $respuesta = 'Error en la inserción';
                    include '../Views/MESSAGE.php';
                    new MESSAGE($respuesta, './LoteriaIU_Controller.php?accion=ADD');
                }
            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './LoteriaIU_Controller.php?accion=ADD');
            }
        }
    }


    //método que llama a la función SEARCH del modelo
    function SEARCH(){
        if(!isset($_POST['submit']))
        {
            include '../Views/LoteriaIU_SEARCH.php';
            new LoteriaIU_SEARCH();

        }else{
            include '../Models/LOTERIAIU_Model.php';
            $boleto = new LOTERIAIU_Model($_POST['email'],$_POST['nombre'],$_POST['apellidos'],$_POST['participacion'],$_POST['file'],$_POST['ingresado'],$_POST['premio'],$_POST['pagado']);
            $datos = $boleto->SEARCH();
            if(is_array($datos) === true){
                include '../Views/LoteriaIU_SHOWALL.php';
                new LoteriaIU_SHOWALL($datos);
            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($datos, './LoteriaIU_Controller.php?accion=SEARCH');
            }
        }
    }

     //método muestra pantalla de confirmación de borrado 
     //$clave: PK de la tupla
     function DELETE($clave){
        include '../Models/LOTERIAIU_Model.php';
        $boleto = new LOTERIAIU_Model($clave,'','','','','','','');
        if(!isset($_POST['submit']))
        {
            $datos = $boleto->SEARCH();
            include '../Views/LoteriaIU_DELETE.php';
            new LoteriaIU_DELETE($datos);
        }else{
            $respuesta = $boleto->DELETE($clave);
            if($respuesta === true){

                $mensaje = 'Borrado realizado con éxito';
                include '../Views/MESSAGE.php';
                new MESSAGE($mensaje, './LoteriaIU_Controller.php?accion=SHOWALL');
            }else{

                $mensaje = 'Error en el borrado';
                include '../Views/MESSAGE.php';
                new MESSAGE($mensaje, './LoteriaIU_Controller.php?accion=SHOWALL');
            }
        }
    }

    //método muestra pantalla de edición y edita en caso de submit
     //$clave: PK de la tupla
     function EDIT($clave){
        if(!isset($_POST['submit']))
        {
            include '../Models/LOTERIAIU_Model.php';
            $boleto = new LOTERIAIU_Model($clave,'','','','','','','');
            $datos = $boleto->SEARCH();
            include '../Views/LoteriaIU_EDIT.php';
            new LoteriaIU_EDIT($datos);

        }else{
            include '../Models/LOTERIAIU_Model.php';
            $boleto = new LOTERIAIU_Model($_POST['email'],$_POST['nombre'],$_POST['apellidos'],$_POST['participacion'],$_FILES['file']['name'],$_POST['ingresado'],$_POST['premio'],$_POST['pagado']);

            $respuesta = $boleto->EDIT($clave);
            if($respuesta === true)
            {
                if(isset($_FILES['file']))
                {
                    $name_file = $_FILES['file']['name'];
                    $tmp_name = $_FILES['file']['tmp_name'];
                    $local_image = "../Files/Resguardos/";
                    move_uploaded_file($tmp_name, $local_image.$_POST['email']."-".$name_file);
                }
                $respuesta = 'Edición realizada con éxito';
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './LoteriaIU_Controller.php?accion=SHOWALL');

            }else{
                $respuesta = 'Error en la edición';
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './LoteriaIU_Controller.php?accion=SHOWALL');
            }
        }
    }

     //método muestra la información de una tupla 
     //$clave: PK de la tupla
     function SHOWCURRENT($clave){
            include '../Models/LOTERIAIU_Model.php';
            $boleto = new LOTERIAIU_Model($clave,'','','','','','','');
            $datos = $boleto->SEARCH();
            include '../Views/LoteriaIU_SHOWCURRENT.php';
            new LoteriaIU_SHOWCURRENT($datos);
    }

    //método que muestra todos los boletos
    function SHOWALL(){
        
            include '../Models/LOTERIAIU_Model.php';
            $boleto = new LOTERIAIU_Model('','','','','','','','');
            $datos = $boleto->SHOWALL();
            if(sizeof($datos) != 0)
            {
                include '../Views/LoteriaIU_SHOWALL.php';
                new LoteriaIU_SHOWALL($datos);
            }else{
                $mens = "No hay boletos registrados";
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
