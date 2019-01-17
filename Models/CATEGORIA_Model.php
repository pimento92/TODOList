<?php
class CATEGORIA_Model {
	var $id;
  	var $nombre;
    var $desc;


  //Constructor de la clase
  //
  function __construct($id, $nombre, $desc){
		$this->id = $id;
    $this->nombre = $nombre;
    $this->desc = $desc;

    include_once '../Models/Access_DB.php';
    $this->mysqli = ConnectDB();
  }

	function Exists(){

		$sql = "select * from CATEGORIA where `nom_cat` = '".$this->nombre."'";
		$sql3 = "select * from CATEGORIA where `desc_cat` = '".$this->desc."'";
		$result = $this->mysqli->query($sql);
		$result3 = $this->mysqli->query($sql3);
		if ($result->num_rows == 1 || $result3->num_rows == 1 ){  // existe el usuario
				return 'La categoria ya existe';
			}
		else{
	    		return true; //no existe el usuario
		}

	}
  function ADD(){
    $sql = "SELECT * FROM CATEGORIA WHERE(`nom_cat` = '$this->nombre')";
		$result;
		
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO CATEGORIA (`nom_cat`, `desc_cat`)
				VALUES ('".$this->nombre."', '".$this->desc."')";

          if (!$this->mysqli->query($sql)) {
            return 'Inserción realizada con éxito';
          }
          else{
            return 'Error en la inserción'; //operacion de insertado correcta
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
		'id'	=> $this->id,
		'nombre' =>$this->nombre,
		'desc' =>$this->desc,
	];
	//datos introducidos no vacíos
	$datosNotNull=[
		'id' => '',
		'nombre' =>  '',
		'desc' =>  '',
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
	if($datosNotNull['id']!= '')
	{
		$ids = array();
		array_push($ids, "`id_cat` LIKE '%");
		array_push($ids, $datosNotNull['id']);
		array_push($ids, "%'");
		array_push($stmt, implode("", $ids));
	}
	if($datosNotNull['nombre']!= '')
	{
		$nom = array();
		array_push($nom, "`nom_cat` LIKE '%");
		array_push($nom, $datosNotNull['nombre']);
		array_push($nom, "%'");
		array_push($stmt, implode("", $nom));
	}
	if($datosNotNull['desc']!= '')
	{
		$des = array();
		array_push($des, "`desc_cat` LIKE '%");
		array_push($des, $datosNotNull['desc']);
		array_push($des, "%'");
		array_push($stmt, implode("", $des));
	}
	
	$opt = implode(' AND ', $stmt);
	//sentencia creada
	$sql = "SELECT * FROM CATEGORIA WHERE " . $opt;
	//Si no se introducen campos devuelve todas las tuplas
	if($sql == "SELECT * FROM CATEGORIA WHERE "){
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
    $sql = "UPDATE CATEGORIA SET `nom_cat` = '$this->nombre',
            `desc_cat` = '$this->desc'
						WHERE(`id_cat` = '$this->id');";
    if(!$this->mysqli->query($sql)){
      return 'Error en la edición';
    }
    else{
      return 'Edición realizada con éxito';
    }
  }
  function Showall(){
		$result = $this->mysqli->query("SELECT * FROM CATEGORIA");
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  function Delete(){
		$sql = "DELETE FROM CATEGORIA WHERE `id_cat` = '$this->id'";
  	if(!$this->mysqli->query($sql)){
  		return 'Error en el borrado';
  	}
  	else{
  		return 'Borrado realizado con éxito';
  	}
  }

}
 ?>
