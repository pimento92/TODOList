<!-- pie de página
 autor:  t45qxz 
12/11/2018 -->
</div>
<div class="d-flex align-items-center ml-auto">
	<footer>
		<div class="p-2 flex-grow-1">
			<?php
				if (IsAuthenticated()){
					echo $strings['Usuario'] . ' : ' . $_SESSION['email'];
				}
			?>
		</div>
		<div class="p-2">
			<?php echo $strings['Hoy es']?> <?php echo date("d-M-Y", time()); ?>
		</div>
		<div class="p-2 ">
			<?php echo $strings['Grupo']?>:  IU_4_burton 
		</div>
	</footer>
</div>
</body>
</html>

		