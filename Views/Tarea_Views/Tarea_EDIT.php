<?php
/**
 * Clase para realizar el EDIT en Usuario, recibe una tupla para mostrar y editar
 *	autor:  Juan Márquez 
 *	13/12/2018
 */
	class Usuario_EDIT{

		function __construct($datos){	
            $datos = $datos;
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
            <div class="col-md-4"></div>
        <div class="col-md-4 contenido articulo">

        <form name="edit" id="edit" enctype="multipart/form-data" onsubmit="return comprobarFormAddUser(this)" action='./Usuario_Controller.php?accion=EDIT&param=<?php echo $datos['email_usr'];?>' method='post'>
        <legend><?php echo $strings['Edición de usuario'];?></legend>
		<p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
        <div class="bloque">
				<label><?php echo $strings['Nombre'];?></label>
				<input type = 'text' name = 'nombre' id = 'nombre' size = '20' value = '<?php echo $datos['nom_usr'];?>' placeholder = '<?php echo $strings['Sólo letras']?> 'onblur="comprobarAlfabético(this,30)" >
				<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
            </div>
			<div class="campo">
						<label><?php echo $strings['Apellidos']?> : </label>
						<input type = 'text' name = 'apellidos' id = 'apellidos' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = '<?php echo $datos['apel_usr'];?>' onblur="comprobarAlfabetico(this,50)" ><br>
						<p class="invalid" id="invalidapellidos"><?php echo $strings['Formato no válido']?></p>
					</div>
			<div class="campo">
				<label><?php echo $strings['Teléfono']?> : </label>
				<input type = 'text' name = 'telf' id='telf' size = '15' value = '<?php echo $datos['telf_usr'];?>' onblur="comprobarTelf(this)" ><br>
				<p class="invalid" id="invalidtelf"><?php echo $strings['Teléfono incorrecto'];?></p>
			</div>
			<div class="campo">
				<label>E-mail</label>
				<input type = 'text' name = 'email' id = 'email' size = '25' onkeydown="return false" value = '<?php echo $datos['email_usr'];?>' onblur="comprobarCorreo(this,60)" >
				<p class="invalid" id="invalidemail"><?php echo $strings['E-mail incorrecto'];?></p>
			</div>
			<div class="bloque">
			<div class="campo">
						<label>Password : </label>
						<input type = 'text' name = 'password' id = 'password' placeholder = '<?php echo $strings['Letras y números']?>' size = '16' value = '<?php echo $datos['pass_usr'];?>' onblur="return comprobarAlfanum(this,20)" ><br>
						<p class="invalid" id="invalidpassword"><?php echo $strings['Formato no válido'];?></p>
					</div>
					</div>
			<div class="campo">

				<div class="campo">
					<label><?php echo $strings['Fecha de nacimiento']?> :</label>
					<input type = 'date' value="<?php echo $datos['fechna_usr'];?>" name = 'fecha' onkeydown="return false"><br>
				</div>
				<div class="campo">
				<label><?php echo $strings['Tipo']?> : </label>
				<select name="tipo" id="tipo">
				<option value="<?php echo $datos['tipo_usr'];?>"><?php echo $datos['tipo_usr'];?></option>
				<option value="ADMIN"><?php echo $strings['Administrador']; ?></option>
				<option value="BASICO"><?php echo $strings['Básico']; ?></option>
				</select>
				</div>
				                    <!-- Contenedor de los iconos: aceptar, volver-->
									<div class="container-btn">
                        <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
						<button class="form-btn" type="button" role="link" onclick="window.location='./Usuario_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
                    </div>
    </form> 
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin EDIT

?>