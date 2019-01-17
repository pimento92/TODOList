<?php
/**
 * Clase para realizar el EDIT en Fase, recibe una tupla para mostrar y editar
 *	autor:  Juan Márquez 
 *	15/12/2018
 */
	class Fase_EDIT{

		function __construct($clavet, $clavef, $datos){	
			$this->render($clavet, $clavef, $datos);
		}

		function render($clavet, $clavef, $datos){
            include '../Views/Header.php';?>
    <div class="col-md-3"></div>
    <div class="col-md-6 table-responsive contenido">

        <form name="edit" enctype="multipart/form-data" id="edit" onsubmit="return comprobarFormFase(this)" action='./Fase_Controller.php?accion=EDIT&param=<?php echo $clavet."&param2=".$clavef;?>' method='post'>
        <legend><?php echo $strings['Edición de fase'];?></legend>
        <p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
       <div class="bloque">
				<label><?php echo $strings['Descripción'];?></label>
				<input type = 'text' name = 'desc' id = 'desc' size = '70' value = '<?php echo $datos['desc_fas'];?>' placeholder = '<?php echo $strings['Sólo letras']?> 'onblur="comprobarAlfabético(this,150)" >
				<p class="invalid" id="invaliddesc"><?php echo $strings['Formato no válido'];?></p>
			</div>


			<!-- Colocamos los inputs predeterminados -->

			<div class="campo">


        <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
        <div class="container-btn">
            <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
			<button class="form-btn" type="button" role="link" onclick="window.location='./Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $clavet;?>'"><i class="fas fa-times"></i></button>
            <button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i></button>
        </div>
		</div>
    </form> 
</div>
   
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ADD

?>