<?php
/**
 * Clase para realizar el SHOWCURRENT en loteriaIU, recibe una tupla para mostrar
 *	autor:  t45qxz 
 *	12/11/2018 
 */
	class LoteriaIU_SHOWCURRENT{


		function __construct($datos){	
			$this->render($datos);
		}

		function render($datos){
            include '../Views/Header.php';?>
<div class="col-md-12 contenido articulo">
<fieldset class="sc">
            <legend><?php echo $strings['Datos de boleto'];?></legend>  
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
                        <th>E-mail</th>
                        <td><?php echo $datos['lot.email']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Nombre'];?></th>
                        <td><?php echo $datos['lot.nombre']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Apellidos'];?></th>
                        <td><?php echo $datos['lot.apellidos']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Participación'];?></th>
                        <td><?php echo $datos['lot.participacion']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Resguardo'];?></th>
                        <td><a class="linkfoto" href="../Files/Resguardos/<?php echo $datos['lot.email']."-".$datos['lot.resguardo']; ?>"><?php echo $strings['Ver resguardo'];?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Ingresado'];?></th>
                        <td><?php echo $datos['lot.ingresado']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Premio'];?></th>
                        <td><?php echo $datos['lot.premiopersonal']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Pagado'];?></th>
                        <td><?php echo $datos['lot.pagado']; ?></td>
                    </tr>
                </table>
            <div class="container-showall-btn">
                <button class="form-btn" type="button" role="link" onclick="window.location='./LoteriaIU_Controller.php?accion=SHOWALL'"><i class="fas fa-arrow-left"></i>
            </div>
        </fieldset>
</div>
<?php
			include '../Views/Footer.php';
		} //fin metodo render

	} //fin ShowCurrent

?>