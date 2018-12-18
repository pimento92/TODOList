<?php
/**
 * Clase para realizar el SHOWCURRENT en Tarea, recibe una tupla para mostrar
 *	autor:  Juan Márquez 
 *	15/12/2018 
 */
	class Tarea_SHOWCURRENT{


		function __construct($datost, $datosf, $datosc, $datosa){	
			$this->render($datost, $datosf, $datosc, $datosa);
		}

		function render($datost, $datosf, $datosc, $datosa){
            include '../Views/Header.php';?>
            <div class="col-md-2"></div>
    <div class="col-md-8 contenido articulo">
    <fieldset class="sc">
            <legend><?php echo $strings['Datos de tarea'];?></legend>  
            <!-- Foto de perfil -->
            <!--Contenedor con botones de adición y búsqueda  -->
                    <table class="tab-twocol shadow showtable">
                    <thead>
                    <tr>
                        <th><?php echo $strings['Atributo'];?></th>
                        <th><?php echo $strings['Valor'];?></th>
                    </tr>
                    </thead>
                    <tr>
                        <th><?php echo $strings['Descripción'];?></th>
                        <td><?php echo $datost['desc_tar']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Creador'];?></th>
                        <td><?php echo $datost['creador_tar']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Fecha'];?></th>
                        <td><?php echo $datost['fecha_tar']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Prioridad'];?></th>
                        <td style="background-color:<?php echo $datost['codcolor_pri']; ?>"><?php echo $datost['nom_pri']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Categoría'];?></th>
                        <td><?php echo $datost['nom_cat']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Estado'];?></th>
                        <td><?php echo $datost['estado_tar']; ?></td>
                    </tr>
                </table>
                <!-- Mostrar las fases creadas de la tarea -->
                <legend><?php echo $strings['Fases'];?></legend>
                <?php  if(is_string($datosf)){?>
                <p href=""><?php echo $strings[$datosf];?></a>
                <?php }else{?>
        <table>
        <thead>
        <tr>
                <!-- Títulos de tabla -->
                <th><?php echo $strings['Descripción'];?></th>
                <th><?php echo $strings['Fecha'];?></th>
                <th><?php echo $strings['Estado'];?></th>
                <th colspan="7"><?php echo $strings['Acción'];?></th>
        </tr>
        </thead>
            <tr>

            <?php if(count($datosf, COUNT_RECURSIVE)!= 5){
                    foreach($datosf as $datos) :
                    ?>
                    <td><?php echo $datos['desc_fas']."\n"; ?></td>
                    <td><?php echo $datos['fecha_fas']."\n"; ?></td>
                    <td><?php echo $datos['estado_fas']."\n"; ?></td>


                <!-- Botones de opción de cada fila -->
                <td class="n mini"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=CLOSE&param=<?php echo $datos['id_fas']?>&param2=<?php echo $datost['id_tar'];?>'"><i class="fas fa-times"></i></button></td>
                <td class="n"><button class="editbtn" role="link" onclick="window.location='../Controllers/Posee_Controller.php?accion=SHOWALL&param=<?php echo $datos['id_fas']?>&param2=<?php echo $datost['id_tar'];?>'"><i class="fas fa-user"></i></button></td>
                <td class="n"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=DELETE&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-file"></i></button></td>
                <td class="n mini"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=EDIT&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="n mini"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=DELETE&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-trash-alt"></i></button></td>


            </tr>
            <?php endforeach;}else{?>
                <td><?php echo $datos['desc_fas']."\n"; ?></td>
                    <td><?php echo $datos['fecha_fas']."\n"; ?></td>
                    <td><?php echo $datos['estado_fas']."\n"; ?></td>



                <!-- Botones de opción de cada fila -->
                <td class="n"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=CLOSE&param=<?php echo $datos['id_fas']?>&param2=<?php echo $datost['id_tar'];?>"><i class="fas fa-times"></i></button></td>
                <td class="n"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=EDIT&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-user"></i></button></td>
                <td class="n"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=DELETE&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-file"></i></button></td>
                <td class="n mini"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=EDIT&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-pencil-alt"></i></button></td>
                <td class="n mini"><button class="editbtn" role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=DELETE&param=<?php echo $datos['id_fas']?>';"><i class="fas fa-trash-alt"></i></button></td>


 
            </tr>
            <?php }};?>
            </table>
            <div class="container-showall-btn">

<button class="form-btn " role="link" onclick="window.location='../Controllers/Fase_Controller.php?accion=ADD&param=<?php echo $datost['id_tar'];?>'"><i class="mini fas fa-plus"></i>
</div>
<!-- Mostrar contactos asignados a las fases de la tarea -->
            <legend><?php echo $strings['Contactos'];?></legend>
            <?php if(is_string($datosc)){?>
                <p href=""><?php echo $strings[$datosc];?></a>
            <?php }else{
             if(count($datosc, COUNT_RECURSIVE)!= 1){
                    foreach($datosc as $datos) :
                    ?>
                    <li><?php echo $datos['nom_con']."\n"; ?></li>
            <?php endforeach;}else{?>
                <li><?php echo $datosc['nom_con']."\n"; ?></li>
            <?php }}?>

<!-- Mostrar archivos adjuntos a las fases de la tarea -->
            <legend><?php echo $strings['Archivos'];?></legend>
            <?php if(is_string($datosa)){?>
                <p href=""><?php echo $strings[$datosa];?></a>
            <?php }else{
             if(count($datosa, COUNT_RECURSIVE)!= 1){
                    foreach($datosa as $datos) :
                    ?>
                    <li><?php echo $datos['url_arch']."\n"; ?></li>
            <?php endforeach;}else{?>
                <li><?php echo $datosa['url_arch']."\n"; ?></li>
            <?php }}?>
            <div class="container-showall-btn">
                <button class="form-btn" type="button" role="link" onclick="window.location='./Tarea_Controller.php?accion=SHOWALL'"><i class="fas fa-arrow-left"></i>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ShowCurrent

?>