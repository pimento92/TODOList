<!-- página de introducción
 autor:  t45qxz 
12/11/2018 -->
<div class="col-md-12 contenido articulo">
<!-- título h1 intro -->
<h1><b><?php echo $strings['Portal de Gestión de IU'];?></b></h1>
            <!-- Imagen intro -->
            <img class="intropic" src="../Views/images/Intro/uimage.jpg" height="300" />
            <!-- párrafos intro -->
            <p><?php echo $strings['p1intro'];?></p>
            <p><?php echo $strings['p2intro'];?></p>
            <p><?php echo $strings['p3intro'];?></p>
    </div>
    <div class="card col-md-4 carta" style="width: 18rem;">
  <div class="card-body">
    <h4 class="card-title"><?php echo $strings['Añadir boleto'];?></h4>
    <p class="card-text"><?php echo $strings['cartaadd'];?></p>
    <a href="../Controllers/LoteriaIU_Controller.php?accion=ADD" class="btnintro"><i class="fas fa-plus"></i></a>  </div>
</div>
<div class="card col-md-4 carta" style="width: 18rem;">
  <div class="card-body">
    <h4 class="card-title"><?php echo $strings['Buscar boleto'];?></h4>
    <p class="card-text"><?php echo $strings['cartasearch'];?></p>
    <a href="../Controllers/LoteriaIU_Controller.php?accion=SEARCH" class="btnintro"><i class="fas fa-search"></i></a>  </div>
</div>
<div class="card col-md-4 carta" style="width: 18rem;">
  <div class="card-body">
    <h4 class="card-title"><?php echo $strings['Mostrar boletos'];?></h4>
    <p class="card-text"><?php echo $strings['cartashow'];?></p>
    <a href="../Controllers/LoteriaIU_Controller.php?accion=SHOWALL" class="btnintro"><i class="fas fa-eye"></i></a>
  </div>
</div>
</div>
