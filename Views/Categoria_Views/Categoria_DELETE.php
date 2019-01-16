<?php
/**
 * Clase para realizar el DELETE en Categoria, recibe una tupla para mostrar y eliminar
 *	autor:  Juan Márquez 
 *	12/12/2018 
 */
	class Categoria_DELETE{


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
                        <td><?php echo $datos['nom_cat']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Descripción'];?></th>
                        <td><?php echo $datos['desc_cat']; ?></td>
                    </tr>
                </table>
            <div class="container-showall-btn">
                <p><?php echo $strings['¿Confirma el borrado de esta categoría?'];?><p>
                <form id="delete"action='./Categoria_Controller.php?accion=delete&param=<?php echo $datos['id_cat'];?>' method='post'>
                <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                <button class="form-btn" type="button" role="link" onclick="window.location='./Categoria_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ShowCurrent

?>