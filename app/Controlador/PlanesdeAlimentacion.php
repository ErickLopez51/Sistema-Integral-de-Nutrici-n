<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/sin/app/Modelo/PlandeAlimentacion.php");
require_once ("$root/sin/app/Librerias/Helps.php");

/**
 * 
 */
class PlanesdeAlimentacion
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
    $this->modelo = new PlandeAlimentacion();
  }

  //FUNCION PARA MANDAR A TRAER A LAS VISTAS DEL MENU DEL PLAN NUTRICIONAL
  public function MainPlanAlimentacion()
  { 
    
    require_once 'Vista/Header.php';
    require_once 'Vista/PlandeAlimentacion/MainPlan.php'; 
    require_once 'Vista/Footer.php';  

  }
  //FUNCION PARA MOSTRAR LOS PLANES DE ALIMENTACION REGISTRADOS
  public function mostrarPlanes()
  {
    $datos=$this->modelo->obtenerPlanesGestor(); 
  }

  //FUNCION PARA MOSTRAR VISTA PARA CREAR PLAN DE ALIMENTACION
public function VistaAltaPlan()
{

 require_once 'Vista/Header.php';
 require_once 'Vista/PlandeAlimentacion/AltaPlan.php'; 
 require_once 'Vista/Footer.php';  

}

//FUNCION PARA MOSTRAR LOS DATOS DE NUTRIOLOGO 
public function datosDeUsuario()
{
 $idBotonVer=$_POST['idBotonVer'];
 $datosPerfil=$this->modelo->InfoPerfilUsuario($idBotonVer);
}

//FUNCION PARA EDITAR LOS DATOS DEL PLAN DE NUTRICIÓN
public function EditarDatosPlan()
{

 $datosEditarPlan = new PlandeAlimentacion();
 $idPlanAlimentacion=base64_decode($_REQUEST['g']);

 if(isset($idPlanAlimentacion)){

  $datosEditarPlan = $this->modelo->ObtenerDatosEditarPlan($idPlanAlimentacion);
  $editarAlimentosPlan = $this->modelo->editarAlimentosPlan($idPlanAlimentacion);
}
require_once 'Vista/Header.php';
require_once 'Vista/PlandeAlimentacion/EditarPlan.php'; 
require_once 'Vista/Footer.php';  

}

//FUNCION PARA ELIMINAR PLAN DE NUTRICIÓN
public function bajaPlan()
{

  $idPlanAlimentacion=$_POST['idPlanAlimentacion'];
  $this->modelo->DarDeBajaPlan($idPlanAlimentacion);


}

//FUNCION PARA DAR DE ALTA PLAN DE NUTRICIÓN
public function guardarPlan()
{
  $nombrePlan=$_POST['nombrePlan'];
  $kcaltotal=$_POST['kcaltotal'];
  $hc=$_POST['hc'];
  $hdesayuno=$_POST['hdesayuno'];
  $hcolacion1=$_POST['hcolacion1'];
  $hcomida=$_POST['hcomida'];
  $hcolacion2=$_POST['hcolacion2'];
  $hcena=$_POST['hcena'];
  $data = json_decode($_POST['arrayAlimentosPlan'],true);   
  $datos=$this->modelo->guardarDatosPlan($nombrePlan,$kcaltotal,$hc,$hdesayuno,$hcolacion1,$hcomida,$hcolacion2,$hcena,$data);
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



