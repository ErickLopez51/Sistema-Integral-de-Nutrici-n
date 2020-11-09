<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/sin/app/Librerias/Conexion.php");

require_once ("$root/sin/Public/PHPMailer/src/Exception.php");
require_once ("$root/sin/Public/PHPMailer/src/PHPMailer.php");
require_once ("$root/sin/Public/PHPMailer/src/SMTP.php");


/**
 * 
 */
class DietaHabitual
{
	protected static $cnx; 
    //Atributo para conexión a SGBD
  private $pdo;

    //Método de conexión a SGBD.
  public function __CONSTRUCT()
  {
    try
    {
      $this->pdo = Base::Conectar();
    }
    catch(Exception $e)
    {
      die($e->getMessage());
    }
  }

  private static function getConexion()
  {
    self::$cnx = Conexion::conectar();
  }

  private static function desconectar()
  {
    self::$cnx = null;
  }


  //FUNCION PARA GUARDAR LA INFORMACIÒN 
  public function guardarDietaBase($desayuno, $colacion1, $comida,
  $colacion2, $cena, $notaDieta, $cantidadLiquidos)                                     
  {

  $idPaciente=$_SESSION["usuario"]["idUsuario"];
  try
  {
    
    $guardardatos = $this->pdo->prepare("INSERT INTO dietahabitual (desayuno,colacion1,comida,colacion2,
    cena,notaDieta,cantidadLiquidos,idPacienteDieta)
    VALUES ('$desayuno','$colacion1','$comida','$colacion2','$cena',
    '$notaDieta','$cantidadLiquidos','$idPaciente')");

    //Ejecución de la sentencia SQL.
    $guardardatos->execute();



  header('Content-type: application/json');
   $resultado = array();
   $resultado = array("estado" => "true");
   return print(json_encode($resultado));
    
  }
catch(Exception $e)
{
            //Obtener mensaje de error.
  die($e->getMessage());
  $resultado = array("estado" => "false");
  return print(json_encode($resultado));
}
}


  
}