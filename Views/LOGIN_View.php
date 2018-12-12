<?php
/**
 * Clase para realizar el login
 *	autor:  t45qxz
 *	12/11/2018
 */
	class Login{


		function __construct(){
			$this->render();
		}

		function render(){

			include '../Views/Header.php';
?>
		<div class="col-md-3 col-lg-4"></div>
		<div class="col-md-5 col-lg-3 contenido">
			<h1><?php echo $strings['Login']; ?></h1>
			<form class="login" name = 'Form' action='../Controllers/Login_Controller.php' method='post' onsubmit="return comprobarLogin(this);">
				<div class="bloque">
					<div class="campo">
						<label>Email : </label>
						<input type = 'text' name = 'email' placeholder =" <?php echo $strings['email']; ?>" size = '16' value = '' onblur="return comprobarAlfanum(this,15);"  ><br>
						<p class="invalid" id="invalidlogin"><?php echo $strings['Formato no válido'];?></p>
					</div>
					<div class="campo">
						<label><?php echo $strings['Contraseña'] ?>:</label>
						 <input type = 'password' name = 'password' id="password" placeholder = "<?php echo $strings['Letras y números'] ?>" size = '16' value = '' onblur="return comprobarAlfanum(this,20)"  ><br>
						 <input name="show" type="checkbox" onclick="mostrarContraseña()"><small><?php echo '   ' .  $strings['Mostrar contraseña'];?> </small>
						 <p class="invalid" id="invalidpassword"><?php echo $strings['Formato no válido'];?></p>
					</div>
				</div>
					<button class="buttoncustom" type='submit' name='action' value='Login'><i class="fas fa-sign-in-alt"></i></button>
					<p class="invalid" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>

			</form>
		</div>
		</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin Login

?>
