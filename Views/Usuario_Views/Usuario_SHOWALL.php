<?php
/**
 * Clase para realizar el SHOWALL en Usuario, recibe una o varias tuplas para mostrar
 *	autor:  Juan Márquez 
 *	13/12/2018 
 */
	class Usuario_SHOWALL{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
<div class="col-md-2"></div>
<div class="col-md-8 table-responsive contenido">
    <fieldset id="showall">
        <legend><?php echo $strings['Usuarios'];?></legend>  
    
        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Usuario_Controller.php?accion=SEARCH'"><i class="fas fa-search"></i> 
            <button class="form-btn" role="link" onclick="window.location='../Controllers/Usuario_Controller.php?accion=ADD'"><i class="fas fa-plus"></i>
        </div>
        <table>
        <thead>
        <tr>
                <!-- Títulos de tabla -->
                <th><?php echo $strings['Nombre'];?></th>
                <th><?php echo $strings['Apellidos'];?></th>
                <th><?php echo $strings['Teléfono'];?></th>
                <th><?php echo $strings['E-mail'];?></th>
                <th><?php echo $strings['Contraseña'];?></th>
                <th><?php echo $strings['Fecha de nacimiento'];?></th>
                <th><?php echo $strings['Tipo'];?></th>
                <th colspan="3"><?php echo $strings['Acción'];?></th>
        </tr>
        </thead>

            <tr>
            <?php if(count($datos, COUNT_RECURSIVE)!= 7){
                    foreach($datos as $datos) :
                    ?>
                    <td><?php echo $datos['nom_usr']."\n"; ?></td>
                <td><?php echo $datos['apel_usr']."\n"; ?></td>
                <td><?php echo $datos['telf_usr']."\n"; ?></td>
                <td><?php echo $datos['email_usr']."\n"; ?></td>
                <td><?php echo $datos['pass_usr']."\n"; ?></td>
                <td><?php echo $datos['fechna_usr']."\n"; ?></td>
                <td><?php echo $datos['tipo_usr']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Usuario_Controller.php?accion=EDIT&param=<?php echo $datos['email_usr']?>';"><i class="fas fa-pencil-alt"></i></button></td>

                <?php if($datos['email_usr'] == $_SESSION['email']){?>

                <td class="tb-btn disable"><button class="editbtn disable" role="link" ><i class="fas fa-trash-alt"></i></button></td>
                <?php }else{?>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Usuario_Controller.php?accion=DELETE&param=<?php echo $datos['email_usr']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <?php }?>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Usuario_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['email_usr']?>';"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php endforeach;}else{?>
                <td><?php echo $datos['nom_usr']."\n"; ?></td>
                <td><?php echo $datos['apel_usr']."\n"; ?></td>
                <td><?php echo $datos['telf_usr']."\n"; ?></td>
                <td><?php echo $datos['email_usr']."\n"; ?></td>
                <td><?php echo $datos['pass_usr']."\n"; ?></td>
                <td><?php echo $datos['fechna_usr']."\n"; ?></td>
                <td><?php echo $datos['tipo_usr']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn"><button class="editbtn" role="link" ><i class="fas fa-pencil-alt"></i></button></td>
                <?php if($datos['email_usr'] == $_SESSION['email']){?>

                <td class="tb-btn disable"><button class="editbtn disable" role="link" onclick="window.location='../Controllers/Usuario_Controller.php?accion=DELETE&param=<?php echo $datos['email_usr']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <?php }else{?>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Usuario_Controller.php?accion=DELETE&param=<?php echo $datos['email_usr']?>';"><i class="fas fa-trash-alt"></i></button></td>
                <?php }?>
                <td class="tb-btn"><button class="editbtn" role="link" onclick="window.location='../Controllers/Usuario_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['email_usr']?>';"><i class="fas fa-eye"></i></button></td>
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