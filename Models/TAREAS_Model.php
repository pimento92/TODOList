
<?php
class USUARIOS_Model {

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
    include_once '../Models/Access_DB';
    $this->mysqli = ConnectDB();
  }

  function ADD(){
    $sql = "SELECT * FROM TAREA WHERE(`id_tar` = '$this->id')";
    $result;
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO TAREA(`pri_tar`, `id_tar`, `fecha_tar`, `estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`)
        VALUES ('".$this->prioridad."', '".$this->id."', '".$this->fecha."', '".$this->estado."',
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
    $sql = "SELECT * FROM TAREA WHERE(`id_tar` = '$this->id')";
    if(!$resultado = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{

      $result = $resultado;
      return $result;
    }
  }

  function Edit(){
    $sql = "UPDATE TAREA SET `pri_tar` = '$this->prioridad',
            `fecha_tar` = '$this->fecha',
            `estado_tar` = '$this->estado', `desc_tar` = '$this->descripcion',
            `creador_tar` = '$this->creador', `cat_tar` = '$this->categoria'
            WHERE(`id_tar` = '$this->id');";

    if(!$this->mysqli->query($sql)){
      return 'Error en la edición';
    }
    else{
      return 'Edición completa';
    }
  }
  function Showall(){
    $sql = "SELECT * FROM TAREA";
    $resultado;
    if(!($resultado = $this->mysqli->query($sql))){
      return 'Error en la consulta';
    }
    else{
      $result = $resultado;
      return $result;
    }
  }

  function Delete(){
    $sql = "DELETE FROM USUARIO WHERE `id_tar` = '$this->id'";
  	if(!$this->mysqli->query($sql)){
  		return 'Error en el borrado';
  	}
  	else{
  		return 'Borrado exitosamente';
  	}
  }

}
 ?>
