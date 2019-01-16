<?php
/**
 * Clase para realizar el SHOWALL en Fase, recibe una o varias tuplas para mostrar
 *	autor:  Juan Márquez 
 *	15/12/2018 
 */
	class Fase_SHOWALL{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
<div class="col-md-2"></div>
<div class="col-md-8 table-responsive contenido">
    <fieldset id="showall">
        <legend><?php echo $strings['Fases'];?></legend>  
    
        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=SEARCH'"><i class="fas fa-search"></i> 
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=ADD'"><i class="fas fa-plus"></i>
        </div>
        <table>
        <thead>
        <tr>
                <!-- Títulos de tabla -->
                <th><?php echo $strings['Descripción'];?></th>
                <th><?php echo $strings['Fecha'];?></th>
                <th><?php echo $strings['Estado'];?></th>
                <th colspan="3"><?php echo $strings['Acción'];?></th>
        </tr>
        </thead>
            <tr>
            <?php if(count($datos, COUNT_RECURSIVE)!= 12){
                    foreach($datos as $datos) :
                    ?>
                    <td><?php echo $datos['desc_fas']."\n"; ?></td>
                    <td><?php echo $datos['fecha_fas']."\n"; ?></td>
                    <td><?php echo $datos['estado_fas']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=EDIT&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=DELETE&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php endforeach;}else{?>
                <td><?php echo $datos['desc_fas']."\n"; ?></td>
                    <td><?php echo $datos['fecha_fas']."\n"; ?></td>
                    <td><?php echo $datos['estado_fas']."\n"; ?></td>



                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=EDIT&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=DELETE&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php };?>


            </table>
        <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
        <div class="container-btn">
            <button class="form-btn" role="link" onclick="window.location='./Index_Controller.php';"><i class="fas fa-arrow-left"></i>
        </div>
    </fieldset>
               
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin Search

?>