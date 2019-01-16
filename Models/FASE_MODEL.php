<?php
class FASE_Model {

    var $tarea;
    var $id;
    var $fecha;
    var $estado;
    var $descripcion;

  //Constructor de la clase
  //
  function __construct($tarea, $id, $fecha, $estado, $descripcion){
    $this->tarea = $tarea;
    $this->id = $id;
    $this->fecha = $fecha;
    $this->estado = $estado;
    $this->descripcion = $descripcion;

    include_once '../Models/Access_DB.php';
    $this->mysqli = ConnectDB();
  }

  function Exists(){

		$sql = "select * from FASE where `id_fas` = '".$this->id."'";

		$result = $this->mysqli->query($sql);

		if ($result->num_rows == 1){  // existe el usuario
				return 'La fase ya existe';
			}
		else{
	    		return true; //no existe el usuario
		}

	}

  function ADD(){
    $sql = "SELECT * FROM FASE WHERE(`id_fas` = '$this->id')";
    $result;
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO FASE(`tarea_fas`, `fecha_fas`, `estado_fas`, `desc_fas`)
        VALUES ('".$this->tarea."', '".$this->fecha."', '".$this->estado."',
          '".$this->descripcion."')";
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
		'tarea' =>$this->tarea,
		'id' =>$this->id,
		'fecha' =>$this->fecha,
		'estado' =>$this->estado,
		'desc' =>$this->descripcion
	];
	//datos introducidos no vacíos
	$datosNotNull=[
		'tarea' =>  '',
		'id' =>  '',
		'fecha' =>   '',
		'estado' =>   '',
		'desc' =>   ''
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

	if($datosNotNull['tarea']!= '')
	{
		$tar = array();
		array_push($tar, "`tarea_fas` LIKE '%");
		array_push($tar, $datosNotNull['tarea']);
		array_push($tar, "%'");
		array_push($stmt, implode("", $tar));
	}
	if($datosNotNull['id']!= '')
	{
		$fid = array();
		array_push($fid, "`id_fas` LIKE '%");
		array_push($fid, $datosNotNull['id']);
		array_push($fid, "%'");
		array_push($stmt, implode("", $fid));
	}
	if($datosNotNull['fecha']!= '')
	{
		$fec=array();
		array_push($fec, "`fecha_fas` LIKE '%");
		array_push($fec, $datosNotNull['fecha']);
		array_push($fec, "%'");
		array_push($stmt, implode("",$fec));
	}
	if($datosNotNull['estado']!= '')
	{
		$est = array();
		array_push($est, "`estado_fas` LIKE '%");
		array_push($est, $datosNotNull['estado']);
		array_push($est, "%'");
		array_push($stmt, implode("", $est));
	}
	if($datosNotNull['desc']!= '')
	{
		$desc = array();
		array_push($desc, "`desc_fas` LIKE '%");
		array_push($desc, $datosNotNull['desc']);
		array_push($desc, "%'");
		array_push($stmt, implode("", $desc));
	}
	
  $opt = implode(' AND ', $stmt);
	//sentencia creada
	$sql = "SELECT * FROM `FASE` f WHERE  " . $opt . "ORDER BY `id_fas`";
	//Si no se introducen campos devuelve todas las tuplas
	if($sql == "SELECT * FROM `FASE` f WHERE ORDER BY `id_fas`"){
		return $this->SHOWALL();
	}else{
    $result = $this->mysqli->query($sql);
	//Si no hay coincidencias devuelve un mensaje
		if(mysqli_num_rows(mysqli_query($this->mysqli, $sql)) ==0)
		{
			return "No hay fases creadas";
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
    $sql = "UPDATE `FASE` SET `desc_fas` = '$this->descripcion'
						WHERE `tarea_fas` = $this->tarea AND `id_fas`=$this->id";
    if(!$this->mysqli->query($sql)){
      return 'Error en la edición';
    }
    else{
      return 'Edición realizada con éxito';
    }
  }
  function Showall(){
		$sql = "SELECT * FROM `FASE` f WHERE f.`tarea_fas`= '$this->tarea'";
    $resultado = $this->mysqli->query($sql);
    if(!($resultado = $this->mysqli->query($sql))){
      return 'Error en la consulta';
    }
    else{
      $result =  mysqli_fetch_all($resultado, MYSQLI_ASSOC);
      return $result;
    }
  }

  function Delete(){
    $sql = "DELETE FROM FASE WHERE `id_fas` = '$this->id' AND `tarea_fas`='$this->tarea'";
		if(!$this->mysqli->query($sql)){
  		return 'Error en el borrado';
  	}
  	else{
  		return 'Borrado realizado con éxito';
  	}
  }

	function Close(){
		$sql = "UPDATE `FASE` SET `estado_fas`='CERRADA' WHERE `tarea_fas`=$this->tarea AND `id_fas`=$this->id";
		if(!$this->mysqli->query($sql)){
  		return 'Error cerrando la fase';
  	}
  	else{
  		return 'Fase cerrada con éxito';
  	}
	}

	function getCont(){
		$sql = "SELECT * FROM `POSEE` p, `CONTACTO` c WHERE c.`email_con`=p.`email_con` AND `tarea_fas` = '$this->tarea' AND `id_fas`  = '$this->id'";
		$toRet = $this->mysqli->query($sql);
		if (mysqli_num_rows(mysqli_query($this->mysqli, $sql)) == 0){
			return "No hay contactos adjuntos";
		}else{
			$toRet = mysqli_fetch_all($toRet, MYSQLI_ASSOC);
			return $toRet;
		}
	}

	function getArch(){
		$sql = "SELECT * FROM `ADJUNTA` a, `ARCHIVO` ar WHERE a.`id_arch`=ar.`id_arch` AND `tarea_fas` = '$this->tarea' AND `id_fas`  = '$this->id'";
		$toRet = $this->mysqli->query($sql);
		if (mysqli_num_rows(mysqli_query($this->mysqli, $sql)) == 0){
			return "No hay archivos adjuntos";
		}else{
			$toRet = mysqli_fetch_all($toRet, MYSQLI_ASSOC);
			return $toRet;
		}
	}


}
 ?>

