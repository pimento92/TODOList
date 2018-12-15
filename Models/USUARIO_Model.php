
<?php

/**
 * Clase para el modelo de la tabla usuarios de la bbdd iu2018
 *  autor:  t45qxz
*	12/11/2018
 *
 */
class USUARIO_Model {

	var $nombre;
	var $apellidos;
	var $telefono;
	var $email;
	var $password;
	var $fecha;
	var $tipo;
	var $mysqli;

//Constructor de la clase
//

function __construct($nombre,$apellidos,$telefono,$email,$password,$fecha,$tipo){

	$this->nombre = $nombre;
	$this->apellidos = $apellidos;
	$this->telefono = $telefono;
	$this->email = $email;
	$this->password = $password;
	$this->fecha = $fecha;
	$this->tipo = $tipo;

	include_once '../Models/Access_DB.php';
	$this->mysqli = ConnectDB();
}

function getTipo(){
	return $this->tipo;
}



//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si
//existe ya en la tabla
function ADD()
{
    $sql = "SELECT * FROM USUARIO WHERE(`email_usr` = '$this->email')";
		$result ;
		
    if(!$result = $this->mysqli->query($sql)){
      return 'No es posible conectarse a la BD';
    }
    else{
      if($result->num_rows == 0){
        $sql = "INSERT INTO USUARIO (`nom_usr`, `apel_usr`, `telf_usr`, `email_usr`, `pass_usr`, `fechna_usr`, `tipo_usr`)
				VALUES ('".$this->nombre."', '".$this->apellidos."', '".$this->telefono."', '".$this->email."', '".$this->password."', '".$this->fecha."', '".$this->tipo."')";
          if ($this->mysqli->query($sql)) {
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

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{

}


//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
function SEARCH()
{
	//datos introducidos
	$datos=[
		'nombre' =>$this->nombre,
		'apellidos' =>$this->apellidos,
		'telf' =>$this->telefono,
		'email' =>$this->email,
		'pass' =>$this->password,
		'fecha' =>$this->fecha,
		'tipo' =>$this->tipo
	];
	//datos introducidos no vacíos
	$datosNotNull=[
		'nombre' =>  '',
		'apellidos' =>  '',
		'telf' =>   '',
		'email' =>  '',
		'pass' =>   '',
		'fecha' =>   '',
		'tipo' =>   ''
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

	if($datosNotNull['nombre']!= '')
	{
		$name = array();
		array_push($name, "`nom_usr` LIKE '%");
		array_push($name, $datosNotNull['nombre']);
		array_push($name, "%'");
		array_push($stmt, implode("", $name));
	}
	if($datosNotNull['apellidos']!= '')
	{
		$apel = array();
		array_push($apel, "`apel_usr` LIKE '%");
		array_push($apel, $datosNotNull['apellidos']);
		array_push($apel, "%'");
		array_push($stmt, implode("", $apel));
	}
	if($datosNotNull['telf']!= '')
	{
		$tel=array();
		array_push($tel, "`telf_usr` LIKE '%");
		array_push($tel, $datosNotNull['telf']);
		array_push($tel, "%'");
		array_push($stmt, implode("", $tel));
	}
	if($datosNotNull['email']!= '')
	{
		$email = array();
		array_push($email, "`email_usr` LIKE '%");
		array_push($email, $datosNotNull['email']);
		array_push($email, "%'");
		array_push($stmt, implode("", $email));
	}
	if($datosNotNull['pass']!= '')
	{
		$pas = array();
		array_push($pas, "`pass_usr` LIKE '%");
		array_push($pas, $datosNotNull['pass']);
		array_push($pas, "%'");
		array_push($stmt, implode("", $pas));
	}if($datosNotNull['fecha']!= '')
	{
		$fec = array();
		array_push($fec, "`fechna_usr` LIKE '%");
		array_push($fec, $datosNotNull['fecha']);
		array_push($fec, "%'");
		array_push($stmt, implode("", $fec));
	}if($datosNotNull['tipo']!= '')
	{
		$tip = array();
		array_push($tip, "`tipo_usr` LIKE '%");
		array_push($tip, $datosNotNull['tipo']);
		array_push($tip, "%'");
		array_push($stmt, implode("", $tip));
	}
	
	$opt = implode(' AND ', $stmt);
	//sentencia creada
	$sql = "SELECT * FROM USUARIO WHERE " . $opt;
	//Si no se introducen campos devuelve todas las tuplas
	if($sql == "SELECT * FROM USUARIO WHERE "){
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

//funcion DELETE : comprueba que la tupla a borrar existe y una vez
// verificado la borra
function DELETE($clave)
{
	$sql = "DELETE FROM USUARIO WHERE `email_usr` = '$clave'";
	if(!$this->mysqli->query($sql)){
		return 'Error en el borrado';
	}
	else{
		return 'Borrado realizado con éxito';
	}
}

// funcion RellenaDatos: recupera todos los atributos de una tupla a partir de su clave
function RellenaDatos($clave)
{
	$sql = "SELECT * FROM usuario WHERE `email_usr` = '$clave'";
    $result = $this->mysqli->query($sql);
	$data = mysqli_fetch_assoc($result);
	return $data;
}

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
function EDIT($clave)
{
	$sql = "UPDATE USUARIO SET `nom_usr`='$this->nombre', `apel_usr`='$this->apellidos', `telf_usr`='$this->telefono', `email_usr`='$this->email', `pass_usr`='$this->password', `fechna_usr`='$this->fecha', `tipo_usr`='$this->tipo' WHERE (`email_usr`='$this->email')";
	if(!$this->mysqli->query($sql)){
		return 'Error en la edición';
	}
	else{
		return 'Edición realizada con éxito';
	}

}

// funcion login: realiza la comprobación de si existe el usuario en la bd y despues si la pass
// es correcta para ese usuario. Si es asi devuelve true, en cualquier otro caso devuelve el
// error correspondiente
function login(){

	$sql = "SELECT *
			FROM USUARIO
			WHERE (
				(`email_usr` = '$this->email')
			)";

	$resultado = $this->mysqli->query($sql);
	if ($resultado->num_rows == 0){
		return 'El usuario no existe';
	}
	else{
		$tupla = $resultado->fetch_array();
		if ($tupla['pass_usr'] == $this->password){
			$_SESSION['tipo'] = $tupla['tipo_usr'];
			$_SESSION['nombre'] = $tupla['nom_usr'];
			return true;
		}
		else{
			return 'La password para este usuario no es correcta';
		}
	}
}//fin metodo login

//
function Register(){

		$sql = "select * from USUARIO where `email_usr` = '".$this->email."'";

		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1){  // existe el usuario
				return 'El usuario ya existe';
			}
		else{
	    		return true; //no existe el usuario
		}

	}

function registrar(){


		$sql = "INSERT INTO USUARIO (
			`nom_usr`,
			`apel_usr`,
			`telf_usr`,
			`email_usr`,
			`pass_usr`,
			`fechna_usr`,
			`tipo_usr`)
				VALUES (
					'".$this->nombre."',
					'".$this->apellidos."',
					'".$this->telefono."',
					'".$this->email."',
					'".$this->password."',
					'".$this->fecha."',
					'".$this->tipo."'
					)";

		if (!$this->mysqli->query($sql)) {
			return 'Error en la inserción';
		}
		else{
			return 'Inserción realizada con éxito'; //operacion de insertado correcta
		}
	}


function rows($sql)
{
	$result = mysqli_query($this->mysqli, $sql);
	$rowcount = mysqli_num_rows($result);
	return $rowcount;
}

function Showall(){
	$result = $this->mysqli->query("SELECT * FROM USUARIO ORDER BY tipo_usr DESC, nom_usr");
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


}//fin de clase
?>
