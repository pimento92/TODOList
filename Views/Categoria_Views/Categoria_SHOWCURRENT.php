<?php
/**
 * Clase para realizar el SHOWCURRENT en Categoria, recibe una tupla para mostrar
 *	autor:  Juan Márquez 
 *	12/12/2018 
 */
	class Categoria_SHOWCURRENT{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
            <div class="col-md-3"></div>
    <div class="col-md-5 table-responsive contenido">
    <fieldset class="sc">
            <legend><?php echo $strings['Datos de categoría'];?></legend>  
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
                        <td><?php echo $datos['nom_cat']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Descripción'];?></th>
                        <td><?php echo $datos['desc_cat']; ?></td>
                    </tr>
                </table>
            <div class="container-showall-btn">
                <button class="form-btn" type="button" role="link" onclick="window.location='./Categoria_Controller.php?accion=SHOWALL'"><i class="fas fa-arrow-left"></i>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ShowCurrent

?>