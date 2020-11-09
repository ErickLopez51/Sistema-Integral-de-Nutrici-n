<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/sin/app/Modelo/DietaHabitual.php");
require_once ("$root/sin/app/Librerias/Helps.php");

/**
 * 
 */
class DietaHabituales
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
    $this->modelo = new DietaHabitual();
  }

  //FUNCION PARA MANDAR A TRAER A LAS VISTAS DEL MENU DE HISTORIAL NUTRICIONAL
  public function vistaRegistroDietaHabitual()
  { 
    
    require_once 'Vista/Header.php';
    require_once 'Vista/DietaHabitual/RegistroDietaHabitual.php'; 
    require_once 'Vista/Footer.php';  

  }

  //FUNCION PARA GUARDAR DATOS DE LA DIETA HABITUAL
  public function guardarDieta()
  { 
    
  $desayuno=$_POST['desayuno'];
  $colacion1=$_POST['colacion1'];
  $comida=$_POST['comida'];
  $colacion2=$_POST['colacion2'];
  $cena=$_POST['cena'];
  $notaDieta=$_POST['notaDieta'];
  $cantidadLiquidos=$_POST['cantidadLiquidos'];
  $datos=$this->modelo->guardarDietaBase($desayuno, $colacion1, $comida,
  $colacion2, $cena, $notaDieta, $cantidadLiquidos);
  
  }
 

}



