<?php
/**
 * Clase para realizar el EDIT en Contacto, recibe una tupla para mostrar y editar
 *	autor:  Juan Márquez 
 *	13/12/2018
 */
	class Contacto_EDIT{

		function __construct($datos){	
            $datos = $datos;
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
            <div class="col-md-4"></div>
        <div class="col-md-4 contenido articulo">

        <form name="edit" id="edit" enctype="multipart/form-data" onsubmit="return comprobarFormAddCon(this)" action='./Contacto_Controller.php?accion=EDIT&param=<?php echo $datos['email_con'];?>' method='post'>
        <legend><?php echo $strings['Edición de categoría'];?></legend>
		<p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
        <div class="bloque">
	   <div class="campo">
				<label>E-mail</label>
				<input type = 'text' name = 'email' id = 'email' size = '25' value = '<?php echo $datos['email_con'];?>' onblur="comprobarCorreo(this,60)" >
				<p class="invalid" id="invalidemail"><?php echo $strings['E-mail incorrecto'];?></p>
			</div>
	   		<div class="campo">
				<label><?php echo $strings['Nombre'];?></label>
				<input type = 'text' name = 'nombre' id = 'nombre' size = '20' value = '<?php echo $datos['nom_con'];?>' onblur="comprobarAlfabético(this,20)" >
				<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
            </div>
			<div class="campo">
				<label><?php echo $strings['Descripción']?></label>
				<input type = 'text' name = 'desc' id = 'nombre' placeholder = '<?php echo $strings['Sólo letras']?>' size = '48' value = '<?php echo $datos['desc_con'];?>' onblur="comprobarAlfabetico(this,150)" >
				<p class="invalid" id="invaliddesc"><?php echo $strings['Formato no válido'];?></p>
			</div>
			<div class="campo">
				<label><?php echo $strings['Teléfono']?> : </label>
				<input type = 'text' name = 'telf' id='telf' size = '15' value = '<?php echo $datos['telf_con'];?>' onblur="comprobarTelf(this)" ><br>
				<p class="invalid" id="invalidtelf"><?php echo $strings['Teléfono incorrecto'];?></p>
		</div>
			<input type="number" name="id" style="display:none" value="<?php echo $datos['email_con']?>">
		</div>
                    <!-- Contenedor de los iconos: aceptar, volver-->
                    <div class="container-btn">
                        <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
						<button class="form-btn" type="button" role="link" onclick="window.location='./Contacto_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
                    </div>
    </form> 
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin EDIT

?>