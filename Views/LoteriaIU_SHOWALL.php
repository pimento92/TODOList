<?php
/**
 * Clase para realizar el SHOWALL en loteriaIU, recibe una o varias tuplas para mostrar
 *	autor:  t45qxz 
 *	12/11/2018 
 */
	class LoteriaIU_SHOWALL{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>

<div class="col-md-12 contenido articulo">
    <fieldset id="showall">
        <legend><?php echo $strings['Resultados de búsqueda'];?></legend>  
    
        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/LoteriaIU_Controller.php?accion=SEARCH'"><i class="fas fa-search"></i> 
            <button class="form-btn" role="link" onclick="window.location='../Controllers/LoteriaIU_Controller.php?accion=ADD'"><i class="fas fa-plus"></i>
        </div>
        <table class="shadow">
        <thead>
        <tr>
                <!-- Títulos de tabla -->
                <th>E-mail</th>
                <th><?php echo $strings['Nombre'];?></th>
                <th><?php echo $strings['Apellidos'];?></th>
                <th><?php echo $strings['Participación'];?></th>
                <th><?php echo $strings['Ingresado'];?></th>
                <th><?php echo $strings['Pagado'];?></th>
                <th colspan="3"><?php echo $strings['Acción'];?></th>
        </tr>
        </thead>

            <tr>
            <?php $number = count($datos);
                if(count($datos, COUNT_RECURSIVE)!= 8){
                    foreach($datos as $datos) :?>
                <td><?php echo $datos['lot.email']."\n"; ?></td>
                <td><?php echo $datos['lot.nombre']."\n"; ?></td>
                <td><?php echo $datos['lot.apellidos']."\n"; ?></td>
                <td><?php echo $datos['lot.participacion']."\n"; ?></td>
                <td><?php echo $datos['lot.ingresado']."\n"; ?></td>
                <td><?php echo $datos['lot.pagado']."\n"; ?></td>

                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/LoteriaIU_Controller.php?accion=EDIT&param=<?php echo $datos['lot.email']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/LoteriaIU_Controller.php?accion=DELETE&param=<?php echo $datos['lot.email']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/LoteriaIU_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['lot.email']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php endforeach;?>
            </table>
            <p><small><?php echo $strings['Se han encontrado']." ".$number. " " . $strings['coincidencias'];?></small></p>
            <?php }else{ ?>

                <td><?php echo $datos['lot.email']."\n"; ?></td>
                <td><?php echo $datos['lot.nombre']."\n"; ?></td>
                <td><?php echo $datos['lot.apellidos']."\n"; ?></td>
                <td><?php echo $datos['lot.participacion']."\n"; ?></td>
                <td><?php echo $datos['lot.ingresado']."\n"; ?></td>
                <td><?php echo $datos['lot.pagado']."\n"; ?></td>
                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/LoteriaIU_Controller.php?accion=EDIT&param=<?php echo $datos['lot.email']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/LoteriaIU_Controller.php?accion=DELETE&param=<?php echo $datos['lot.email']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/LoteriaIU_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['lot.email']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            </table>
                <?php  };?>

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