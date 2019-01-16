<?php
/**
 * Clase para realizar el ADD en Posee
 *	autor:  Juan Márquez 
 *	17/12/2018 
 */
	class Posee_ADD{


		function __construct($clavef, $clavet, $datosc){	
			$this->render($clavef, $clavet, $datosc);
		}

		function render($clavef, $clavet, $datosc){
            include '../Views/Header.php';?>
    <div class="col-md-4"></div>
    <div class="col-md-4 table-responsive contenido">

        <form name="add" enctype="multipart/form-data" id="add" onsubmit="return comprobarFormPosee(this)" action='./Posee_Controller.php?accion=ADD&param=<?php echo $clavet;?>&param2=<?php echo $clavef;?>' method='post'>
        <legend><?php echo $strings['Añadir contacto'];?></legend>
        <p class="invalid iform" id="invalidform"><?php echo $strings['Debe rellenar todos los campos'];?></p>
       <div class="bloque">

			<div class="campo">
				<label><?php echo $strings['Contacto'];?></label>
				<select name="con" id="con" onchange="return AddInput()">
				<option value=""></option>
					<?php foreach($datosc as $datos){?>
					<option value="<?php echo $datos['email_con'];?>"><?php echo $datos['nom_con'];?></option>
					<?php }?>
				</select>
			</div>
			<div class="row selectcont">
			<div class="col-md-9 colselectcont1">
				<p><?php echo $strings['Si no encuentra el contacto que busca puede crearlo'];?></p>
			</div>
			<div class="col-md-1 colselectcont2">
				<button class="form-btn" type="button" role="link" onclick="window.location='../Controllers/Contacto_Controller.php?accion=ADD'"><i class="mini fas fa-plus"></i>
			</div>
			</div>
                    </div>
			<!-- Colocamos los inputs predeterminados -->
			<input type="text" name="email" id="email" style="display:none" value="<?php echo $_SESSION['email'];?>">
			<input type="text" name="fecha" id="fecha" style="display:none" value="<?php echo date('Y-m-d');?>">
			<input type="text" name="estado" id="estado" style="display:none" value="ABIERTA">
			<div class="campo">


        <!-- Contenedor de los iconos: volver-->
        <div class="container-btn">
            <button name="submit" value="upload" class="form-btn" type="submit"><i class="fas fa-check"></i> </button>
			<button class="form-btn" type="button" role="link" onclick="window.location='./Tarea_Controller.php?accion=SHOWCURRENT&param=<?php echo $clavet;?>'"><i class="fas fa-times"></i></button>

        </div>
					</div>
    </form> 
</div>
   
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ADD

?>