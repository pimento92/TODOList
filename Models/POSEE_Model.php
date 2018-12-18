<?php
class POSEE_Model {

		var $email;
		var $id;
 

  //Constructor de la clase
  //
  function __construct($email, $id){
    $this->email = $email;
    $this->id = $id;


    include_once '../Models/Access_DB.php';
    $this->mysqli = ConnectDB();
  }

  function Exists(){

		$sql = "select * from POSEE where `email_con` = '".$this->email."'";

		$result = $this->mysqli->query($sql);

		if ($result->num_rows == 1){  // existe el usuario
				return 'La contacto ya está adjunto';
			}
		else{
	    		return true; //no existe el usuario
		}

	}

  function ADD(){
    $sql = "SELECT * FROM POSEE WHERE `email_con` = '$this->email' AND `id_fas` = '$this->id'";
    $result;
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO POSEE(`id_fas`, `email_con`)
        VALUES ('".$this->email."', '".$this->id."')";
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
    $sql = "DELETE FROM POSEE WHERE `email_con` = '$this->email' AND `id_fas` = '$this->id'";
  	if(!$this->mysqli->query($sql)){
  		return 'Error en el borrado';
  	}
  	else{
  		return 'Borrado realizado con éxito';
  	}
  }

  function Showall(){
    $sql = "SELECT * FROM `POSEE` p, `tarea` t, `fase` f WHERE f.`tarea_fas`= t.`id_tar` AND p.`id_fas`=f.`id_fas` AND p.id_fas = '$this->id'";
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
