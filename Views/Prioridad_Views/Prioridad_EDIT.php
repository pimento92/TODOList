<?php
/**
 * Clase para realizar el EDIT en prioridad, recibe una tupla para mostrar y editar
 *	autor:  Juan Márquez 
 *	12/12/2018
 */
	class Prioridad_EDIT{

		function __construct($datos){	
            $datos = $datos;
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
            <div class="col-md-4"></div>
        <div class="col-md-4 table-responsive contenido">

        <form name="edit" id="edit" enctype="multipart/form-data" onsubmit="return comprobarFormPrio(this)" action='./Prioridad_Controller.php?accion=EDIT&param=<?php echo $datos['id_pri'];?>' method='post'>
        <legend><?php echo $strings['Edición de prioridad'];?></legend>
		<p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
        <div class="bloque">
	   		<div class="campo">
				<label><?php echo $strings['Nombre'];?></label>
				<input type = 'text' name = 'nombre' id = 'nombre' size = '20' value = '<?php echo $datos['nom_pri'];?>' onblur="comprobarAlfabetico(this,20)" >
				<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
            </div>
            <div class="campo">
				<label><?php echo $strings['Color']?></label>
				<input class="color" name='color' type="color" value="<?php echo $datos['codcolor_pri'];?>">
			</div>
			<div class="campo">
				<label><?php echo $strings['Descripción']?></label>
				<input type = 'text' name = 'desc' id = 'nombre' placeholder = '<?php echo $strings['Sólo letras']?>' size = '48' value = '<?php echo $datos['desc_pri'];?>' onblur="comprobarAlfabetico(this,150)" >
				<p class="invalid" id="invaliddesc"><?php echo $strings['Formato no válido'];?></p>
			</div>
			<input type="number" name="id" style="display:none" value="<?php echo $datos['id_pri']?>">
		</div>
                    <!-- Contenedor de los iconos: aceptar, volver-->
                    <div class="container-btn">
                        <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
						<button class="form-btn" type="button" role="link" onclick="window.location='./Prioridad_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
                    </div>
    </form> 
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin EDIT

?>