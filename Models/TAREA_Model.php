<?php
class TAREA_Model {

  	var $prioridad;
    var $id;
    var $fecha;
    var $estado;
    var $descripcion;
    var $creador;
    var $categoria;

  //Constructor de la clase
  //
  function __construct($prioridad, $id, $fecha, $estado, $descripcion, $creador, $categoria){
    $this->prioridad = $prioridad;
    $this->id = $id;
    $this->fecha = $fecha;
    $this->estado = $estado;
    $this->descripcion = $descripcion;
    $this->creador = $creador;
    $this->categoria = $categoria;
    include_once '../Models/Access_DB.php';
    $this->mysqli = ConnectDB();
  }

  function Exists(){

		$sql = "select * from TAREA where `desc_tar` = '".$this->descripcion."'";

		$result = $this->mysqli->query($sql);

		if ($result->num_rows == 1){  // existe el usuario
				return 'La tarea ya existe';
			}
		else{
	    		return true; //no existe el usuario
		}

	}

  function ADD(){
    $sql = "SELECT * FROM TAREA WHERE(`id_tar` = '$this->id')";
    $result;
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO TAREA(`pri_tar`, `fecha_tar`, `estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`)
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

  function Search($orden){
		if ($orden == 'fecha'){
			$aux = 't.`fecha_tar`';
		}
		if ($orden == 'categoria'){
			$aux = 'c.`id_cat`';
		}
		if ($orden == 'prioridad'){
			$aux = 'p.`id_pri`';
		}
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
	$sql = "SELECT * FROM `tarea` t, `prioridad` p, `categoria` c WHERE t.`pri_tar`= p.`id_pri` AND t.`cat_tar`=c.`id_cat` AND " . $opt . "ORDER BY $aux";
	//Si no se introducen campos devuelve todas las tuplas
	if($sql == "SELECT * FROM `tarea` t, `prioridad` p, `categoria` c WHERE t.`pri_tar`= p.`id_pri` AND t.`cat_tar`=c.`id_cat` AND ORDER BY $aux"){
		return $this->SHOWALL($orden);
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
    $sql = "UPDATE TAREA SET `pri_tar` = '$this->prioridad',
            `desc_tar` = '$this->descripcion',
					 `cat_tar` = '$this->categoria'
            WHERE(`id_tar` = '$this->id');";
    if(!$this->mysqli->query($sql)){
      return 'Error en la edición';
    }
    else{
      return 'Edición realizada con éxito';
    }
  }
  function Showall($orden){
		if ($orden == 'fecha'){
			$aux = 't.`fecha_tar`';
		}
		if ($orden == 'categoria'){
			$aux = 'c.`id_cat`';
		}
		if ($orden == 'prioridad'){
			$aux = 'p.`id_pri`';
		}
    $sql = "SELECT * FROM `tarea` t, `prioridad` p, `categoria` c WHERE t.`pri_tar`= p.`id_pri` AND t.`cat_tar`=c.`id_cat` ORDER BY $aux";
    $resultado = $this->mysqli->query($sql);
    if(!($resultado = $this->mysqli->query($sql))){
      return 'Error en la consulta';
    }
    else{
      $result =  mysqli_fetch_all($resultado, MYSQLI_ASSOC);
      return $result;
    }
	}
	
	function CountFas(){
		$sql="SELECT Count(f.`id_fas`) as cont, t.`id_tar` FROM `fase` f, `tarea` t WHERE f.`tarea_fas`=t.`id_tar` GROUP BY t.`id_tar`";
		$toRet = $this->mysqli->query($sql);
		return $toRet;
	}
	
	function CountCont(){
		$sql="SELECT COUNT(p.`email_con`) as cont, f.`tarea_fas` as tarea FROM `posee` p, `fase` f  WHERE f.`tarea_fas`=p.`tarea_fas` GROUP BY p.`tarea_fas`";
		$toRet = $this->mysqli->query($sql);
		$toRet = mysqli_fetch_all($toRet, MYSQLI_ASSOC);
		return $toRet;
	}

	function ShowAllCont(){

		$sql = "SELECT DISTINCT c.`nom_con`, c.`email_con` FROM `posee` p , `tarea` t, `contacto` c  WHERE p.`tarea_fas`=$this->id AND p.`email_con`=c.`email_con`";
		$toRet = $this->mysqli->query($sql);
		if (mysqli_num_rows(mysqli_query($this->mysqli, $sql)) == 0){
			return "No hay contactos adjuntos";
		}else{
			$toRet = mysqli_fetch_all($toRet, MYSQLI_ASSOC);
			return $toRet;
		}
	}
	
	function CountArch(){
		$sql="SELECT COUNT(a.`id_arch`) as cont, t.`id_tar` as tarea FROM `adjunta` a, `tarea` t  WHERE t.`id_tar`=a.`tarea_fas` GROUP BY a.`tarea_fas`";
		$toRet = $this->mysqli->query($sql);
		$toRet = mysqli_fetch_all($toRet, MYSQLI_ASSOC);
		return $toRet;
	}

	function ShowAllFiles(){
		$sql = "SELECT DISTINCT ar.`url_arch`, ar.`desc_arch` FROM `adjunta` a , `tarea` t, `archivo` ar  WHERE a.`tarea_fas`=$this->id AND a.`id_arch`=ar.`id_arch`";
		$toRet = $this->mysqli->query($sql);
		if (mysqli_num_rows(mysqli_query($this->mysqli, $sql)) == 0){
			return "No hay archivos adjuntos";
		}else{
			$toRet = mysqli_fetch_all($toRet, MYSQLI_ASSOC);
			return $toRet;
		}
		return $toRet;
	}

  function Delete(){
    $sql = "DELETE FROM TAREA WHERE `id_tar` = '$this->id'";
  	if(!$this->mysqli->query($sql)){
  		return 'Error en el borrado';
  	}
  	else{
  		return 'Borrado realizado con éxito';
  	}
  }


	function Close(){
		$sql = "UPDATE `tarea` SET `estado_tar`='CERRADA' WHERE `id_tar`=$this->id";
		if(!$this->mysqli->query($sql)){
  		return 'Error cerrando la tarea';
  	}
  	else{
  		return 'Tarea cerrada con éxito';
  	}
	}
}
 ?>
