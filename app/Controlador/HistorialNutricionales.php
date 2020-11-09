<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/sin/app/Modelo/HistorialNutricional.php");
require_once ("$root/sin/app/Librerias/Helps.php");

/**
 * 
 */
class HistorialNutricionales
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
    $this->modelo = new HistorialNutricional();
  }

  //FUNCION PARA MANDAR A TRAER A LAS VISTAS DEL MENU DE HISTORIAL NUTRICIONAL
  public function RegistroHistorialNutricional()
  { 
    
    require_once 'Vista/Header.php';
    require_once 'Vista/HistorialNutricional/RegistroHistorialNutricional.php'; 
    require_once 'Vista/Footer.php';  

  }

  //FUNCION PARA GUARDAR DATOS DEL HISTORIAL
  public function guardarHistorial()
  { 
    
  $pesohabitual=$_POST['pesohabitual'];
  $aguaP=$_POST['aguaP'];
  $complexionF=$_POST['complexionF'];
  $pesoMinumo=$_POST['pesoMinumo'];
  $musculoP=$_POST['musculoP'];
  $edadMetabolica=$_POST['edadMetabolica'];
  $pesoMaximo=$_POST['pesoMaximo'];
  $masaOsea=$_POST['masaOsea'];
  $cintura=$_POST['cintura'];
  $pesoActual=$_POST['pesoActual'];
  $imc=$_POST['imc'];
  $cadera=$_POST['cadera'];
  $talla=$_POST['talla'];
  $kgGrasa=$_POST['kgGrasa'];
  $pesoIdeal=$_POST['pesoIdeal'];
  $grasaP=$_POST['grasaP'];
  $nivelGrasa=$_POST['nivelGrasa'];
  $pesoMeta=$_POST['pesoMeta'];
  $data = json_decode($_POST['arrayAlimentos'],true);    
  $datos=$this->modelo->guardarHistorialBase($pesohabitual, $aguaP, $complexionF,
  $pesoMinumo, $musculoP, $edadMetabolica, $pesoMaximo, $masaOsea, $cintura, $pesoActual,
  $imc, $cadera, $talla, $kgGrasa, $pesoIdeal, $grasaP, $nivelGrasa, $pesoMeta, $data);
  
  }
 

}



