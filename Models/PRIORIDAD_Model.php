
<?php
class PRIORIDAD_Model {
		var $id;
  	var $nombre;
    var $desc;
    var $color;


  //Constructor de la clase
  //
  function __construct($id, $nombre, $desc, $color){
    $this->nombre = $nombre;
    $this->id = $id;
    $this->desc = $desc;
    $this->color = $color;

    include_once '../Models/Access_DB.php';
    $this->mysqli = ConnectDB();
  }

  function ADD(){
    $sql = "SELECT * FROM PRIORIDAD WHERE(`nom_pri` = '$this->nombre')";
    $result;
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO PRIORIDAD (`nom_pri`, `desc_pri`, `codcolor_pri`)
        VALUES ('".$this->nombre."', '".$this->desc."', '".$this->color."')";

          if (!$this->mysqli->query($sql)) {
            return 'Error en la inserción';
          }
          else{
            return 'Inserción realizada con éxito'; //operacion de insertado correcta
          }
      }
      else {
        return 'Ya esta en la base de datos';
      }
    }
  }

  function Search(){
    	//datos introducidos
	$datos=[
		'nombre' =>$this->nombre,
		'desc' =>$this->desc,
		'color' =>$this->color
	];
	//datos introducidos no vacíos
	$datosNotNull=[
		'nombre' =>  '',
		'desc' =>  '',
		'color' =>   ''
	];
	//meter los post no vacíos en el array de no vacíos
	foreach($datos as $dat => $valor)
	{
		if($valor != '')
		{
			$datosNotNull[$dat] = $valor;
		}
	}

	//crear lasentencia con los datos no vacíos, LIKE para datos parciales
	$stmt = array();
	if($datosNotNull['nombre']!= '')
	{
		$nom = array();
		array_push($nom, "`bom_pri` LIKE '%");
		array_push($nom, $datosNotNull['nombre']);
		array_push($nom, "%'");
		array_push($stmt, implode("", $nom));
	}
	if($datosNotNull['desc']!= '')
	{
		$des = array();
		array_push($des, "`desc_pri` LIKE '%");
		array_push($des, $datosNotNull['desc']);
		array_push($des, "%'");
		array_push($stmt, implode("", $des));
	}
	if($datosNotNull['color']!= '')
	{
		$col = array();
		array_push($col, "`codcolor_pri` LIKE '%");
		array_push($col, $datosNotNull['color']);
		array_push($col, "%'");
		array_push($stmt, implode("", $col));
	}

	
	$opt = implode(' AND ', $stmt);
	//sentencia creada
	$sql = "SELECT * FROM LOTERIAIU WHERE " . $opt;

	//Si no se introducen campos devuelve todas las tuplas
	if($sql == "SELECT * FROM LOTERIAIU WHERE "){
		return $this->SHOWALL();
	}else{
	//Si no hay coincidencias devuelve un mensaje
		if(mysqli_num_rows(mysqli_query($this->mysqli, $sql)) ==0)
		{
			return "No se han encontrado coincidencias";
		}else{
			if(mysqli_num_rows(mysqli_query($this->mysqli, $sql)) ==1)
			{
				$result = $this->mysqli->query($sql);
				return mysqli_fetch_assoc($result);
			}else{
				$result = $this->mysqli->query($sql);
				return mysqli_fetch_all($result, MYSQLI_ASSOC);
			}
		}
	}
}

  function Edit(){
    $sql = "UPDATE PRIORIDAD SET `nom_pri` = '$this->nombre',
            `desc_pri` = '$this->desc',
            `codcolor_pri` = '$this->color'
            WHERE(`id_pri` = '$this->id');";

    if(!$this->mysqli->query($sql)){
      return 'Error en la edición';
    }
    else{
      return 'Edición completa';
    }
  }
  function Showall(){
		$result = $this->mysqli->query("SELECT * FROM PRIORIDAD");
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  function Delete(){
    $sql = "DELETE FROM PRIORIDAD WHERE `id_pri` = '$this->id'";
  	if(!$this->mysqli->query($sql)){
  		return 'Error en el borrado';
  	}
  	else{
  		return 'Borrado exitosamente';
  	}
  }

}
 ?>
