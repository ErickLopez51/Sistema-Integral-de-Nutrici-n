<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/sin/app/Modelo/GestionarPaciente.php");
require_once ("$root/sin/app/Librerias/Helps.php");

/**
 * 
 */
class GestionarPacientes
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
    $this->modelo = new GestionarPaciente();
  }

  //FUNCION PARA MANDAR A TRAER A LAS VISTAS DEL MENU DE GESTION DE PACIENTES
  public function MainGestorPacientes()
  { 
    
    require_once 'Vista/Header.php';
    require_once 'Vista/GestionPacientes/MainGestorPacientes.php'; 
    require_once 'Vista/Footer.php';  

  }
  //FUNCION PARA MOSTRAR LOS PACIENTES REGISTRADOS
  public function mostrarPacientes()
  {
    $datos=$this->modelo->obtenerPacientesGestor(); 
  }

  //FUNCION PARA MOSTRAR VISTA PARA DAR DE ALTA A PACIENTES
public function VistaAltaPaciente()
{

 require_once 'Vista/Header.php';
 require_once 'Vista/GestionPacientes/AltaPaciente.php'; 
 require_once 'Vista/Footer.php';  

}

//FUNCION PARA MOSTRAR LOS DATOS DE PACIENTES 
public function datosDeUsuario()
{
 $idBotonVer=$_POST['idBotonVer'];
 $datosPerfil=$this->modelo->InfoPerfilUsuario($idBotonVer);
}

//FUNCION PARA EDITAR LOS DATOS DEL PACIENTES
public function EditarDatosPaciente()
{

 $datosEditarPaciente = new GestionarPaciente();
 $idUsuario=base64_decode($_REQUEST['g']);
        
 if(isset($idUsuario)){

  $datosEditarPaciente = $this->modelo->ObtenerDatosEditarPaciente($idUsuario);
}
require_once 'Vista/Header.php';
require_once 'Vista/GestionPacientes/EditarPaciente.php'; 
require_once 'Vista/Footer.php';  

}

//FUNCION PARA ELIMINAR PACIENTES
public function bajaUsuario()
{

  $idUsuario=$_POST['idUsuario'];
  $this->modelo->DarDeBajaUsuario($idUsuario);


}

//FUNCION PARA DAR DE ALTA A PACIENTES
public function darDeAltaUsuario()
{

  $nombrePaciente=$_POST['nombrePaciente'];
  $apPaciente=$_POST['apPaciente'];
  $amPaciente=$_POST['amPaciente'];
  $fechaNacPaciente=$_POST['fechaNacPaciente'];
  $estaturaPaciente=$_POST['estaturaPaciente'];
  $ocupacionPaciente=$_POST['ocupacionPaciente'];
  $correoPaciente=$_POST['correoPaciente'];
  $direccionPaciente=$_POST['direccionPaciente'];
  $ciudadPaciente=$_POST['ciudadPaciente'];
  $telefonoPaciente=$_POST['telefonoPaciente'];
  $datosAlta=$this->modelo->GuardarUsuarioAlta($nombrePaciente,$apPaciente,
  $amPaciente,$fechaNacPaciente,$estaturaPaciente,$ocupacionPaciente,$correoPaciente, 
  $direccionPaciente,$ciudadPaciente,$telefonoPaciente);
}

//FUNCION PARA ACTUALIZAR LOS DATOS DEL PACIENTES
public function ActualizarPaciente()
{
  
  $idUsuario=$_POST['idUsuario'];
  $nombrePaciente=$_POST['nombrePaciente'];
  $apPaciente=$_POST['apPaciente'];
  $amPaciente=$_POST['amPaciente'];
  $fechaNacPaciente=$_POST['fechaNacPaciente'];
  $estaturaPaciente=$_POST['estaturaPaciente'];
  $ocupacionPaciente=$_POST['ocupacionPaciente'];
  $correoPaciente=$_POST['correoPaciente'];
  $direccionPaciente=$_POST['direccionPaciente'];
  $ciudadPaciente=$_POST['ciudadPaciente'];
  $telefonoPaciente=$_POST['telefonoPaciente'];
  
  $datosEditados=$this->modelo->ActualizarInfoPacientes($idUsuario,$nombrePaciente,$apPaciente,
  $amPaciente,$fechaNacPaciente,$estaturaPaciente,$ocupacionPaciente,$correoPaciente, 
  $direccionPaciente,$ciudadPaciente,$telefonoPaciente);
}



}



