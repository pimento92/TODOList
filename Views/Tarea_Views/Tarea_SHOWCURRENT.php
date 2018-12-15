<?php
/**
 * Clase para realizar el SHOWCURRENT en Usuario, recibe una tupla para mostrar
 *	autor:  Juan Márquez 
 *	13/12/2018 
 */
	class Usuario_SHOWCURRENT{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
            <div class="col-md-3"></div>
    <div class="col-md-5 contenido articulo">
    <fieldset class="sc">
            <legend><?php echo $strings['Datos de usuario'];?></legend>  
            <!-- Foto de perfil -->
            <!--Contenedor con botones de adición y búsqueda  -->
                    <table class="tab-twocol shadow showtable">
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
                <button class="form-btn" type="button" role="link" onclick="window.location='./Usuario_Controller.php?accion=SHOWALL'"><i class="fas fa-arrow-left"></i>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ShowCurrent

?>