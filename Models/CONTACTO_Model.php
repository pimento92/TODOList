<?php
class CONTACTO_Model {
	var $email;
  	var $nombre;
    var $desc;
    var $telf;


  //Constructor de la clase
  //
  function __construct($email, $nombre, $desc, $telf){
    $this->email = $email;
    $this->nombre = $nombre;
    $this->desc = $desc;
    $this->telf = $telf;

    include_once '../Models/Access_DB.php';
    $this->mysqli = ConnectDB();
  }

	function Exists(){

		$sql = "select * from CONTACTO where `email_con` = '".$this->email."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1 ){  // existe el usuario
				return 'El contacto ya existe';
			}
		else{
	    		return true; //no existe el usuario
		}

	}
  function ADD(){
    $sql = "SELECT * FROM CONTACTO WHERE(`email_con` = '$this->email')";
		$result;
		
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO CONTACTO (`email_con`,`nom_con`, `desc_con`,`telf_con`)
				VALUES ('".$this->email."', '".$this->nombre."', '".$this->desc."', '".$this->telf."')";
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
    	//datos introducemailos
	$datos=[
		'email'	=> $this->email,
		'nombre' =>$this->nombre,
        'desc' =>$this->desc,
        'telf' =>$this->telf,
	];
	//datos introducemailos no vacíos
	$datosNotNull=[
		'email' => '',
		'nombre' =>  '',
        'desc' =>  '',
        'telf' =>  ''
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
	if($datosNotNull['email']!= '')
	{
		$emails = array();
		array_push($emails, "`email_con` LIKE '%");
		array_push($emails, $datosNotNull['email']);
		array_push($emails, "%'");
		array_push($stmt, implode("", $emails));
	}
	if($datosNotNull['nombre']!= '')
	{
		$nom = array();
		array_push($nom, "`nom_con` LIKE '%");
		array_push($nom, $datosNotNull['nombre']);
		array_push($nom, "%'");
		array_push($stmt, implode("", $nom));
	}
	if($datosNotNull['desc']!= '')
	{
		$des = array();
		array_push($des, "`desc_con` LIKE '%");
		array_push($des, $datosNotNull['desc']);
		array_push($des, "%'");
		array_push($stmt, implode("", $des));
    }
    if($datosNotNull['telf']!= '')
	{
		$tel = array();
		array_push($tel, "`telf_con` LIKE '%");
		array_push($tel, $datosNotNull['telf']);
		array_push($tel, "%'");
		array_push($stmt, implode("", $tel));
	}
	
	$opt = implode(' AND ', $stmt);
	//sentencia creada
	$sql = "SELECT * FROM CONTACTO WHERE " . $opt;
	//Si no se introducen campos devuelve todas las tuplas
	if($sql == "SELECT * FROM CONTACTO WHERE "){
		return $this->SHOWALL();
	}else{
	//Si no hay coincemailencias devuelve un mensaje
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
    $sql = "UPDATE CONTACTO SET `email_con` = '$this->email', 
        `nom_con` = '$this->nombre',
        `desc_con` = '$this->desc',
        `telf_con` = '$this->telf'
						WHERE(`email_con` = '$this->email');";
						echo $sql;
    if(!$this->mysqli->query($sql)){
      return 'Error en la edición';
    }
    else{
      return 'Edición realizada con éxito';
    }
  }
  function Showall(){
		$result = $this->mysqli->query("SELECT * FROM CONTACTO");
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  function Delete(){
		$sql = "DELETE FROM CONTACTO WHERE `email_con` = '$this->email'";
  	if(!$this->mysqli->query($sql)){
  		return 'Error en el borrado';
  	}
  	else{
  		return 'Borrado realizado con éxito';
  	}
  }

}
 ?>
