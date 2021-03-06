<?php
/**
 * Clase para realizar el SHOWALL en Tarea, recibe una o varias tuplas para mostrar
 *	autor:  Juan Márquez 
 *	14/12/2018 
 */
	class Tarea_SHOWALL{


		function __construct($datos, $contfas, $contcon, $contarch, $orden){	
			$this->render($datos, $contfas, $contcon, $contarch, $orden);
		}

		function render($datos, $contfas, $contcon, $contarch, $orden){
            include '../Views/Header.php';?>
<div class="col-md-2"></div>
<div class="container-fluid contenido ">
    <fieldset id="showall">
        <legend>
            <?php echo $strings['Tareas abiertas'];?>
        </legend>

        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn d-flex align-items-baseline ">
            <div class="row">
                <div class="col-md-4">
                    <button class="form-btn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=SEARCH'"><i
                            class="fas fa-search"></i>               
                    <button class="form-btn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=ADD'"><i
                            class="fas fa-plus"></i></button>
                </div>                
                                  
                <div class="col-md-8">
                <?php if ($_SERVER['REQUEST_URI'] != '/todolist/Controllers/Tarea_Controller.php?accion=SEARCH'){?>
                    <div class="ml-auto">
                        <p><b>
                                <?php echo $strings['Ordenar por:'];?> &nbsp &nbsp</b><a <?php if ($orden=='fecha' ){
                                echo 'class="activo"' ;}?>href="./Tarea_Controller.php?accion=SHOWALL&param=fecha">
                                <?php echo $strings['Fecha de alta'];?></a> | <a <?php if ($orden=='prioridad' ){ echo
                                'class="activo"' ;}?>href="./Tarea_Controller.php?accion=SHOWALL&param=prioridad">
                                <?php echo $strings['Prioridad'];?></a> | <a <?php if ($orden=='categoria' ){ echo
                                'class="activo"' ;}?> href="./Tarea_Controller.php?accion=SHOWALL&param=categoria">
                                <?php echo $strings['Categoría'];?></a></p>
                    </div>
                    <?php }?>
                </div>
            </div>





        </div>
        <div class="table-responsive">


            <table class="table">
                <thead>
                    <tr>
                        <!-- Títulos de la -->
                        <th>
                            <?php echo $strings['Categoría'];?>
                        </th>
                        <th>
                            <?php echo $strings['Descripción'];?>
                        </th>
                        <th>
                            <?php echo $strings['Fases'];?>
                        </th>
                        <th>
                            <?php echo $strings['Contactos'];?>
                        </th>
                        <th>
                            <?php echo $strings['Archivos'];?>
                        </th>
                        <th colspan="4">
                            <?php echo $strings['Acción'];?>
                        </th>
                    </tr>
                </thead>
                <tr>
                    <?php  $datos2 = $datos;
            if ($_SESSION['tipo'] == 'ADMIN'){?>
                    <?php if(count($datos, COUNT_RECURSIVE)!= 14){
                    foreach($datos as $datos) : 
                    if ($datos['estado_tar'] == 'ABIERTA'){?>


                    <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                        style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;">
                        <?php echo $datos['nom_cat']."\n"; ?>
                    </td>
                    <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>'"
                        style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;">
                        <?php echo $datos['desc_tar']."\n"; ?>
                    </td>

                    <!-- Comprobamos si tiene fases -->
                    <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contfas as $fases) : 
                            if ($fases['id_tar'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                    <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                        style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                        <?php echo $auxarray."\n"; ?>
                    </td>
                    <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contcon as $contactos) : 
                            if ($contactos['tarea'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                    <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                        style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                        <?php echo $auxarray."\n"; ?>
                    </td>
                    <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contarch as $archivos) : 
                            if ($archivos['tarea'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                    <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                        style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                        <?php echo $auxarray."\n"; ?>
                    </td>

                    <!-- Botones de opción de cada fila -->
                    <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button
                            class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=CLOSE&param=<?php echo $datos['id_tar'];?>';"><i
                                class="fas fa-times"></i></button></td>
                    <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button
                            class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=EDIT&param=<?php echo $datos['id_tar'];?>';"><i
                                class="fas fa-pencil-alt"></i></button></td>
                    <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button
                            class="editbtn" role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=DELETE&param=<?php echo $datos['id_tar'];?>';"><i
                                class="fas fa-trash-alt"></i></button></td>

                </tr>
                <?php } endforeach;}else{ ?>

                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;">
                    <?php echo $datos['nom_cat']."\n"; ?>
                </td>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;;">
                    <?php echo $datos['desc_tar']."\n"; ?>
                </td>

                <!-- Comprobamos si tiene fases -->
                <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contfas as $fases) : 
                            if ($fases['id_tar'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contcon as $contactos) : 
                            if ($contactos['tarea'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contarch as $archivos) : 
                            if ($archivos['tarea'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                    <?php echo $auxarray."\n"; ?>
                </td>

                <!-- Botones de opción de cada fila -->
                <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button class="editbtn"
                        role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=CLOSE&param=<?php echo $datos['id_tar']?>';"><i
                            class="fas fa-times"></i></button></td>
                <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button class="editbtn"
                        role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=EDIT&param=<?php echo $datos['id_tar']?>';"><i
                            class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button class="editbtn"
                        role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=DELETE&param=<?php echo $datos['id_tar']?>';"><i
                            class="fas fa-trash-alt"></i></button></td>
                </tr>
                <?php }?>

                <?php }else{?>
                <?php   if(count($datos, COUNT_RECURSIVE)!= 14){
                    foreach($datos as $datos) :
                     if ($datos['creador_tar'] == $_SESSION['email']){
                        if ($datos['estado_tar'] == 'ABIERTA'){?>

                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;">
                    <?php echo $datos['nom_cat']."\n"; ?>
                </td>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;;">
                    <?php echo $datos['desc_tar']."\n"; ?>
                </td>

                <!-- Comprobamos si tiene fases -->
                <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contfas as $fases) : 
                            if ($fases['id_tar'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contcon as $contactos) : 
                            if ($contactos['tarea'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contarch as $archivos) : 
                            if ($archivos['tarea'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                    <?php echo $auxarray."\n"; ?>
                </td>

                <!-- Botones de opción de cada fila -->
                <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button class="editbtn"
                        role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=CLOSE&param=<?php echo $datos['id_tar']?>';"><i
                            class="fas fa-times"></i></button></td>
                <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button class="editbtn"
                        role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=EDIT&param=<?php echo $datos['id_tar']?>';"><i
                            class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button class="editbtn"
                        role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=DELETE&param=<?php echo $datos['id_tar']?>';"><i
                            class="fas fa-trash-alt"></i></button></td>
                </tr>
                <?php }}endforeach;}else{
                ?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;">
                    <?php echo $datos['nom_cat']."\n"; ?>
                </td>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;;">
                    <?php echo $datos['desc_tar']."\n"; ?>
                </td>

                <!-- Comprobamos si tiene fases -->
                <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contfas as $fases) : 
                            if ($fases['id_tar'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contcon as $contactos) : 
                            if ($contactos['tarea'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                        foreach($contarch as $archivos) : 
                            if ($archivos['tarea'] == $datos['id_tar']){ 
                                $array[$cont]='SI';
                            }else{
                                $array[$cont]='NO';
                            }
                            $cont++;
                        endforeach;
                        foreach ($array as $opt) :
                            if ($opt == 'SI'){
                                $auxarray = 'SI';
                            }
                        endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'"
                    style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>">
                    <?php echo $auxarray."\n"; ?>
                </td>


                <!-- Botones de opción de cada fila -->
                <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button class="editbtn"
                        role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=CLOSE&param=<?php echo $datos['id_tar']?>';"><i
                            class="fas fa-times"></i></button></td>
                <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button class="editbtn"
                        role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=EDIT&param=<?php echo $datos['id_tar']?>';"><i
                            class="fas fa-pencil-alt"></i></button></td>
                <td class="tb-btn" style="background-color:<?php echo $datos['codcolor_pri']." \n"; ?>;"><button class="editbtn"
                        role="link" onclick="window.location='../Controllers/Tarea_Controller.php?accion=DELETE&param=<?php echo $datos['id_tar']?>';"><i
                            class="fas fa-trash-alt"></i></button></td>
                </tr>
                <?php };?>
                <?php } ?>
            </table>
        </div>




        <!-- /////////////////////////////////////////////////CERRADAS///////////////////////////////////////////////////////// -->




        <!-- Tabla para tareas cerradas-->
        <legend>
            <?php echo $strings['Tareas cerradas'];?>
        </legend>

        <!--Contenedor con botones de adición y búsqueda  -->
        <div class="container-showall-btn">
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <!-- Títulos de la -->
                        <th>
                            <?php echo $strings['Categoría'];?>
                        </th>
                        <th>
                            <?php echo $strings['Descripción'];?>
                        </th>
                        <th>
                            <?php echo $strings['Fases'];?>
                        </th>
                        <th>
                            <?php echo $strings['Contactos'];?>
                        </th>
                        <th>
                            <?php echo $strings['Archivos'];?>
                        </th>
                    </tr>
                </thead>
                <tr>
                    <?php if ($_SESSION['tipo'] == 'ADMIN'){?>
                    <?php if(count($datos2, COUNT_RECURSIVE)!= 14){
                foreach($datos2 as $datos) : 
                if ($datos['estado_tar'] == 'CERRADA'){?>


                    <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'">
                        <?php echo $datos['nom_cat']."\n"; ?>
                    </td>
                    <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>'">
                        <?php echo $datos['desc_tar']."\n"; ?>
                    </td>

                    <!-- Comprobamos si tiene fases -->
                    <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contfas as $fases) : 
                        if ($fases['id_tar'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                    <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'">
                        <?php echo $auxarray."\n"; ?>
                    </td>
                    <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contcon as $contactos) : 
                        if ($contactos['tarea'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                    <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'">
                        <?php echo $auxarray."\n"; ?>
                    </td>
                    <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contarch as $archivos) : 
                        if ($archivos['tarea'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                    <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'">
                        <?php echo $auxarray."\n"; ?>
                    </td>


                </tr>
                <?php } endforeach;}else{ 
                           if ($datos['estado_tar'] == 'CERRADA'){?>

                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos2['id_tar']?>'">
                    <?php echo $datos2['nom_cat']."\n"; ?>
                </td>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos2['id_tar']?>'">
                    <?php echo $datos2['desc_tar']."\n"; ?>
                </td>

                <!-- Comprobamos si tiene fases -->
                <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contfas as $fases) : 
                        if ($fases['id_tar'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos2['id_tar'];?>'">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contcon as $contactos) : 
                        if ($contactos['tarea'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos2['id_tar'];?>'">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contarch as $archivos) : 
                        if ($archivos['tarea'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos2['id_tar'];?>'">
                    <?php echo $auxarray."\n"; ?>
                </td>

                </tr>
                <?php }}?>

                <?php }else{?>
                <?php   if(count($datos2, COUNT_RECURSIVE)!= 14){
                foreach($datos2 as $datos) :
                 if ($datos['creador_tar'] ==$_SESSION['email']){
                    if ($datos['estado_tar'] == 'CERRADA'){?>

                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>'">
                    <?php echo $datos['nom_cat']."\n"; ?>
                </td>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar']?>'">
                    <?php echo $datos['desc_tar']."\n"; ?>
                </td>

                <!-- Comprobamos si tiene fases -->
                <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contfas as $fases) : 
                        if ($fases['id_tar'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contcon as $contactos) : 
                        if ($contactos['tarea'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contarch as $archivos) : 
                        if ($archivos['tarea'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos['id_tar'];?>'">
                    <?php echo $auxarray."\n"; ?>
                </td>

                </tr>
                <?php }}endforeach;}else{
            if ($datos2['estado_tar'] = 'CERRADA'){
            ?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos2['id_tar']?>'">
                    <?php echo $datos2['nom_cat']."\n"; ?>
                </td>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos2['id_tar']?>'">
                    <?php echo $datos2['desc_tar']."\n"; ?>
                </td>

                <!-- Comprobamos si tiene fases -->
                <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contfas as $fases) : 
                        if ($fases['id_tar'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos2['id_tar'];?>'">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contcon as $contactos) : 
                        if ($contactos['tarea'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos2['id_tar'];?>'">
                    <?php echo $auxarray."\n"; ?>
                </td>
                <?php $array = []; $auxarray='NO'; $cont=0;
                    foreach($contarch as $archivos) : 
                        if ($archivos['tarea_fas'] == $datos['id_tar']){ 
                            $array[$cont]='SI';
                        }else{
                            $array[$cont]='NO';
                        }
                        $cont++;
                    endforeach;
                    foreach ($array as $opt) :
                        if ($opt == 'SI'){
                            $auxarray = 'SI';
                        }
                    endforeach;?>
                <td onclick="location='../Controllers/Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $datos2['id_tar'];?>'">
                    <?php echo $auxarray."\n"; ?>
                </td>


                </tr>
                <?php }};?>
                <?php } ?>
            </table>
        </div>

    </fieldset>

</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin Search

?>
