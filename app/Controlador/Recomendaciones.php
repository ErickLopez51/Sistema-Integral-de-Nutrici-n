<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/sin/app/Modelo/Recomendacion.php");
require_once ("$root/sin/app/Librerias/Helps.php");

/**
 * 
 */
class Recomendaciones
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
    $this->modelo = new Recomendacion();
  }

  //FUNCION PARA MANDAR A TRAER A LAS VISTAS RECOMENDACIONES
  public function vistaRecomendacion()
  { 
    
    require_once 'Vista/Header.php';
    require_once 'Vista/Recomendaciones/MainRecomendaciones.php'; 
    require_once 'Vista/Footer.php';  

  }

  //FUNCION PARA GUARDAR DATOS DEL HISTORIAL
  public function enviarRecomendacion()
  {

  $cuerpo=$_POST['textarea'];
  $datos=$this->modelo->guardarRecomendacion($cuerpo);
  
  }
 

}



