<?php
/**
 * Clase para realizar el DELETE en Usuario, recibe una tupla para mostrar y eliminar
 *	autor:  Juan Márquez 
 *	13/12/2018 
 */
	class Usuario_DELETE{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
            <div class="col-md-3"></div>
            <div class="col-md-6 table-responsive contenido">
            <fieldset class="sc">
            <legend><?php echo $strings['Confirmación de borrado'];?></legend>  
            <!--Contenedor con botones de adición y búsqueda  -->
                    <table class="tab-twocol shadow showtable delete">
                    <thead>
                    <tr>
                        <th><?php echo $strings['Atributo'];?></th>
                        <th><?php echo $strings['Valor'];?></th>
                    </tr>
                    </thead>
                    <tr>
                        <th><?php echo $strings['Nombre'];?></th>
                        <td><?php echo $datos['nom_usr']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Apellidos'];?></th>
                        <td><?php echo $datos['apel_usr']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Teléfono'];?></th>
                        <td><?php echo $datos['telf_usr']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['E-mail'];?></th>
                        <td><?php echo $datos['email_usr']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Contraseña'];?></th>
                        <td><?php echo $datos['pass_usr']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Fecha de nacimiento'];?></th>
                        <td><?php echo $datos['fechna_usr']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Tipo'];?></th>
                        <td><?php echo $datos['tipo_usr']; ?></td>
                    </tr>
                </table>
            <div class="container-showall-btn">
                <p><?php echo $strings['¿Confirma el borrado de esta categoría?'];?><p>
                <form id="delete"action='./Usuario_Controller.php?accion=delete&param=<?php echo $datos['email_usr'];?>' method='post'>
                <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                <button class="form-btn" type="button" role="link" onclick="window.location='./Usuario_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ShowCurrent

?>