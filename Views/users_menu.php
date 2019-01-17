<!-- Muestra el menu horizontal 
	autor:  t45qxz 
	12/11/2018 -->
<?php
include_once '../Functions/Authentication.php';
?>

<nav class="menu navbar navbar-expand-lg navar-light bg-light">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#usersMenu" aria-controls="usersMenu"
	 aria-expanded="false" aria-label="Toggle navigation">
		<span>Menu</span>
	</button>
	<div class="collapse navbar-collapse" id="usersMenu">
		<ul class="navbar-nav mr-auto">

			<li class="nav-item mr-2">
				<a class="nav-link" href="../Controllers/Tarea_Controller.php?accion=SHOWALL&param=fecha">
					<?php echo $strings['Tareas']; ?></a>
			</li>
			<li class="nav-item mr-2">
				<a class="nav-link " href="../Controllers/Contacto_Controller.php?accion=SHOWALL">
					<?php echo $strings['Contactos']; ?></a>
			</li>
			<?php			
					if ($_SESSION['tipo'] == 'ADMIN')
					{
				?>
			<li class="nav-item mr-2">
				<a class="nav-link " href="../Controllers/Categoria_Controller.php?accion=SHOWALL">
					<?php echo $strings['Categorías'];?></a>
			</li>
			<li class="nav-item mr-2">
				<a class="nav-link " href="../Controllers/Prioridad_Controller.php?accion=SHOWALL">
					<?php echo $strings['Prioridades']; ?></a>
			</li>
			<li class="nav-item mr-2">
				<a class="nav-link " href="../Controllers/Usuario_Controller.php?accion=SHOWALL">
					<?php echo $strings['Usuarios']; ?></a>
			</li>
			<?php
					}
				?>
		</ul>

	</div>
</nav>