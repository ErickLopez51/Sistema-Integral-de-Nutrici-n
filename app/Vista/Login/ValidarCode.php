<?php
//Llamar al controlador d eusuario y ayudas para los campos
//include 'Controlador/Usuarios.php';
//include 'Librerias/Helps.php';
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once ("$root/sin/app/Controlador/Usuarios.php");
    require_once ("$root/sin/app/Librerias/Helps.php");

//Iniciar una sesión
session_start();

//Importar json
header('Content-type: application/json');
$resultado = array();

//Aqui se compara si los datos que se ingresaron al formulario son correctos o no
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["txtUsuario"]) && isset($_POST["txtPassword"])) {

        $txtUsuario  = validar_campo($_POST["txtUsuario"]);
         $contra = $_POST["txtPassword"];

        $txtPassword = sha1($contra);

        //si es correcto manda un texto de true
        $resultado = array("estado" => "true");

        //Obtener los datos del usuario
        if (Usuarios::login($txtUsuario, $txtPassword)) {
            $usuario             = Usuarios::getUsuario($txtUsuario, $txtPassword);
           
            $_SESSION["usuario"] = array(
              "idUsuario"         => $usuario->getIdUsuario(),
                "nombre"     => $usuario->getNombre(),
                "correo"    => $usuario->getCorreo(),
                "contrasena"    => $usuario->getContrasena(),
                "tipoUsuario"      => $usuario->getTipoUusario(),
            );
            return print(json_encode($resultado));
        }

    }
}
//Si los datos no son correctos retorna false
$resultado = array("estado" => "false");

return print(json_encode($resultado));
