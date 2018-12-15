<?php
/**
 * Clase para realizar el SHOWALL en Categoria, recibe una o varias tuplas para mostrar
 *	autor:  t45qxz 
 *	12/11/2018 
 */
	class Categoria_SHOWALL{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
<div class="col-md-4"></div>
<div class="col-md-4 contenido articulo">
    <fieldset id="showall">
        <legend><?php echo $strings['Categorías'];?></legend>  
    
        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Categoria_Controller.php?accion=SEARCH'"><i class="fas fa-search"></i> 
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Categoria_Controller.php?accion=ADD'"><i class="fas fa-plus"></i>
        </div>
        <table>
        <thead>
        <tr>
                <!-- Títulos de tabla -->
                <th><?php echo $strings['Nombre'];?></th>
                <th><?php echo $strings['Descripción'];?></th>
                <th colspan="3"><?php echo $strings['Acción'];?></th>
        </tr>
        </thead>

            <tr>
            <?php if(count($datos, COUNT_RECURSIVE)!= 3){
                    foreach($datos as $datos) :
                    ?>

                <?php if($datos['nom_cat'] == 'SIN CATEGORÍA'){?>
                    <td><?php echo $strings[$datos['nom_cat']]."\n"; ?></td>
                    <td><?php echo $strings[$datos['desc_cat']]."\n"; ?></td>
                <?php }else{?>
                    <td><?php echo $datos['nom_cat']."\n"; ?></td>
                    <td><?php echo $datos['desc_cat']."\n"; ?></td>
                <?php }?>


                <?php if($datos['nom_cat'] == 'SIN CATEGORÍA'){?>

                <td class="tb-btn disable"><button class="editbtn disable" role="link"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn disable"><button class="editbtn disable" role="link"><i class="fas fa-trash-alt"></i></button></td>
                <?php }else{?>
                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Categoria_Controller.php?accion=EDIT&param=<?php echo $datos['id_cat']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Categoria_Controller.php?accion=DELETE&param=<?php echo $datos['id_cat']?>';"><i class="fas fa-trash-alt"></i></button></td>
                

                <?php }?>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Categoria_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_cat']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php endforeach;}else{?>
                <?php if($datos['nom_cat'] == 'SIN CATEGORÍA'){?>
                    <td><?php echo $strings[$datos['nom_cat']]."\n"; ?></td>
                    <td><?php echo $strings[$datos['desc_cat']]."\n"; ?></td>
                <?php }else{?>
                    <td><?php echo $datos['nom_cat']."\n"; ?></td>
                    <td><?php echo $datos['desc_cat']."\n"; ?></td>
                <?php }?>


                <?php if($datos['nom_cat'] == 'SIN CATEGORÍA'){?>

                <td class="tb-btn disable"><button class="editbtn disable" role="link"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn disable"><button class="editbtn disable" role="link"><i class="fas fa-trash-alt"></i></button></td>
                <?php }else{?>
                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Categoria_Controller.php?accion=EDIT&param=<?php echo $datos['id_cat']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Categoria_Controller.php?accion=DELETE&param=<?php echo $datos['id_cat']?>';"><i class="fas fa-trash-alt"></i></button></td>
                

                <?php }?>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Categoria_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_cat']?>';"><i class="fas fa-eye"></i></button></td>
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