<?php
/**
 * Clase para realizar el SEARCH en usuario
 *	autor:  Juan Márquez 
 *	13/12/2018 
 */
	class Usuario_SEARCH{


		function __construct(){	
			$this->render();
		}

		function render(){
            include '../Views/Header.php';?>
<div class="col-md-4"></div>
<div class="col-md-4 contenido articulo">
    <form name="search" id="search"  action='../Controllers/Usuario_Controller.php?accion=SEARCH' method='post' >
        <legend><?php echo $strings['Búsqueda de usuarios'];?></legend>
        <div class="bloque">
        <!-- Contenedor de los pares input/label -->
            <!-- 'Campo' es un div para diseñar cada par label/input -->
            <div class="campo">
				<label><?php echo $strings['Nombre'];?></label>
				<input type = 'text' name = 'nombre' id = 'nombre' size = '20' value = ''>
            </div>
        </div>
        <div class="bloque">
        <div class="campo">
				<label><?php echo $strings['Apellidos'];?></label>
				<input type = 'text' name = 'apellidos' id = 'apellidos' size = '20' value = ''>
            </div>
        </div>
        <div class="bloque">
        <div class="campo">
				<label><?php echo $strings['Teléfono'];?></label>
				<input type = 'text' name = 'telefono' id = 'telefono' size = '10' value = ''>
            </div>
        </div>
        <div class="bloque">
        <div class="campo">
				<label>E-mail</label>
				<input type = 'text' name = 'email' id = 'email' size = '25' value = ''>
			</div>
        </div>
        <div class="bloque">
            <div class="campo">
                <label><?php echo $strings['Fecha de nacimiento'];?></label>
                <input name="fecha" type="date" size="20" onkeydown="return false" >
            </div>
        </div>
        <div class="bloque">
			<div class="campo">
				<label><?php echo $strings['Tipo']?> : </label>
                <select name = 'tipo' id='tipo'><br>
                <option value="BASICO"><?php echo $strings['Básico'];?></option>
                <option value="ADMIN"><?php echo $strings['Administrador'];?></option>
        </select>
			</div>
		</div>

            <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
            <div class="container-btn col-md-12">
                <button class="form-btn" name="submit" type="submit"><i class="fas fa-search"></i> 
                <button class="form-btn" type="button" role="link" onclick="window.location='./Usuario_Controller.php?accion=SHOWALL'"><i class="fas fa-times"></i></button>
                <button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i>
            </div>
        
    </form> 
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin Search

?>