<?php
/**
 * Clase para realizar el SHOWCURRENT en Contacto, recibe una tupla para mostrar
 *	autor:  Juan Márquez 
 *	13/12/2018 
 */
	class Contacto_SHOWCURRENT{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
            <div class="col-md-3"></div>
    <div class="col-md-5 contenido articulo">
    <fieldset class="sc">
            <legend><?php echo $strings['Datos de contacto'];?></legend>  
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
                        <th><?php echo $strings['E-mail'];?></th>
                        <td><?php echo $datos['email_con']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Nombre'];?></th>
                        <td><?php echo $datos['nom_con']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Descripción'];?></th>
                        <td><?php echo $datos['desc_con']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Teléfono'];?></th>
                        <td><?php echo $datos['telf_con']; ?></td>
                    </tr>
                </table>
            <div class="container-showall-btn">
                <button class="form-btn" type="button" role="link" onclick="window.location='<?php echo $_SERVER['HTTP_REFERER'];?>'"><i class="fas fa-arrow-left"></i>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ShowCurrent

?>