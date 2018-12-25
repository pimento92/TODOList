<?php
class ADJUNTA_Model {

		var $tarea;
		var $id;
    var $archivo;

  //Constructor de la clase
  //
  function __construct($tarea, $id, $archivo){
    $this->tarea = $tarea;
    $this->id = $id;
    $this->archivo = $archivo;


    include_once '../Models/Access_DB.php';
    $this->mysqli = ConnectDB();
  }

  function Exists(){

		$sql = "select * from ADJUNTA where `tarea_fas` = '".$this->tarea."' AND `id_fas` = '".$this->id."' AND `id_arch` = '".$this->archivo."'";

		$result = $this->mysqli->query($sql);

		if ($result->num_rows == 1){  // existe el usuario
				return 'La fase ya existe';
			}
		else{
	    		return true; //no existe el usuario
		}

	}

  function ADD(){
    $sql = "SELECT * FROM ADJUNTA WHERE(`id_arch` = '$this->archivo')";
    $result;
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO ADJUNTA (`tarea_fas`, `id_fas`, `id_arch`)
        VALUES ('".$this->tarea."', '".$this->id."', '".$this->archivo."')";
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

  function Showall(){
    $sql = "SELECT DISTINCT * FROM `POSEE` p, `tarea` t, `fase` f WHERE f.`tarea_fas`= t.`id_tar` AND p.`id_fas`=f.`id_fas` AND t.`id_tar` = '$this->tarea'";
    $resultado = $this->mysqli->query($sql);
    if(!($resultado = $this->mysqli->query($sql))){
      return 'Error en la consulta';
    }
    else{
      $result =  mysqli_fetch_all($resultado, MYSQLI_ASSOC);
      return $result;
    }
  }

  function ShowallFase(){
    $sql = "SELECT DISTINCT * FROM `adjunta` a, `archivo` ar WHERE a.`tarea_fas`=$this->tarea AND a.`id_fas`=$this->id AND ar.`id_arch`= a.`id_arch`";
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
    $sql = "DELETE FROM ADJUNTA WHERE `id_fas` = '$this->id' AND `tarea_fas`='$this->tarea' AND `id_arch` = '$this->archivo'";
  	if(!$this->mysqli->query($sql)){
  		return 'Error en el borrado';
  	}
  	else{
  		return 'Borrado realizado con éxito';
  	}
  }
}

 ?>
