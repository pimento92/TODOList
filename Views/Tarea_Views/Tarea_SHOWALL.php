<?php
/**
 * Clase para realizar el SHOWALL en Tarea, recibe una o varias tuplas para mostrar
 *	autor:  Juan Márquez 
 *	14/12/2018 
 */
	class Tarea_SHOWALL{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
<div class="col-md-2"></div>
<div class="col-md-8 contenido articulo">
    <fieldset id="showall">
        <legend><?php echo $strings['Tareas'];?></legend>  
    
        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=SEARCH'"><i class="fas fa-search"></i> 
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=ADD'"><i class="fas fa-plus"></i>
        </div>
        <table>
        <thead>
        <tr>
                <!-- Títulos de tabla -->
                <th><?php echo $strings['Prioridad'];?></th>
                <th><?php echo $strings['Categoría'];?></th>
                <th><?php echo $strings['Descripción'];?></th>
                <th><?php echo $strings['Fecha'];?></th>
                <th><?php echo $strings['Creador'];?></th>
                <th><?php echo $strings['Estado'];?></th>
                <th colspan="4"><?php echo $strings['Acción'];?></th>
        </tr>
        </thead>
            <?php if ($_SESSION['tipo'] == 'ADMIN'){?>
            <tr>
            <?php if(count($datos, COUNT_RECURSIVE)!= 14){
                    foreach($datos as $datos) :
                    ?>
                    <td style="background-color:<?php echo $datos['codcolor_pri']."\n"; ?>"><?php echo $datos['nom_pri']; ?></td>
                <td><?php echo $datos['nom_cat']."\n"; ?></td>
                <td><?php echo $datos['desc_tar']."\n"; ?></td>
                <td><?php echo $datos['fecha_tar']."\n"; ?></td>
                <td><?php echo $datos['creador_tar']."\n"; ?></td>
                <td><?php echo $datos['estado_tar']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=SHOWALL&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-list-ul"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=EDIT&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=DELETE&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php endforeach;}else{?>
                <td style="background-color:<?php echo $datos['codcolor_pri']."\n"; ?>"><?php echo $datos['nom_pri']; ?></td>
                <td><?php echo $datos['nom_cat']."\n"; ?></td>
                <td><?php echo $datos['desc_tar']."\n"; ?></td>
                <td><?php echo $datos['fecha_tar']."\n"; ?></td>
                <td><?php echo $datos['creador_tar']."\n"; ?></td>
                <td><?php echo $datos['estado_tar']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=SHOWALL&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-list-ul"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=EDIT&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=DELETE&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php };?>

            <?php }else{?>
                <tr>
            <?php if(count($datos, COUNT_RECURSIVE)!= 14){
                    foreach($datos as $datos) :
                     if ($datos['creador_tar'] == $_SESSION['email']){?>
                    <td style="background-color:<?php echo $datos['codcolor_pri']."\n"; ?>"><?php echo $datos['nom_pri']; ?></td>
                <td><?php echo $datos['nom_cat']."\n"; ?></td>
                <td><?php echo $datos['desc_tar']."\n"; ?></td>
                <td><?php echo $datos['fecha_tar']."\n"; ?></td>
                <td><?php echo $datos['creador_tar']."\n"; ?></td>
                <td><?php echo $datos['estado_tar']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=SHOWALL&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-list-ul"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=EDIT&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=DELETE&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php } endforeach;}else{
                if ($datos['creador_tar'] == $_SESSION['email']){ ?>
                <td style="background-color:<?php echo $datos['codcolor_pri']."\n"; ?>"><?php echo $datos['nom_pri']; ?></td>
                <td><?php echo $datos['nom_cat']."\n"; ?></td>
                <td><?php echo $datos['desc_tar']."\n"; ?></td>
                <td><?php echo $datos['fecha_tar']."\n"; ?></td>
                <td><?php echo $datos['creador_tar']."\n"; ?></td>
                <td><?php echo $datos['estado_tar']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=SHOWALL&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-list-ul"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=EDIT&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=DELETE&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php }};?>
            <?php } ?>
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