<?php
/**
 * Clase para realizar el ADD en Fase
 *	autor:  Juan Márquez 
 *	17/12/2018 
 */
	class Fase_ADD{


		function __construct($clave, $datosc){	
			$this->render($clave, $datosc);
		}

		function render($clave,  $datosc){
            include '../Views/Header.php';?>
    <div class="col-md-4"></div>
    <div class="col-md-4 contenido articulo">

        <form name="add" enctype="multipart/form-data" id="add" onsubmit="return comprobarFormFase(this)" action='./Fase_Controller.php?accion=ADD&param=<?php echo $clave;?>' method='post'>
        <legend><?php echo $strings['Añadir fase'];?></legend>
        <p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
       <div class="bloque">
				<label><?php echo $strings['Descripción'];?></label>
				<input type = 'text' name = 'desc' id = 'desc' size = '20' value = '' placeholder = '<?php echo $strings['Sólo letras']?> 'onblur="comprobarAlfabético(this,30)" >
				<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
			</div>
			<input style="display:none" type="text" name="fecha" id="fecha" value="<?php echo date('Y-m-d');?>">
			<input style="display:none" type="text" name="estado" id="estado" value="ABIERTA">
			<div class="campo">
				<label><?php echo $strings['Contacto'];?></label>
				<select name="con" id="con" onchange="return AddInput()">
				<option value=""></option>
					<?php foreach($datosc as $datos){?>
					<option value="<?php echo $datos['nom_con'];?>"><?php echo $datos['nom_con'];?></option>
					<?php }?>
				</select>
			</div>
			<div class="row selectcont">
			<div class="col-md-9 colselectcont1">
				<p><?php echo $strings['Si no encuentra el contacto que busca puede crearlo'];?></p>
			</div>
			<div class="col-md-1 colselectcont2">
				<button class="form-btn " role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=ADD&param=<?php echo $clave;?>'"><i class="mini fas fa-plus"></i>
			</div>
			</div>
			<div class="campo">
			<label><?php echo $strings['Archivo']?></label>
			<div class="upload-btn-wrapper">
					<input type="file" name="file">
					<div class="upload-btn-wrapper">
  					<button class="btn"><?php echo $strings['Seleccionar archivo'];?></button>
  					<input type="file" name="myfile" />
	</div>
			</div>
			<!-- Colocamos los inputs predeterminados -->
			<input type="text" name="email" id="email" style="display:none" value="<?php echo $_SESSION['email'];?>">
			<input type="text" name="fecha" id="fecha" style="display:none" value="<?php echo date('Y-m-d');?>">
			<input type="text" name="estado" id="estado" style="display:none" value="ABIERTA">
			<div class="campo">


        <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
        <div class="container-btn">
            <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
			<button class="form-btn" type="button" role="link" onclick="window.location='./Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $clave;?>'"><i class="fas fa-times"></i></button>
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