<!-- cabecera de página
 autor:  t45qxz 
12/11/2018 -->
<?php
	include_once '../Functions/Authentication.php';
	if (!isset($_SESSION['idioma'])) {
		$_SESSION['idioma'] = 'SPANISH';
	}
	else{
	}
	include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
?>
<html>

<head>
	<title>
		IU
	</title>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php echo $strings['TODOList']; ?>
	</title>
	<!-- JavaScript -->
	<script type="text/javascript" src="../Views/js/validate.js"></script>
	<!-- fuentes -->
	<link href="https://fonts.googleapis.com/css?family=Acme|Roboto" rel="stylesheet">
	<!-- BOOTSTRAP link -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	 crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../Views/css/style.css" />

	<!-- font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
	 crossorigin="anonymous">
</head>

<body>
	<div id="modal" style="display:none">
		<div id="contenido-interno">
			<div id="aviso"><img src="../Views/Icons/sign-error.png" name="aviso" /></div>
			<div id="mensajeError"></div>
			<a id="cerrar" href="#" onclick="cerrarModal();">
				<img style="cursor: pointer" alt="" src="../Views/Icons/salir.png" width="25" />
			</a>
		</div>
	</div>
	<header>
		<div class="d-flex align-items-center">
			<div class="p-2 flex-grow-1">
				<img src="../Locales/images/logo3.png" height="80">
			</div>


			<div class="row">


				<?php

	
	if (IsAuthenticated()){
?>
				<div class="col-md-4">
					<h4>
						<?php
		echo  $_SESSION['nombre'] . '<br>';
?>
					</h4>
				</div>
				<div class=" col-md-2 logout">
					<a href='../Functions/Desconectar.php'>
						<i class="fas fa-sign-out-alt"></i>
					</a>
				</div>
				<?php
		
	}
	else{
?>
				<div class="col-md-4">
					<?php
		echo $strings['Usuario no autenticado']; 
		/*echo 	'<form name=\'registerForm\' action=\'../Controller/Register_Controller.php\' method=\'post\'>
					<input type=\'submit\' name=\'action\' value=\'REGISTER\'>
				</form>';*/
?>

					<button class="buttoncustom hdr" onclick="window.location='../Controllers/Registro_Controller.php'"><i class="fas fa-user-plus"></i></button>
				</div>
				<?php
	}	
?>


				<div class="col-md-4 dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown"
					 aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-language"></i>
					</button>
					<div class="dropdown-menu" aria-labelledby="languageDropdown">
						<form class="idioma" name='idiomaform' action="../Functions/CambioIdioma.php" method="post">
							<button class="langbtn" name="idioma" value="ENGLISH"><img src="../Views/images/Language/English.png" onclick='this.form.submit()'
								 style="width:30"></button>
						</form>
						<form class="idioma" name='idiomaform' action="../Functions/CambioIdioma.php" method="post">
							<button class="langbtn" name="idioma" value="SPANISH"><img src="../Views/images/Language/Spanish.png" onclick='this.form.submit()'
								 style="width:30"></button>
						</form>
						<form class="idioma" name='idiomaform' action="../Functions/CambioIdioma.php" method="post">
							<button class="langbtn" name="idioma" value="GALLAECIAN"><img src="../Views/images/Language/Galician.png"
								 onclick='this.form.submit()' style="width:30"></button>
						</form>

					</div>

				</div>
			</div>
		</div>
		</div>
	</header>
	<?php
	//session_start();
	if (IsAuthenticated()){
		include '../Views/users_menu.php';
	}
?>
	<div class="row">