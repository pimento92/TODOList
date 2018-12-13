<?php
/**
 * Clase para realizar el ADD en prioridades
 *	autor:  Juan Márquez 
 *	12/12/2018 
 */
	class Prioridad_ADD{


		function __construct(){	
			$this->render();
		}

		function render(){
            include '../Views/Header.php';?>
    <div class="col-md-4"></div>
    <div class="col-md-4 contenido articulo">

        <form name="add" enctype="multipart/form-data" id="add" onsubmit="return comprobarForm(this)" action='./Prioridad_Controller.php?accion=ADD' method='post'>
        <legend><?php echo $strings['Añadir prioridad'];?></legend>
        <p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>

       <div class="bloque">
	   		<div class="campo">
				<label><?php echo $strings['Nombre'];?></label>
				<input type = 'text' name = 'nombre' id = 'nombre' size = '20' value = '' onblur="comprobarAlfabético(this,20)" >
				<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
            </div>
            <div class="campo">
				<label><?php echo $strings['Color']?></label>
				<input class="color" name='color' type="color" value="#000000">
			</div>
			<div class="campo">
				<label><?php echo $strings['Descripción']?></label>
				<input type = 'text' name = 'desc' id = 'nombre' placeholder = '<?php echo $strings['Sólo letras']?>' size = '48' value = '' onblur="comprobarAlfabetico(this,150)" >
				<p class="invalid" id="invaliddesc"><?php echo $strings['Formato no válido'];?></p>
			</div>
		</div>
        <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
        <div class="container-btn">
            <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
            <button class="form-btn" role="link" onclick="window.location='./Index_Controller.php';"><i class="fas fa-times"></i></button>
            <button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i></button>
        </div>
        
    </form> 
</div>
   
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ADD

?>