<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]); //RUTA DEL SEVIDOR
require_once ("$root/sin/app/Modelo/HabitoAlimenticio.php"); //MODELO DE HABITOS ALIMENTICIIOS
require_once ("$root/sin/app/Librerias/Helps.php"); //ARCHIVO PARA VALIDAR Y LIMPIAR UN CAMPO

/**
 * 
 */
class HabitosAlimenticios //DEFINIR CLASE DEL CONTROLADOR
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
    $this->modelo = new HabitoAlimenticio();
  }

  //FUNCION PARA MANDAR A TRAER A LAS VISTA PARA EL FORMULARIO DE HABITOS ALIMENTICIOS
  public function RegistroHabitos()
  { 
    
    require_once 'Vista/Header.php';
    require_once 'Vista/HabitosAlimenticios/RegistroHabitos.php'; 
    require_once 'Vista/Footer.php';  

  }

  //FUNCION PARA OBTENER LOS DATOS DEL FORMULARIO DE LA VISTA
  public function guardarHabitos() //LOS CAMPOS DEL FORMULARIO SE ALAMACENAN EN ESTA FUNCION
  { 
    
  $hLevantarse=$_POST['hLevantarse'];
  $hDormir=$_POST['hDormir'];
  $comidasDia=$_POST['comidasDia'];
  $hDiariamente=$_POST['hDiariamente'];
  $saltarComida=$_POST['saltarComida'];
  $comerEntreComidas=$_POST['comerEntreComidas'];
  $tipoAlimentos=$_POST['tipoAlimentos'];
  $alimentosMalestar=$_POST['alimentosMalestar']; 

  //FUNCION QUE LE MANDA LOS DATOS AL MODELO
  $datos=$this->modelo->guardarHabitosBase($hLevantarse, $hDormir, $comidasDia,
  $hDiariamente, $saltarComida, $comerEntreComidas, $tipoAlimentos, $alimentosMalestar); 
  
  }
 

}



