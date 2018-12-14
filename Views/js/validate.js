/**Fichero .js con las funciones para la validación de formularios
 * autor : 	t45qxz
 * 12-11-2018
 */
//mostrar contraseña: dependiendo del valor del checkbox muestra u oculta la contraseña
function mostrarContraseña()
{
    //recoge el input contraseña
    var x = document.getElementById('password');
    //cambia el tipo de input de password a texto
    if (x.type === "password") 
    {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

//Función que comprueba si los campos están vacíos
//var campo: contiene el nombre del campo a comprobar (input)
function comprobarVacio(campo){   
    //variable que almacena el valor del input     
    var aux = campo.value;
    //Si el campo está vacio devuelve false;
    if(aux === "" || aux === null){
        return false;
    }
}

//función que comprueba expresiones regulares
//var campo: contiene el nombre del campo a comprobar (input)
//var expreg: contiene la expresión regualr a comparar
//var size: contiene el tamaño máximo que se desea comprobar
function comprobarExpresionRegular(campo, expreg, size)
{
    //variable que almacena el valor del input
    aux = campo.value;
    //comprueba que el valor coincida con la expresión regular
    if(!aux.match(expreg))
    {
        return false;
    }
    //comprueba que el largo es el requerido
    if(aux.length>size){
        return false;
    }
}



//función para comprobar DNI
//campo: elemento a validar
function comprobarDNI(campo)
{   
    document.getElementById("invalid"+campo.name).style.display = "none";
    document.getElementById("invalidletter"+campo.name).style.display = "none";
    //tamaño dni
    var size=9;
    //Expresión regular que comprueba que tiene 8 dígitos y una letra
    var regex = /^[0-9]{8,8}[A-Za-z]$/g;
    //Si la expresión regular no coincide con el valor del campo y el largo, devuelve falso
    if(comprobarExpresionRegular(campo, regex, size) === false && comprobarVacio(campo) != false)
    {
       //Párrafo que muestra el error
       document.getElementById("invalid"+campo.name).style.display = "block";
       //color del input inválido
       campo.style.backgroundColor = "#fd6e46";
       return false;
   }else{
       //comprobar que la letra es correcta
       campo.value = campo.value.toUpperCase();
        var letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        var letras2 = letras.split('');
        var campoSplit = campo.value.split('');
        var campoSplit2 = campo.value.split('');
        campoSplit2.pop();
        campoSplit2 = campoSplit2.join('');
        var resto = campoSplit2%23;
        if (campoSplit[campoSplit.length-1] != letras2[resto] && comprobarVacio(campo) != false)
        {
            campo.style.backgroundColor = "#fd6e46";
            document.getElementById("invalidletter"+campo.name).style.display = "block";
            return false;
        }else{
        //Párrafo que muestra el error vacío
        document.getElementById("invalid"+campo.name).style.display = "none";
        //color de input válido
        campo.style.backgroundColor = "#f0dcb5";
        
        }
    }
}

//Función para comprobar una contraseña de seguridad
//var campo: contiene el nombre del campo a comprobar (input)
//var size: contiene el tamaño máximo que se desea comprobar
function comprobarAlfanum(campo,size)
{
    document.getElementById("invalid"+campo.name).style.display = "none";
    //Expresión regular que comprueb que tienen al menos una mayúsucla, una minúscula, un caracter especial y un número, y tiene un tamaño de 8 a 20 caracteres (seguridad fuerte)
    var regex = /^[a-zA-Z0-9]*$/g;
    //Si la expresión regular no coincide con el valor del campo y el largo, devuelve falso
    if(comprobarExpresionRegular(campo, regex, size) === false && comprobarVacio(campo) != false)
    {

       //Párrafo que muestra el error
       document.getElementById("invalid"+campo.name).style.display = "block";
       //color del input inválido
       campo.style.backgroundColor = "#fd6e46";
       return false;
   }else{
       //Párrafo que muestra el error vacío
       document.getElementById("invalid"+campo.name).style.display = "none";
       //color de input válido
       campo.style.backgroundColor = "#f0dcb5";
    }
}

//Funcion para comprobar entrada de texto y longitud
//var campo: contiene el nombre del campo a comprobar (input)
//var size: contiene el tamaño máximo que se desea comprobar
function comprobarAlfabetico(campo, size){
    document.getElementById("invalid"+campo.name).style.display = "none";

    //variable que almacena la expresión regular requerida
    var regex = /^([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\']*[\s])*([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])+[\s]?([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])?$/g;
    //si la expresión regular no coincide con el valor del campo, o el campo es más largo de lo requerido devuelve false
    if(comprobarExpresionRegular(campo, regex, size) === false && comprobarVacio(campo) != false)
    {

        //Párrafo que muestra el error 
       
            document.getElementById("invalid"+campo.name).style.display = 'block';
        //color del input inválido
        campo.style.backgroundColor = "#fd6e46";
        return false;
         
    }else{
        document.getElementById("invalid"+campo.name).style.display = "none";
        //color de input válido
        campo.style.backgroundColor = "f0dcb5";
    }
}

//var campo: contiene el nombre del campo a comprobar (input)
//var size: contiene el tamaño máximo que se desea comprobar
function comprobarCorreo(campo, size)
{
    document.getElementById("invalid"+campo.name).style.display = "none";

    //Expresión regular que comprueba el formato de correo "ejemplo@ejemplo.com"
    var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*[.]{1}[a-z]+$/g;
    //Si la expresión regular no coincide con el valor del campo y el largo, devuelvela alerta, borra el campo y o enfoca
    if(comprobarExpresionRegular(campo, regex, size) === false && comprobarVacio(campo) != false)
    {
       //Párrafo que muestra el error
       document.getElementById("invalid"+campo.name).style.display = "block";       //color del input inválido
       campo.style.backgroundColor = "#fd6e46";
       return false;
   }else{
       //Párrafo que muestra el error vacío
       document.getElementById("invalid"+campo.name).style.display = "none";
       //color de input válido
       campo.style.backgroundColor = "#f0dcb5";
    }
}

//funcion para comprobar el login
//form: formulario que se desea validar
function comprobarLogin(form)
{
    document.getElementById("invalidform").style.display = 'none';
    //extrae los inputs para el login y su password
    var log = form['login'];
    var pass = form['password'];

    //compruba los vacíos
    if (comprobarVacio(log) === false || comprobarVacio(pass) === false){

         //Párrafo que muestra el error
         document.getElementById("invalidform").style.display = 'block';
        return false;
    }
    //comprueba los formatos
    if (comprobarCorreo(log, 60) === false || comprobarAlfanum(pass,20) === false){
       return false;
   }
       
}

//función para comprobar enteros
//campo: elemento a validar
//min: valor mínimo del entero
//max: valor máximo del entero
function comprobarEntero(campo, min, max)
{   
    document.getElementById("invalid"+campo.name).style.display = "none";
    //expresion regular a testear
    var regex = /[0-9]/g;
    //si no estávacío comprueba el formato
    if(comprobarVacio(campo) !=false)
    {
        if(comprobarExpresionRegular(campo, regex,max)=== false || campo.value.length<min || campo.value.length>max)
        {

        //Párrafo que muestra el error
        document.getElementById("invalid"+campo.name).style.display = "block";        //color del input inválido
        campo.style.backgroundColor = "#fd6e46";
    }else{
        //Párrafo que muestra el error vacío
        document.getElementById("invalid"+campo.name).style.display = "none";
        //color de input válido
        campo.style.backgroundColor = "#f0dcb5";
        }
    }
}

//función para comprobar enteros
//campo: elemento a validar
//min: valor mínimo del entero
//max: valor máximo del entero
//dec: número de decimales solicitados
function comprobarReal(campo, dec, min, max)
{   
    //tamaño maximo es el valor maximo más el punto y los decimales
    var str = "f";
    var re = new RegExp(str, "g");
    //Expresión regular que comprueba que tiene 8 dígitos y una letra
    var regex = /^[0-9]+[.]{0,1}[0-9]{f}$/g;
    regex.replace(re, dec);
    //Si la expresión regular no coincide con el valor mínimo o máximo del campo y el largo, devuelve falso
    var size = max + 1+ dec;
    if(parseFloat(document.getElementById(campo).value) > parseFloat(max) && comprobarVacio(campo) != false){
        return false;
    }
    if(parseFloat(document.getElementById(campo).value) < parseFloat(min) && comprobarVacio(campo) != false){
        return false;
    }
    if(comprobarExpresionRegular(campo, regex, size) === false && comprobarVacio(campo) != false){
        return false;
    }
}

//función para comprobar telefono español
//campo: elemento a validar
function comprobarTelf(campo)
{
    var size=13;
    //Expresión regular que comprueba que tiene 8 dígitos y una letra
    var regex = /^(\+34|0034|34)?[6|7|9][0-9]{8}$/g;
    //Si la expresión regular no coincide con el valor del campo y el largo, devuelve falso
    if(comprobarExpresionRegular(campo, regex, size) === false  && comprobarVacio(campo) != false){

       //Párrafo que muestra el error
       document.getElementById("invalid"+campo.name).style.display = "block";
       //color del input inválido
       campo.style.backgroundColor = "#fd6e46";
       return false;
   }else{
       //Párrafo que muestra el error vacío
       document.getElementById("invalid"+campo.name).style.display = "none";
       //color de input válido
       campo.style.backgroundColor = "#f0dcb5";
       campo.value = campo.value.toUpperCase();
    }
}

//Función para comprobar el registro de datos
//form: formulario que se desea validar
function comprobarRegistro(form)
{
    document.getElementById("invalidform").style.display = "none";

    //array con los elementos a comprobar
    var array=[ 
        form['log'],
        form['password'],
        form['nombre'],
        form['apellidos'],
        form['DNI'],
        form['fecha'],
        form['telefono'],
        form['email'],
        form['file'],
        form['sexo']
    ];
   
    //comprueba los vacíos
    for(var i=0;i<array.length;i++)
    {
        if(comprobarVacio(array[i]) === false)
        {
            //Párrafo que muestra el error
            document.getElementById("invalidform").style.display = "block";
            return false;
        }
    }
    //comprueba los formatos
   if (comprobarAlfanum(array[0],15) === false || comprobarAlfanum(array[1],20) === false || comprobarAlfabetico(array[2],25) === false || comprobarAlfabetico(array[3], 50) === false || comprobarDNI(array[4]) === false || comprobarCorreo(array[7],60) === false || comprobarTelf(array[6] === false) ){
       return false;
   }
}


//Función para comprobar formularios
//form: formulario a validar
function comprobarForm(form){
    document.getElementById("invalidform").style.display = "none";

    //array con los elementos a comprobar del formulario
    var array=[
        form['email'],
        form['nombre'],
        form['apellidos'],
        form['participacion'],
        form['file'],
        form['ingresado'],
        form['premio'],
        form['pagado']
    ];

    //comprueba que no sean vacíos
    for(var i=0;i<5;i++)
    {
        if(comprobarVacio(array[i]) === false)
        {
            //Párrafo que muestra el error
            document.getElementById("invalidform").style.display = "block";

            return false;
        }
    }
    //comprueba su formato
    if(comprobarCorreo(array[0],60) === false || comprobarAlfabetico(array[1],30) || comprobarAlfabetico(array[2],40) ===false || comprobarReal(array[3],1,5,2) === false || comprobarReal(array[6],1,8,2) === false || comprobarArchivo(array[4]) === false)
    {
        return false;
    }
}

//Función para comprobar formularios
//form: formulario a validar
function comprobarFormAddCon(form){
    document.getElementById("invalidform").style.display = "none";

    //array con los elementos a comprobar del formulario
    var array=[
        form.elements[0],
        form.elements[1],
        form.elements[2],
        form.elements[3]
    ];

    //comprueba que no sean vacíos
    for(var i=0;i<4;i++)
    {
        if(comprobarVacio(array[i]) === false)
        {
            //Párrafo que muestra el error
            document.getElementById("invalidform").style.display = "block";

            return false;
        }
    }
    //comprueba su formato
    if(comprobarCorreo(array[0],60) === false || comprobarAlfabetico(array[1],20) || comprobarAlfabetico(array[2],150) ===false || comprobarTelf(array[3]) === false)
    {
        return false;
    }
}

//comprueba el largo del archivo pasado por argumentos
function comprobarArchivo(campo)
{
    document.getElementById("invalid".campo.name).style.display = 'none';

    if(campo.value.length > 50)
    {
        //Párrafo que muestra el error
        document.getElementById("invalid".campo.name).style.display = 'block';
        return false;
    }
}