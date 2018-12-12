<!-- pie de página
 autor:  t45qxz 
12/11/2018 -->
</div>
<footer>
	<div class="d-flex mb-1 ml-auto">
		<div class="p-2">
			<?php
				if (IsAuthenticated()){
					echo $strings['Usuario'] . ' : ' . $_SESSION['login'];
				}
			?>
		</div>
		<div class="p-2">
			<?php echo $strings['Hoy es']?> <?php echo date("d-M-Y", time()); ?>
		</div>
		<div class="p-2">
			<?php echo $strings['Grupo']?>:  IU_4_burton 
		</div>
	</div>
</footer>
</body>
</html>

		