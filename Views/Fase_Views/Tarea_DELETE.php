<?php
/**
 * Clase para realizar el DELETE en Tarea, recibe una tupla para mostrar y eliminar
 *	autor:  Juan Márquez 
 *	15/12/2018 
 */
	class Tarea_DELETE{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
            <div class="col-md-3"></div>
            <div class="col-md-6 contenido articulo">
            <fieldset class="sc">
            <legend><?php echo $strings['Confirmación de borrado'];?></legend>  
            <!--Contenedor con botones de adición y búsqueda  -->
                    <table class="tab-twocol shadow showtable delete">
                    </thead>
                    <tr>
                        <th><?php echo $strings['Descripción'];?></th>
                        <td><?php echo $datos['desc_tar']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Creador'];?></th>
                        <td><?php echo $datos['creador_tar']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Fecha'];?></th>
                        <td><?php echo $datos['fecha_tar']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Prioridad'];?></th>
                        <td style="background-color:<?php echo $datos['codcolor_pri']; ?>"><?php echo $datos['nom_pri']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Categoría'];?></th>
                        <td><?php echo $datos['nom_cat']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Estado'];?></th>
                        <td><?php echo $datos['estado_tar']; ?></td>
                    </tr>
                </table>
            <div class="container-showall-btn">
                <p><?php echo $strings['¿Confirma el borrado de esta categoría?'];?><p>
                <form id="delete"action='./Tarea_Controller.php?accion=delete&param=<?php echo $datos['id_tar'];?>' method='post'>
                <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                <button class="form-btn" type="button" role="link" onclick="window.location='./Tarea_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ShowCurrent

?>