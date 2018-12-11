<?php

/**
 * Clase para el modelo de la tabla LOTERIAIU de la bbdd iu2018
 *  autor:  t45qxz 
*	12/11/2018
 * 
 */

class LOTERIAIU_Model {

	var $email;
	var $nombre;
	var $apellidos;
	var $partic;
	var $resguardo;
	var $ingresado;
	var $premio;
	var $pagado;
	var $mysqli;

//Constructor de la clase
//

function __construct($email,$nombre,$apellidos,$partic,$resguardo,$ingresado,$premio,$pagado){
	$this->email = $email;
	$this->nombre = $nombre;
	$this->apellidos = $apellidos;
	$this->partic = $partic;
	$this->resguardo = $resguardo;
	$this->ingresado = $ingresado;
	$this->premio = $premio;
	$this->pagado = $pagado;

	include_once '../Models/Access_DB.php';
	$this->mysqli = ConnectDB();
}



//Metodo ADD
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
function ADD()
{	
	$aux1 = "'".$this->ingresado."'";
	$aux2 = "'".$this->premio."'";
	$aux3 = "'".$this->pagado."'";


	if($this->ingresado == ''){
		$this->ingresado = 'NO';
		$aux1 ="'".$this->ingresado."'";
	}
	if($this->premio == ''){
		$this->premio = 'null';
		$aux2 = $this->premio;
	}
	if($this->pagado == ''){
		$this->pagado = 'NO';
		$aux3 = "'".$this->pagado."'";
	}
	
		$sql = "INSERT INTO LOTERIAIU (
			`lot.email`,
			`lot.nombre`,
			`lot.apellidos`,
			`lot.participacion`,
			`lot.resguardo`,
			`lot.ingresado`,
			`lot.premiopersonal`,
			`lot.pagado`
				) 
				VALUES (
					'".$this->email."',
					'".$this->nombre."',
					'".$this->apellidos."',
					".$this->partic.",
					'".$this->resguardo."',
					".$aux1.",
					".$aux2.",
					".$aux3."
					)";
	return $this->mysqli->query($sql);
		
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
		'email' =>$this->email,
		'nombre' =>$this->nombre,
		'apellidos' =>$this->apellidos,
		'partic' =>$this->partic,
		'resguardo' =>$this->resguardo,
		'ingresado' =>$this->ingresado,
		'premio' =>$this->premio,
		'pagado' =>$this->pagado
	];
	//datos introducidos no vacíos
	$datosNotNull=[
		'email' =>  '',
		'nombre' =>  '',
		'apellidos' =>   '',
		'partic' =>  '',
		'resguardo' =>   '',
		'ingresado' =>   '',
		'premio' =>   '',
		'pagado' =>   ''
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
		$email = array();
		array_push($email, "`lot.email` LIKE '%");
		array_push($email, $datosNotNull['email']);
		array_push($email, "%'");
		array_push($stmt, implode("", $email));
	}
	if($datosNotNull['nombre']!= '')
	{
		$name = array();
		array_push($name, "`lot.nombre` LIKE '%");
		array_push($name, $datosNotNull['nombre']);
		array_push($name, "%'");
		array_push($stmt, implode("", $name));
	}
	if($datosNotNull['apellidos']!= '')
	{
		$apel = array();
		array_push($apel, "`lot.apellidos` LIKE '%");
		array_push($apel, $datosNotNull['apellidos']);
		array_push($apel, "%'");
		array_push($stmt, implode("", $apel));
	}
	if($datosNotNull['partic']!= '')
	{
		$part=array();
		array_push($part, "`lot.participacion` LIKE '%");
		array_push($part, $datosNotNull['partic']);
		array_push($part, "%'");
		array_push($stmt, implode("", $part));
	}
	if($datosNotNull['resguardo']!= '')
	{
		$resg = array();
		array_push($resg, "`lot.resguardo` LIKE '%");
		array_push($resg, $datosNotNull['resguardo']);
		array_push($resg, "%'");
		array_push($stmt, implode("", $resg));
	}if($datosNotNull['ingresado']!= '')
	{
		$ingr = array();
		array_push($ingr, "`lot.ingresado` LIKE '%");
		array_push($ingr, $datosNotNull['ingresado']);
		array_push($ingr, "%'");
		array_push($stmt, implode("", $ingr));
	}if($datosNotNull['premio']!= '')
	{
		$prem = array();
		array_push($prem, "`lot.premio` LIKE '%");
		array_push($prem, $datosNotNull['premio']);
		array_push($prem, "%'");
		array_push($stmt, implode("", $prem));
	}
	if($datosNotNull['pagado']!= '')
	{
		$paid = array();
		array_push($paid, "`lot.pagado` LIKE '%");
		array_push($paid, $datosNotNull['pagado']);
		array_push($paid, "%'");
		array_push($stmt, implode("", $paid));
	}
	
	$opt = implode(' AND ', $stmt);
	//sentencia creada
	$sql = "SELECT * FROM LOTERIAIU WHERE " . $opt;

	//Si no se introducen campos devuelve todas las tuplas
	if($sql == "SELECT * FROM LOTERIAIU WHERE "){
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

//funcin SHOWALL : Muesstra todas las tuplas
function SHOWALL(){
	$result = $this->mysqli->query("SELECT * FROM LOTERIAIU");
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

//funcion DELETE : comprueba que la tupla a borrar existe y una vez
// verificado la borra
function DELETE($clave)
{
   $sql="DELETE FROM LOTERIAIU WHERE `lot.email` = '$clave'";   
   return $this->mysqli->query($sql);

}

// funcion Edit: realizar el update de una tupla despues de comprobar que existe
function EDIT($clave)
{	
	$aux = $this->premio;
	if($aux== ''){
		$aux='null';
	}
	$sql="UPDATE LOTERIAIU SET `lot.nombre`='$this->nombre',`lot.apellidos`='$this->apellidos',`lot.participacion`='$this->partic',`lot.resguardo`='$this->resguardo',`lot.ingresado`='$this->ingresado' ,`lot.premiopersonal`=$aux ,`lot.pagado`='$this->pagado'  WHERE `lot.email` = '$this->email'";
	return $this->mysqli->query($sql);
}

//
function Register(){

		$sql = "SELECT * FROM LOTERIAIU WHERE `lot.email` = '" . $this->email . "'";

		$result = $this->mysqli->query($sql);
		if ($result->num_rows != 0){  // existe el usuario
				return 'El boleto ya está registrado';
			}
		else{
	    		return true; //no existe el usuario
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