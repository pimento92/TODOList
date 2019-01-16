<?php
/**
 * Clase para realizar el DELETE en Fase, recibe una tupla para mostrar y eliminar
 *	autor:  Juan Márquez 
 *	24/12/2018 
 */
	class Fase_DELETE{


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
                    </thead>
                    <tr>
                        <th><?php echo $strings['Descripción'];?></th>
                        <td><?php echo $datos['desc_fas']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Fecha'];?></th>
                        <td><?php echo $datos['fecha_fas']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Estado'];?></th>
                        <td><?php echo $datos['estado_fas']; ?></td>
                    </tr>
                </table>
            <div class="container-showall-btn">
                <p><?php echo $strings['¿Confirma el borrado de esta fase?'];?><p>
                <form id="delete"action='./Fase_Controller.php?accion=delete&param=<?php echo $datos['tarea_fas'];?>&param2=<?php echo $datos['id_fas'];?>' method='post'>
                <button name="submit" class="form-btn" type="submit"><i class="fas fa-check"></i></button>
                <button class="form-btn" type="button" role="link" onclick="window.location='./Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['tarea_fas'];?>'"><i class="fas fa-times"></i></button>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ShowCurrent

?>