<?php
/**
 * Clase para realizar el ADD en Tarea
 *	autor:  Juan Márquez 
 *	14/12/2018 
 */
	class Tarea_ADD{


		function __construct($datp, $datc){	
			$this->render($datp, $datc);
		}

		function render($datp, $datc){
            include '../Views/Header.php';?>
    <div class="col-md-4"></div>
    <div class="col-md-4 container-fluid contenido">

        <form name="add" enctype="multipart/form-data" id="add" onsubmit="return comprobarFormTarea(this)" action='./Tarea_Controller.php?accion=ADD' method='post'>
        <legend><?php echo $strings['Añadir tarea'];?></legend>
        <p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>

       <div class="bloque">
				<label><?php echo $strings['Descripción'];?></label>
				<input type = 'text' name = 'desc' id = 'desc' size = '20' value = '' placeholder = '<?php echo $strings['Sólo letras']?>' onblur="comprobarAlfabetico(this,30)" >
				<p class="invalid" id="invaliddesc"><?php echo $strings['Formato no válido'];?></p>
            </div>
			<div class="campo">
				<label><?php echo $strings['Prioridad'];?></label>
				<select name="pri" id="pri">
					<?php foreach($datp as $datos){?>
					<option value="<?php echo $datos['id_pri'];?>"><?php echo $datos['nom_pri'];?></option>
					<?php }?>
				</select>
				<p class="invalid" id="invalidpri"><?php echo $strings['Selecciona prioridad'];?></p>
			</div>
			
			<div class="campo">
				<label><?php echo $strings['Categoría'];?></label>
				<select name="cat" id="cat">
					<?php foreach($datc as $datos){?>
					<option value="<?php echo $datos['id_cat'];?>"><?php echo $datos['nom_cat'];?></option>
					<?php }?>
				</select>
			</div>
			
			<!-- Colocamos los inputs predeterminados -->
			<input type="text" name="email" id="email" style="display:none" value="<?php echo $_SESSION['email'];?>">
			<input type="text" name="fecha" id="fecha" style="display:none" value="<?php echo date('Y-m-d');?>">
			<input type="text" name="estado" id="estado" style="display:none" value="ABIERTA">


        <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
        <div class="container-btn">
            <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
			<button class="form-btn" type="button" role="link" onclick="window.location='./Tarea_Controller.php?accion=SHOWALL&param=fecha'"><i class="fas fa-times"></i></button>
            <button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i></button>
        </div>
        
    </form> 
</div>
   
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ADD

?>