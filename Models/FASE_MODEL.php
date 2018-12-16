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
    $sql = "SELECT * FROM FASE WHERE(`id_tar` = '$this->id')";
    $result;
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO FASE(`pri_tar`, `fecha_tar`, `estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`)
        VALUES ('".$this->prioridad."', '".$this->fecha."', '".$this->estado."',
          '".$this->descripcion."', '".$this->creador."', '".$this->categoria."')";
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
		'desc' =>$this->descripcion,
		'pri' =>$this->prioridad,
		'cat' =>$this->categoria,
		'creador' =>$this->creador,
		'estado' =>$this->estado,
    'fecha' =>$this->fecha,
    'id'  =>$this->id
	];
	//datos introducidos no vacíos
	$datosNotNull=[
		'desc' =>  '',
		'pri' =>  '',
		'cat' =>   '',
		'creador' =>   '',
		'estado' =>   '',
    'fecha' =>   '',
    'id'  => ''
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

	if($datosNotNull['desc']!= '')
	{
		$des = array();
		array_push($des, "`desc_tar` LIKE '%");
		array_push($des, $datosNotNull['desc']);
		array_push($des, "%'");
		array_push($stmt, implode("", $des));
	}
	if($datosNotNull['pri']!= '')
	{
		$pr = array();
		array_push($pr, "`nom_pri` LIKE '%");
		array_push($pr, $datosNotNull['pri']);
		array_push($pr, "%'");
		array_push($stmt, implode("", $pr));
	}
	if($datosNotNull['cat']!= '')
	{
		$ca=array();
		array_push($ca, "`nom_cat` LIKE '%");
		array_push($ca, $datosNotNull['cat']);
		array_push($ca, "%'");
		array_push($stmt, implode("",$ca));
	}
	if($datosNotNull['creador']!= '')
	{
		$cre = array();
		array_push($cre, "`creador_tar` LIKE '%");
		array_push($cre, $datosNotNull['creador']);
		array_push($cre, "%'");
		array_push($stmt, implode("", $cre));
	}
	if($datosNotNull['estado']!= '')
	{
		$est = array();
		array_push($est, "`estado_tar` LIKE '%");
		array_push($est, $datosNotNull['estado']);
		array_push($est, "%'");
		array_push($stmt, implode("", $est));
	}if($datosNotNull['fecha']!= '')
	{
		$fec = array();
		array_push($fec, "`fecha_tar` LIKE '%");
		array_push($fec, $datosNotNull['fecha']);
		array_push($fec, "%'");
		array_push($stmt, implode("", $fec));
  }if($datosNotNull['id']!= '')
	{
		$ide = array();
		array_push($ide, "`id_tar` LIKE '%");
		array_push($ide, $datosNotNull['id']);
		array_push($ide, "%'");
		array_push($stmt, implode("", $ide));
  }
	
  $opt = implode(' AND ', $stmt);
	//sentencia creada
	$sql = "SELECT * FROM `FASE` t, `prioridad` p, `categoria` c WHERE t.`pri_tar`= p.`id_pri` AND t.`cat_tar`=c.`id_cat` AND " . $opt;
	//Si no se introducen campos devuelve todas las tuplas
	if($sql == "SELECT * FROM `FASE` t, `prioridad` p, `categoria` c WHERE t.`pri_tar`= p.`id_pri` AND t.`cat_tar`=c.`id_cat` AND "){
		return $this->SHOWALL();
	}else{
    $result = $this->mysqli->query($sql);
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
    $sql = "UPDATE FASE SET `pri_tar` = '$this->prioridad',
            `estado_tar` = '$this->estado', `desc_tar` = '$this->descripcion',
					 `cat_tar` = '$this->categoria'
            WHERE(`id_tar` = '$this->id');";
    if(!$this->mysqli->query($sql)){
      return 'Error en la edición';
    }
    else{
      return 'Edición realizada con éxito';
    }
  }
  function Showall(){
    $sql = "SELECT * FROM `FASE` f, `tarea` t WHERE f.`tarea_fas`= t.`id_tar` AND t.id_tar = '$this->tarea'";
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
    $sql = "DELETE FROM FASE WHERE `id_tar` = '$this->id'";
  	if(!$this->mysqli->query($sql)){
  		return 'Error en el borrado';
  	}
  	else{
  		return 'Borrado realizado con éxito';
  	}
  }

}
 ?>
