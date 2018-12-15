<?php
/**Controlador para las vistas de la CATEGORÍA y el modelo de la Categoria
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
            include '../Views/Categoria_Views/Categoria_ADD.php';
            new Categoria_ADD();

        }else{
            include '../Models/Categoria_Model.php';
            $Categoria = new Categoria_Model('',$_POST['nombre'],$_POST['desc']);

            $respuesta = $Categoria->Exists();
            if($respuesta === true)
            {
                $Categoria->ADD();
                $respuesta = 'Inserción realizada con éxito';
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Categoria_Controller.php?accion=SHOWALL');

            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Categoria_Controller.php?accion=SHOWALL');
            }
        }
    }


    //método que llama a la función SEARCH del modelo
    function SEARCH(){
        if(!isset($_POST['submit']))
        {
            include '../Views//Categoria_Views/Categoria_SEARCH.php';
            new Categoria_SEARCH();

        }else{
            include '../Models/Categoria_Model.php';
            $boleto = new Categoria_Model('',$_POST['nombre'],$_POST['desc']);
            $datos = $boleto->SEARCH();
            if(is_array($datos) === true){
                include '../Views/Categoria_Views/Categoria_SHOWALL.php';
                new Categoria_SHOWALL($datos);
            }else{
                include '../Views/MESSAGE.php';
                new MESSAGE($datos, './Categoria_Controller.php?accion=SEARCH');
            }
        }
    }

     //método muestra pantalla de confirmación de borrado 
     //$clave: PK de la tupla
     function DELETE($clave){
        include '../Models/Categoria_Model.php';
        $Categoria = new Categoria_Model($clave,'','');
        if(!isset($_POST['submit']))
        {
            $datos = $Categoria->SEARCH();
            include '../Views/Categoria_Views/Categoria_DELETE.php';
            new Categoria_DELETE($datos);
        }else{
            $respuesta = $Categoria->DELETE($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Categoria_Controller.php?accion=SHOWALL');

        }
    }

    //método muestra pantalla de edición y edita en caso de submit
     //$clave: PK de la tupla
     function EDIT($clave){
        if(!isset($_POST['submit']))
        {
            include '../Models/Categoria_Model.php';
            $categoria = new Categoria_Model($clave, '','');
            $datos = $categoria->SEARCH();
            include '../Views/Categoria_Views/Categoria_EDIT.php';
            new Categoria_EDIT($datos);

        }else{
            include '../Models/Categoria_Model.php';
            $categoria = new Categoria_Model($_POST['id'],$_POST['nombre'],$_POST['desc']);
            $respuesta = $categoria->Edit($clave);
                include '../Views/MESSAGE.php';
                new MESSAGE($respuesta, './Categoria_Controller.php?accion=SHOWALL');
         
        }
    }

     //método muestra la información de una tupla 
     //$clave: PK de la tupla
     function SHOWCURRENT($clave){
            include '../Models/Categoria_Model.php';
            $Categoria = new Categoria_Model($clave,'','');
            $datos = $Categoria->SEARCH();
            include '../Views/Categoria_Views/Categoria_SHOWCURRENT.php';
            new Categoria_SHOWCURRENT($datos);
    }

    //método que muestra todos los boletos
    function SHOWALL(){
        
            include '../Models/Categoria_Model.php';
            $Categoria = new Categoria_Model('','','');
            $datos = $Categoria->Showall();
            if(sizeof($datos) != 0)
            {
                include '../Views/Categoria_Views/Categoria_SHOWALL.php';
                new  Categoria_SHOWALL($datos);
            }else{
                $mens = "No hay Categorias registradas";
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
