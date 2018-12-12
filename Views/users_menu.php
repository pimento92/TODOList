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
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $strings['Lotería']; ?></a>
					<div class="dropdown-menu">
					<a class="dropdown-item" href="../Controllers/LoteriaIU_Controller.php?accion=ADD"><?php echo $strings['Añadir boleto']; ?></a>
						<a class="dropdown-item" href="../Controllers/LoteriaIU_Controller.php?accion=SEARCH"><?php echo $strings['Buscar boleto']; ?></a>
						<a class="dropdown-item" href="../Controllers/LoteriaIU_Controller.php?accion=SHOWALL"><?php echo $strings['Mostrar boletos']; ?></a>
					</div>	
					
				</li>				
		</ul>
		
	</nav>
</div>