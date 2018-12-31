<?php
/**
 * Clase para realizar el EDIT en Tarea, recibe una tupla para mostrar y editar
 *	autor:  Juan Márquez 
 *	15/12/2018
 */
	class Tarea_EDIT{

		function __construct($datos, $datp, $datc){	
            $datos = $datos;
			$this->render($datos, $datp, $datc);
		}

		function render($datos, $datp, $datc){
            include '../Views/Header.php';?>
            <div class="col-md-4"></div>
        <div class="col-md-4 contenido articulo">

        <form name="edit" id="edit" enctype="multipart/form-data" onsubmit="" action='./Tarea_Controller.php?accion=EDIT&param=<?php echo $datos['id_tar'];?>' method='post'>
        <legend><?php echo $strings['Edición de tarea'];?></legend>
		<p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
       		 <div class="bloque">
				<label><?php echo $strings['Descripción'];?></label>
				<input type = 'text' name = 'desc' id = 'desc' size = '45' value = '<?php echo $datos['desc_tar'];?>' placeholder = '<?php echo $strings['Sólo letras']?> 'onblur="comprobarAlfabetico(this,30)" >
				<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
            </div>
			<div class="campo">
					<label><?php echo $strings['Categoría']?> : </label>
					<select name="cat" id="cat">
						<option value="<?php echo $datos['id_cat'];?>"><?php echo $datos['nom_cat'];?></option>
					<?php foreach($datc as $data){ 
						if ($data['id_cat'] == $datos['id_cat']){}else{ ?>
						<option value="<?php echo $data['id_cat'];?>"><?php echo $data['nom_cat'];?></option>
					<?php }}?>
					</select>
				</div>
			<div class="campo">
				<label><?php echo $strings['Prioridad']?> : </label>
				<select name="pri" id="pri">
						<option value="<?php echo $datos['id_pri'];?>"><?php echo $datos['nom_pri'];?></option>
					<?php foreach($datp as $data){ 
						if ($data['id_pri'] == $datos['id_pri']){}else{ ?>
						<option value="<?php echo $data['id_pri'];?>"><?php echo $data['nom_pri'];?></option>
					<?php }}?>
					</select>
			</div>


			<div class="campo">
				<!-- Contenedor de los iconos: aceptar, volver-->
				<div class="container-btn">
					<button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
					<button class="form-btn" type="button" role="link" onclick="window.location='./Tarea_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
				</div>
			</div>
    </form> 
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin EDIT

?>