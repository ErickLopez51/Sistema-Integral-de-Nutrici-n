<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/sin/app/Modelo/AgendarCita.php");
require_once ("$root/sin/app/Librerias/Helps.php");

/**
 * 
 */
class AgendarCitas
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
    $this->modelo = new AgendarCita();
  }

  //FUNCION PARA MANDAR A TRAER A LAS VISTAS DEL MENÚ DE CITAS
  public function mainCitas()
  { 
    
    require_once 'Vista/Header.php';
    require_once 'Vista/AgendarCitas/MainAgendarCita.php'; 
    require_once 'Vista/Footer.php';  

  }

   //FUNCION PARA MOSTRAR LAS CITAS AGENDADAS
   public function mostrarCitas()
   {
     $datos=$this->modelo->obtenerCitas(); 
   }

   //FUNCION PARA MOSTRAR VISTA PARA AGENDAR CITA
   public function vistaAgendarCita()
   { 
     
     require_once 'Vista/Header.php';
     require_once 'Vista/AgendarCitas/AltaCita.php'; 
     require_once 'Vista/Footer.php';  
 
   }


  //FUNCION PARA GUARDAR DATOS DE LA CITA
  public function guardarCita()
  { 
    
  $fechaCita=$_POST['fechaCita'];
  $timeCita=$_POST['timeCita'];
  $horaCita=date("H:i",strtotime($timeCita));
  $notaCita=$_POST['notaCita'];

  $datos=$this->modelo->guardarCitaBase($fechaCita, $horaCita, $notaCita);

  }

  
   //FUNCION PARA MOSTRAR VISTA AL NUTRIOLOGO DE LAS CITAS AGENDADAS
   public function vistaHistorialCitas()
   { 
     
     require_once 'Vista/Header.php';
     require_once 'Vista/AgendarCitas/MainHistorialCitas.php'; 
     require_once 'Vista/Footer.php';  
 
   }

   //FUNCION PARA MOSTRAR LAS CITAS AGENDADAS DEL NUTRIOLOGO
   public function mostrarCitasNutriologo()
   {
     $datos=$this->modelo->obtenerCitasNutriologo(); 
   }

    //FUNCION PARA MOSTRAR LAS CITAS AGENDADAS DEL NUTRIOLOGO FILTRO
    public function mostrarCitasNutriologoFiltro()
    {
      $estadoCitas=$_POST['estadoCitas'];
      $datos=$this->modelo->obtenerCitasNutriologoFiltro($estadoCitas); 
    }
    
      //FUNCION PARA MOSTRAR LAS CITAS AGENDADAS DEL PACIENTE FILTRO
      public function mostrarCitasPacienteFiltro()
      {
        $estadoCitasPaciente=$_POST['estadoCitasPaciente'];
        $datos=$this->modelo->obtenerCitasPacienteFiltro($estadoCitasPaciente); 
      }
   
 

   //FUNCION PARA CONFIRMAR CITA
public function confirmarCita()
{
  
  $idCita=$_POST['idCita'];
  $this->modelo->updateConfirmar($idCita);

}

   //FUNCION PARA CANCELAR CITA
   public function cancelarCita()
   {
     
     $idCita=$_POST['idCita'];
     $this->modelo->updateCancelar($idCita);
   
   }


 

}



