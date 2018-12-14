<?php
/**
 * Clase para realizar el SHOWALL en Contacto, recibe una o varias tuplas para mostrar
 *	autor:  Juan Márquez 
 *	12/12/2018 
 */
	class Contacto_SHOWALL{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
<div class="col-md-3"></div>
<div class="col-md-6 contenido articulo">
    <fieldset id="showall">
        <legend><?php echo $strings['Contactos'];?></legend>  
    
        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Contacto_Controller.php?accion=SEARCH'"><i class="fas fa-search"></i> 
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Contacto_Controller.php?accion=ADD'"><i class="fas fa-plus"></i>
        </div>
        <table>
        <thead>
        <tr>
                <!-- Títulos de tabla -->
                <th><?php echo $strings['E-mail'];?></th>
                <th><?php echo $strings['Nombre'];?></th>
                <th><?php echo $strings['Descripción'];?></th>
                <th><?php echo $strings['Teléfono'];?></th>
                <th colspan="3"><?php echo $strings['Acción'];?></th>
        </tr>
        </thead>

            <tr>
            <?php if(count($datos, COUNT_RECURSIVE)!= 4){
                    foreach($datos as $datos) :
                    ?>
                    <td><?php echo $datos['email_con']."\n"; ?></td>
                <td><?php echo $datos['nom_con']."\n"; ?></td>
                <td><?php echo $datos['desc_con']."\n"; ?></td>
                <td><?php echo $datos['telf_con']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Contacto_Controller.php?accion=EDIT&param=<?php echo $datos['email_con']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Contacto_Controller.php?accion=DELETE&param=<?php echo $datos['email_con']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Contacto_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['email_con']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php endforeach;}else{?>
                <td><?php echo $datos['email_con']."\n"; ?></td>
                <td><?php echo $datos['nom_con']."\n"; ?></td>
                <td><?php echo $datos['desc_con']."\n"; ?></td>
                <td><?php echo $datos['telf_con']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Contacto_Controller.php?accion=EDIT&param=<?php echo $datos['email_con']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Contacto_Controller.php?accion=DELETE&param=<?php echo $datos['email_con']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Contacto_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['email_con']?>';"><i class="fas fa-eye"></i></button></td>
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