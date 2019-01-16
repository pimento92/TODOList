<?php
/**
 * Clase para realizar el SEARCH en Tarea
 *	autor:  Juan Márquez 
 *	15/12/2018 
 */
	class Tarea_SEARCH{


		function __construct($datp, $datc){	
			$this->render($datp, $datc);
		}

		function render($datp, $datc){
            include '../Views/Header.php';?>
        <div class="col-md-3"></div>
        <div class=" table-responsive col-md-6 contenido ">
        <form name="search" id="search"  action='../Controllers/Tarea_Controller.php?accion=SEARCH' method='post' >
        <legend><?php echo $strings['Búsqueda de tareas'];?></legend>
        <div class="bloque">
        <!-- Contenedor de los pares input/label -->
            <!-- 'Campo' es un div para diseñar cada par label/input -->
            <div class="campo">
				<label><?php echo $strings['Descripción'];?></label>
				<input type = 'text' name = 'desc' id = 'desc' size = '60' value = ''>
            </div>
        </div>
        <?php if($_SESSION['tipo'] == 'ADMIN'){?>
            <div class="bloque">
        <div class="campo">
				<label><?php echo $strings['Creador'];?></label>
				<input type = 'text' name = 'email' id = 'email' size = '25' value = ''>
			</div>
            </div>
            <?php }?>
        <div class="bloque">
            <div class="campo">
                <label><?php echo $strings['Fecha'];?></label>
                <input name="fecha" type="date" size="20" onkeydown="return false" >
            </div>
        </div>
        <div class="bloque">
        <div class="campo">
				<label><?php echo $strings['Categoría'];?></label>
				<select name="cat" id="cat">
                    <option value=""></option>
                <?php foreach($datc as $datos){?>
                    <option value="<?php echo $datos['nom_cat'];?>"><?php echo $datos['nom_cat'];?></option>
                <?php }?>
                </select>
            </div>
        </div>
        <div class="bloque">
        <div class="campo">
				<label><?php echo $strings['Prioridad'];?></label>
				<select name="pri" id="pri">
                    <option value=""></option>
                <?php foreach($datp as $datos){?>
                    <option value="<?php echo $datos['nom_pri'];?>"><?php echo $datos['nom_pri'];?></option>
                <?php }?>
                </select>
            </div>
        </div>

        <div class="bloque">
            <div class="campo">
                <label><?php echo $strings['Estado'];?></label>
                <select name="estado" id="estado">
                    <option value=""></option>
                    <option value="ABIERTA"><?php echo $strings['Abierta'];?></option>
                    <option value="CERRADA"><?php echo $strings['Cerrada'];?></option>
                </select>
            </div>
        </div>

        <div class="bloque">
            <div class="campo">
                <label><?php echo $strings['Ordenar por:'];?></label>
                <select name="orden" id="orden">
                    <option value="fecha"><?php echo $strings['Fecha de alta'];?></option>
                    <option value="prioridad"><?php echo $strings['Prioridad'];?></option>
                    <option value="categoria"><?php echo $strings['Categoría'];?></option>
                </select>
            </div>
        </div>

            <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
            <div class="container-btn col-md-12">
                <button class="form-btn" name="submit" type="submit"><i class="fas fa-search"></i> 
                <button class="form-btn" type="button" role="link" onclick="window.location='./Tarea_Controller.php?accion=SHOWALL&param=fecha'"><i class="fas fa-times"></i></button>
                <button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i>
            </div>
        
    </form> 
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin Search

?>