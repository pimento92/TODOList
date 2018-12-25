<?php
/**
 * Clase para realizar el SHOWCURRENT en Fase, recibe una tupla para mostrar
 *	autor:  Juan Márquez 
 *	24/12/2018 
 */
	class Fase_SHOWCURRENT{


		function __construct($datos, $datosc, $datosa){	
			$this->render($datos, $datosc, $datosa);
		}

		function render($datos, $datosc, $datosa){
            include '../Views/Header.php';?>
            <div class="col-md-2"></div>
    <div class="col-md-8 contenido articulo">
    <fieldset class="sc">
            <legend><?php echo $strings['Datos de fase'];?></legend>  
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
               
<!-- Mostrar contactos asignados a las fases de la Fase -->
            <legend><?php echo $strings['Contactos'];?></legend>
            <?php if(is_string($datosc)){?>
                <p href=""><?php echo $strings[$datosc];?></a>
            <?php }else{
             if(count($datosc, COUNT_RECURSIVE)!= 1){
                    foreach($datosc as $datos) :
                    ?>
                    <li><a href="../Controllers/Contacto_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['email_con'];?>"><?php echo $datos['nom_con']."\n"; ?></a></li>
            <?php endforeach;}else{?>
                <li><a href="../Controllers/Contacto_Controller.php?accion=SHOWCURRENT&param=<?php echo $datosc['email_con'];?>"><?php echo $datosc['nom_con']."\n"; ?></a></li>
            <?php }}?>

<!-- Mostrar archivos adjuntos a las fases de la Fase -->
            <legend><?php echo $strings['Archivos'];?></legend>
            <?php if(is_string($datosa)){?>
                <p href=""><?php echo $strings[$datosa];?></a>
            <?php }else{
             if(count($datosa, COUNT_RECURSIVE)!= 1){
                    foreach($datosa as $datos) :
                    ?>
                    <li><a href="../Files/Attached_files/<?php echo $datos['url_arch'];?>"><?php echo $datos['desc_arch']."\n"; ?></a></li>
            <?php endforeach;}else{?>
                <li><a href="../Files/Attached_files/<?php echo $datosa['url_arch'];?>"><?php echo $datosa['desc_arch']."\n"; ?></a></li>
            <?php }}?>
            <div class="container-showall-btn">
                <button class="form-btn" type="button" role="link" onclick="window.location='./Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['tarea_fas']; ?>'"><i class="fas fa-arrow-left"></i>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ShowCurrent

?>