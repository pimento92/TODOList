<?php
/**
 * Clase para realizar el EDIT en loteriaIU, recibe una tupla para mostrar y editar
 *	autor:  t45qxz 
 *	12/11/2018
 */
	class LoteriaIU_EDIT{

		function __construct($datos){	
            $datos = $datos;
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
<div class="col-md-12 contenido articulo">

        <form name="edit" id="edit" enctype="multipart/form-data" onsubmit="return comprobarForm(this)" action='./LoteriaIU_Controller.php?accion=EDIT&param=<?php echo $datos['lot.email'];?>' method='post'>
        <legend><?php echo $strings['Edición de usuario'];?></legend>
		<p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos a excepción de ingresado, premio y pagado'];?></p>
		<div class="bloque">
				<div class="campo">
					<label>E-mail</label>
					<input type = 'text' name = 'email' id = 'email' size = '25' value = '<?php echo $datos['lot.email'];?>' onblur="comprobarCorreo(this,60)" onkeydown="return false">
					<p class="invalid" id="invalidemail"><?php echo $strings['E-mail incorrecto'];?></p>
				</div>
				<div class="campo">
					<label><?php echo $strings['Nombre']?></label>
					<input type = 'text' name = 'nombre' id = 'nombre' placeholder = '<?php echo $strings['Sólo letras']?>' size = '15' value = '<?php echo $datos['lot.nombre'];?>' onblur="comprobarAlfabetico(this,30)" >
					<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
				</div>
				<div class="campo">
					<label><?php echo $strings['Apellidos']?></label>
					<input type = 'text' name = 'apellidos' placeholder = '<?php echo $strings['Sólo letras']?>' size = '20' value = '<?php echo $datos['lot.apellidos'];?>' onblur="comprobarAlfabetico(this,40)" >
					<p class="invalid" id="invalidapellidos"><?php echo $strings['Formato no válido'];?></p>
				</div>
				<div class="campo">
					<label><?php echo $strings['Participación']?></label>
					<input type = 'text' name = 'participacion' size = '5' value = '<?php echo $datos['lot.participacion'];?>' onblur="comprobarEntero(this,0,3)" >
					<p class="invalid" id="invalidparticipacion"><?php echo $strings['Formato no válido'];?></p>
				</div>
				<div class="upload-btn-wrapper">
						<label><?php echo $strings['Resguardo']?></label>
						<button class="abtn"><?php echo $strings['Seleccionar foto']?></button>
						<input type="file" name="file" value = '<?php echo $datos['lot.resguardo'];?>'/>
					</div>
					<p class="invalid" id="invalidfile"><?php echo $strings['El nombre del archivo no debe superar los 50 caracteres'];?></p>

				<div class="campo">
					<label><?php echo $strings['Ingresado']?></label>
					<select name="ingresado">
						<option value = '<?php echo $datos['lot.ingresado'];?>'><?php echo $datos['lot.ingresado'];?>'</option>
						<option value="SI"><?php echo $strings['Si']?></option>
						<option value="NO"><?php echo $strings['No']?></option>
					</select> <br><br>
				</div>
				<div class="campo">
					<label><?php echo $strings['Premio']?></label>
					<input type = 'text' name = 'premio' size = '5' onblur="comprobarEntero(this,0,6)" value = '<?php echo $datos['lot.premiopersonal'];?>'>
					<p class="invalid" id="invalidpremio"><?php echo $strings['Formato no válido'];?></p>
				</div>
				<div class="campo">
					<label><?php echo $strings['Pagado']?></label>
					<select name="pagado">
						<option value = '<?php echo $datos['lot.pagado'];?>'><?php echo $datos['lot.pagado'];?>'</option>
						<option value="SI"><?php echo $strings['Si']?></option>
						<option value="NO"><?php echo $strings['No']?></option>
					</select> <br><br>
				</div>
			</div >
                    <!-- Contenedor de los iconos: aceptar, volver-->
                    <div class="container-btn">
                        <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
                        <button class="form-btn" role="link" onclick="window.location='./LoteriaIU_Controller.php?accion=SHOWALL';"><i class="fas fa-times"></i></button>
                    </div>
    </form> 
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin EDIT

?>