
<?php

/**
 * Clase para el modelo de la tabla usuarios de la bbdd iu2018
 *  autor:  t45qxz
*	12/11/2018
 *
 */
class USUARIOS_Model {

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
	$sql = "SELECT FROM USUARIO WHERE (`nom_usr` LIKE '%$this->nombre%' AND `apel_usr` LIKE '%$this->apellidos%'
		 AND `telf_usr` LIKE '%$this->$telefono%' AND `email_usr` LIKE '%$this->email%'
		 AND `pass_usr` LIKE '%$this->password%' AND `fechna_usr` LIKE '%$this->fecha%' AND `tipo_usr` LIKE '%$this->tipo%')";
	$resultado;
	if(!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda';
	}
	else{
		return $resultado;
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
		return 'Borrado exitosamente';
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
	$sql = "UPDATE USUARIO SET `nom_usr`='$this->nombre', `apel_usr`='$this->apellidos', `telf_usr`='$this->telefono', `email_usr`='$this->email', `pass_usr`='$this->password', `fechna_usr`='$this->fecha', `tipo_usr`='$this->tipo'";
	if(!$this->mysqli->query($sql)){
		return 'Error en la edición';
	}
	else{
		return 'Edición completa';
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


}//fin de clase
?>
