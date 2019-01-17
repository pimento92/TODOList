<?php
/**
 * Clase para realizar el SEARCH en categoria
 *	autor:  Juan Márquez 
 *	12/12/2018 
 */
	class Categoria_SEARCH{


		function __construct(){	
			$this->render();
		}

		function render(){
            include '../Views/Header.php';?>
<div class="col-md-4"></div>
<div class="col-md-4 table-responsive contenido">
    <form name="search" id="search"  action='../Controllers/Categoria_Controller.php?accion=SEARCH' method='post' >
        <legend><?php echo $strings['Búsqueda de categorías'];?></legend>
        <div class="bloque">
        <!-- Contenedor de los pares input/label -->
            <!-- 'Campo' es un div para diseñar cada par label/input -->
            <div class="campo">
            <label><?php echo $strings['Nombre'];?></label>
            <input name="nombre"  type="text" size="20" >
            </div>
        </div>
        <div class="bloque">
            <div class="campo">
                <label><?php echo $strings['Descripción'];?></label>
                <input name="desc" type="text" size="45" >
            </div>
        </div>


            <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
            <div class="container-btn col-md-12">
                <button class="form-btn" name="submit" type="submit"><i class="fas fa-search"></i> 
                <button class="form-btn" type="button" role="link" onclick="window.location='./Categoria_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
                <button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i>
            </div>
        
    </form> 
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin Search

?>