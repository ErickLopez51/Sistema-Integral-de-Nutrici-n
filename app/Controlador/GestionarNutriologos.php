<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/sin/app/Modelo/GestionarNutriologo.php");
require_once ("$root/sin/app/Librerias/Helps.php");

/**
 * 
 */
class GestionarNutriologos
{

  //FUNCION CONSTRUCTOR PARA EL FUNCIONAMIENTO DEL CONTROLADOR CON EL MODELO
  private $modelo;
  public function __construct()
  {
         //Iniciar una sesión
         if(!isset($_SESSION)) 
         { 
             session_start(); 
         } 
        //  else
        //  {
        //   session_destroy();
        //   session_unset();
        //   header("location:Vista/Login/Login.php");
        //  }
    $this->modelo = new GestionarNutriologo();
  }

  //FUNCION PARA MANDAR A TRAER A LAS VISTAS DEL MENU DE GESTION DE NUTRIOLOGOS
  public function MainGestorNutriologos()
  { 
    
    require_once 'Vista/Header.php';
    require_once 'Vista/GestionNutriologos/MainGestorNutriologos.php'; 
    require_once 'Vista/Footer.php';  

  }
  //FUNCION PARA MOSTRAR LOS NUTRIOLOGOS REGISTRADOS
  public function mostrarNutriologos()
  {
    $datos=$this->modelo->obtenerNutriologosGestor(); 
  }

  //FUNCION PARA MOSTRAR VISTA PARA DAR DE ALTA A NUTRIOLOGO
public function VistaAltaNutriologo()
{

 require_once 'Vista/Header.php';
 require_once 'Vista/GestionNutriologos/AltaNutriologo.php'; 
 require_once 'Vista/Footer.php';  

}

//FUNCION PARA MOSTRAR LOS DATOS DE NUTRIOLOGO 
public function datosDeUsuario()
{
 $idBotonVer=$_POST['idBotonVer'];
 $datosPerfil=$this->modelo->InfoPerfilUsuario($idBotonVer);
}

//FUNCION PARA EDITAR LOS DATOS DEL NUTRIOLOGO
public function EditarDatosNutriologo()
{

 $datosEditarNutriologo = new GestionarNutriologo();
 $idUsuario=base64_decode($_REQUEST['g']);
        
 if(isset($idUsuario)){

  $datosEditarNutriologo = $this->modelo->ObtenerDatosEditarNutriologo($idUsuario);
}
require_once 'Vista/Header.php';
require_once 'Vista/GestionNutriologos/EditarNutriologo.php'; 
require_once 'Vista/Footer.php';  

}

//FUNCION PARA ELIMINAR NUTRIOLOGO
public function bajaUsuario()
{
  
  $idUsuario=$_POST['idUsuario'];
  $this->modelo->DarDeBajaUsuario($idUsuario);

}

//FUNCION PARA DAR DE ALTA A NUTRIOLOGO
public function darDeAltaUsuario()
{

  $nombreNutriologo=$_POST['nombreNutriologo'];
  $apNutriologo=$_POST['apNutriologo'];
  $amNutriologo=$_POST['amNutriologo'];
  $correoNutriologo=$_POST['correoNutriologo'];
  $direccionNutriologo=$_POST['direccionNutriologo'];
  $telefonoNutriologo=$_POST['telefonoNutriologo'];
  $datosAlta=$this->modelo->GuardarUsuarioAlta($nombreNutriologo,$apNutriologo,$amNutriologo,$correoNutriologo,$direccionNutriologo,$telefonoNutriologo);
}

//FUNCION PARA ACTUALIZAR LOS DATOS DEL NUTRIOLOGO
public function ActualizarNutriologo()
{
  
  $idUsuario=$_POST['idUsuario'];
  $nombreNutriologo=$_POST['nombreNutriologo'];
  $apNutriologo=$_POST['apNutriologo'];
  $amNutriologo=$_POST['amNutriologo'];
  $correoNutriologo=$_POST['correoNutriologo'];
  $direccionNutriologo=$_POST['direccionNutriologo'];
  $telefonoNutriologo=$_POST['telefonoNutriologo'];
  $datosEditados=$this->modelo->ActualizarInfoNutriologos($idUsuario,$nombreNutriologo,$apNutriologo,$amNutriologo,$correoNutriologo,$direccionNutriologo,$telefonoNutriologo);
}



}



