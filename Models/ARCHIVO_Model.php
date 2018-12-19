<?php
class ARCHIVO_Model {

		var $id;
		var $desc;
        var $url;

  //Constructor de la clase
  //
  function __construct($id, $desc, $url){
    $this->id = $id;
    $this->desc = $desc;
    $this->url = $url;


    include_once '../Models/Access_DB.php';
    $this->mysqli = ConnectDB();
  }

  function getID(){
      $sql = "SELECT `id_arch` FROM ARCHIVO WHERE `url_arch`='$this->url'";
      $result = $this->mysqli->query($sql);
      $result =  mysqli_fetch_row($result);
      return $result;
  }

  function ADD(){
    $sql = "SELECT * FROM ARCHIVO WHERE(`id_arch` = '$this->id')";
    $result;
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO ARCHIVO(`desc_arch`, `url_arch`)
        VALUES ('".$this->desc."', '".$this->url."')";
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
}

 ?>
