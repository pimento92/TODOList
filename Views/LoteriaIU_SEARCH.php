<?php
/**
 * Clase para realizar el SEARCH en loteriaIU
 *	autor:  t45qxz 
 *	12/11/2018 
 */
	class LoteriaIU_SEARCH{


		function __construct(){	
			$this->render();
		}

		function render(){
            include '../Views/Header.php';?>

<div class="col-md-12 contenido articulo">
    <form name="search" id="search"  action='../Controllers/LoteriaIU_Controller.php?accion=SEARCH' method='post' >
        <legend><?php echo $strings['Búsqueda de boletos'];?></legend>
        <div class="bloque">
        <!-- Contenedor de los pares input/label -->
            <!-- 'Campo' es un div para diseñar cada par label/input -->
            <div class="campo">
                <label>E-mail</label>
                <input name="email" type="text" size="25" >
            </div>
        </div>
        <div class="bloque">
            <div class="campo">
                <label><?php echo $strings['Nombre'];?></label>
                <input name="nombre"  type="text" size="20" >
            </div>
            <div class="campo">
                <label><?php echo $strings['Apellidos'];?></label>
                <input name="apellidos" type="text" size="30" >
            </div>
        </div>
        <div class="bloque">
            <div class="campo">
                <label><?php echo $strings['Participación'];?></label>
                <input name="participacion" type="text" size="5" >
            </div>
            <div class="campo">
                <label><?php echo $strings['Ingresado'];?></label>
                <select name="ingresado" style="width: 60">
                    <option></option>
                    <option value="SI"><?php echo $strings['Si']?></option>
                    <option value="NO"><?php echo $strings['No']?></option>
                </select>
            </div>
        </div>
        <div class="bloque">
            <div class="campo">
                <label><?php echo $strings['Premio']?></label>
                <input type = 'text' name = 'premio' size = '7' value = '' >
            </div>
            <div class="campo">
                <label><?php echo $strings['Pagado']?></label>
                <select name="pagado" style="width: 60">
                    <option></option>
                    <option value="SI"><?php echo $strings['Si']?></option>
                    <option value="NO"><?php echo $strings['No']?></option>
                </select>
            </div>  
        </div>
        <div class="upload-btn-wrapper">
						<label><?php echo $strings['Resguardo']?></label>
						<button class="abtn"><?php echo $strings['Seleccionar foto']?></button>
						<input type="file" name="file" value = '<?php echo $datos['lot_resguardo'];?>'/>
					</div>
        <div class="bloque">
        </div>

            <!-- Contenedor de los iconos: aceptar, voler y vaciar-->
            <div class="container-btn col-md-12">
                <button class="form-btn" name="submit" type="submit"><i class="fas fa-search"></i> 

                <button class="form-btn" type="reset"><i class="fas fa-undo-alt"></i>
                <button class="form-btn" role="link" onclick="window.location='./Index_Controller.php';"><i class="fas fa-times"></i>
            </div>
        
    </form> 
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin Search

?>