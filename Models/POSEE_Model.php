<?php
class POSEE_Model {

		var $email;
		var $id;
    var $tarea;

  //Constructor de la clase
  //
  function __construct($tarea,$id, $email){
    $this->email = $email;
    $this->id = $id;
    $this->tarea = $tarea;


    include_once '../Models/Access_DB.php';
    $this->mysqli = ConnectDB();
  }

  function Exists(){

		$sql = "SELECT * FROM POSEE WHERE `email_con` = '$this->email' AND `tarea_fas` = '$this->tarea' AND `id_fas`= $this->id";
		$result = $this->mysqli->query($sql);

		if ($result->num_rows == 1){  // existe el usuario
				return 'El contacto ya está adjunto';
			}
		else{
	    		return true; //no existe el usuario
		}

	}

  function ADD(){
    $sql = "SELECT * FROM POSEE WHERE `email_con` = '$this->email' AND `tarea_fas` = '$this->tarea' AND `id_fas`= $this->id";
    $result;
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO POSEE(`tarea_fas`,`id_fas`, `email_con`)
        VALUES ('".$this->tarea."', '".$this->id."', '".$this->email."')";
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

  function Delete(){
    $sql = "DELETE FROM POSEE WHERE `tarea_fas`=$this->tarea  AND `id_fas` = '$this->id' AND `email_con` = '$this->email'";
  	if(!$this->mysqli->query($sql)){
  		return 'Error en el borrado';
  	}
  	else{
  		return 'Borrado realizado con éxito';
  	}
  }

  function Showall(){
    $sql = "SELECT DISTINCT * FROM `POSEE` p, `TAREA` t, `FASE` f WHERE f.`tarea_fas`= t.`id_tar` AND p.`id_fas`=f.`id_fas` AND t.`id_tar` = '$this->tarea'";
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
    $sql = "SELECT DISTINCT * FROM `POSEE` p, `CONTACTO` c WHERE p.`tarea_fas`=$this->tarea AND p.`id_fas`=$this->id AND c.`email_con`=p.`email_con`";
    $resultado = $this->mysqli->query($sql);
    if(!($resultado = $this->mysqli->query($sql))){
      return 'Error en la consulta';
    }
    else{
      $result =  mysqli_fetch_all($resultado, MYSQLI_ASSOC);
      return $result;
    }
  }

}
 ?>
