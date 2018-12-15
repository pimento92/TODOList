<!-- Muestra el menu horizontal 
	autor:  t45qxz 
	12/11/2018 -->
<?php
include_once '../Functions/Authentication.php';
?>
<div class="menu">
	<nav>
		<ul class="nav">
				<li class="nav-item">
					<a class="nav-link" href='../Controllers/Index_Controller.php'>
						<?php echo $strings['Inicio']; ?>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link"  href="../Controllers/Tarea_Controller.php?accion=SHOWALL"><?php echo $strings['Tareas']; ?></a>	
				</li>	
				<li class="nav-item ">
				<a class="nav-link " href="../Controllers/Contacto_Controller.php?accion=SHOWALL"><?php echo $strings['Contactos']; ?></a>
				</li>
				<?php			
					if ($_SESSION['tipo'] == 'ADMIN')
					{
				?>
				<li class="nav-item ">
				<a class="nav-link " href="../Controllers/Categoria_Controller.php?accion=SHOWALL"><?php echo $strings['Categorías'];?></a>
				</li>
				<li class="nav-item ">
					<a class="nav-link " href="../Controllers/Prioridad_Controller.php?accion=SHOWALL"><?php echo $strings['Prioridades']; ?></a>
				</li>
				<li class="nav-item ">
				<a class="nav-link " href="../Controllers/Usuario_Controller.php?accion=SHOWALL"><?php echo $strings['Usuarios']; ?></a>
				</li>
				<?php
					}
				?>
		</ul>
		
	</nav>
</div>