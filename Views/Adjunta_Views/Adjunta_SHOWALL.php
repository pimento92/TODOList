<?php
/**
 * Clase para realizar el SHOWALL en Adjunta, recibe una o varias tuplas para mostrar
 *	autor:  Juan Márquez 
 *	17/12/2018 
 */
	class Adjunta_SHOWALL{


		function __construct($datos, $clavet, $clavef){	
			$this->render($datos, $clavet, $clavef);
		}

		function render($datos, $clavet, $clavef){
            include '../Views/Header.php';?>
<div class="col-md-3"></div>
<div class="col-md-5 contenido articulo">
    <fieldset id="showall">
        <legend><?php echo $strings['Archivos'];?></legend>  
    
        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Adjunta_Controller.php?accion=ADD&param=<?php echo $clavet;?>&param2=<?php echo $clavef;?>'"><i class="fas fa-plus"></i>
        </div>
        <?php if(is_string($datos)){
            echo $datos;
        }else{?>
        <table>
        <thead>
        <tr>
            
                <!-- Títulos de tabla -->
                <th><?php echo $strings['Descripción'];?></th>
                <th>URL</th>
                <th colspan="2"><?php echo $strings['Acción'];?></th>
        </tr>
        </thead>

            <tr>
        <?php 
                    if(count($datos, COUNT_RECURSIVE)!= 4){
                    foreach($datos as $datos) :
                    ?>
                    <td><?php echo $datos['desc_arch']."\n"; ?></td>
                    <td><?php echo $datos['url_arch']."\n"; ?></td>

                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Adjunta_Controller.php?accion=DELETE&param=<?php echo $clavet;?>&param2=<?php echo $clavef;?>&param3=<?php echo $datos['id_arch'];?>';"><i class="fas fa-times"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Files/Attached_files/<?php echo $datos['url_arch']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php endforeach;}else{?>
                <td><?php echo $datos['desc_arch']."\n"; ?></td>
                    <td><?php echo $datos['url_arch']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Adjunta_Controller.php?accion=DELETE&param=<?php echo $clavet;?>&param2=<?php echo $clavef;?>&param3=<?php echo $datos['id_arch'];?>';"><i class="fas fa-times"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Files/Attached_files/<?php echo $datos['url_arch']?>';"><i class="fas fa-eye"></i></button></td>

            <?php }}?>

             

            </table>

        <!-- Contenedor de los iconos:volver-->
        <div class="container-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $clavet;?>';"><i class="fas fa-arrow-left"></i>
        </div>
    </fieldset>
               
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin Search

?>