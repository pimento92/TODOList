<?php
/**
 * Clase para realizar el ADD en Usuario
 *	autor:  Juan Márquez 
 *	13/12/2018 
 */
	class Usuario_ADD{


		function __construct(){	
			$this->render();
		}

		function render(){
            include '../Views/Header.php';?>
    <div class="col-md-4"></div>
    <div class="col-md-4 contenido articulo">

        <form name="add" enctype="multipart/form-data" id="add" onsubmit="return comprobarFormAddUser(this)" action='./Usuario_Controller.php?accion=ADD' method='post'>
        <legend><?php echo $strings['Añadir usuario'];?></legend>
        <p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>

       <div class="bloque">
				<label><?php echo $strings['Nombre'];?></label>
				<input type = 'text' name = 'nombre' id = 'nombre' size = '20' value = '' placeholder = '<?php echo $strings['Sólo letras']?> 'onblur="comprobarAlfabético(this,30)" >
				<p class="invalid" id="invalidnombre"><?php echo $strings['Formato no válido'];?></p>
            </div>
			<div class="campo">
						<label><?php echo $strings['Apellidos']?> : </label>
						<input type = 'text' name = 'apellidos' id = 'apellidos' placeholder = '<?php echo $strings['Sólo letras']?>' size = '25' value = '' onblur="comprobarAlfabetico(this,50)" ><br>
						<p class="invalid" id="invalidapellidos"><?php echo $strings['Formato no válido']?></p>
					</div>
			<div class="campo">
				<label><?php echo $strings['Teléfono']?> : </label>
				<input type = 'text' name = 'telf' id='telf' size = '15' value = '' onblur="comprobarTelf(this)" ><br>
				<p class="invalid" id="invalidtelf"><?php echo $strings['Teléfono incorrecto'];?></p>
			</div>
			<div class="campo">
				<label>E-mail</label>
				<input type = 'text' name = 'email' id = 'email' size = '25' value = '' onblur="comprobarCorreo(this,60)" >
				<p class="invalid" id="invalidemail"><?php echo $strings['E-mail incorrecto'];?></p>
			</div>
			<div class="bloque">
			<div class="campo">
						<label>Password : </label>
						<input type = 'password' name = 'password' id = 'password' placeholder = '<?php echo $strings['Letras y números']?>' size = '16' value = '' onblur="return comprobarAlfanum(this,20)" ><br>
						<input name="show" type="checkbox" onclick="mostrarContraseña()"><small><?php echo '   ' .  $strings['Mostrar contraseña'];?></small>
						<p class="invalid" id="invalidpassword"><?php echo $strings['Formato no válido'];?></p>
					</div>
					</div>
			<div class="campo">

				<div class="campo">
					<label><?php echo $strings['Fecha de nacimiento']?> :</label>
					<input type = 'date' name = 'fecha' onkeydown="return false"><br>
				</div>
				<div class="campo">
				<label><?php echo $strings['Tipo']?> : </label>
				<select name="tipo" id="tipo">
				<option value=""></option>
				<option value="ADMIN"><?php echo $strings['Administrador']; ?></option>
				<option value="BASICO"><?php echo $strings['Básico']; ?></option>
				</select>
				</div>

        <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
        <div class="container-btn">
            <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
			<button class="form-btn" type="button" role="link" onclick="window.location='./Usuario_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
            <button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i></button>
        </div>
        
    </form> 
</div>
   
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ADD

?>