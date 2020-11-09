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
class HistorialNutricional
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
  public function guardarHistorialBase($pesohabitual, $aguaP, $complexionF,
  $pesoMinumo, $musculoP, $edadMetabolica, $pesoMaximo, $masaOsea, $cintura, $pesoActual,
  $imc, $cadera, $talla, $kgGrasa, $pesoIdeal, $grasaP, $nivelGrasa, $pesoMeta, $data)
{

  $idPaciente=$_SESSION["usuario"]["idUsuario"];
  try
  {
    
    $guardardatos = $this->pdo->prepare("INSERT INTO historialnutricional (pHabitual,pMinimo,pMaximo,Pactual,
    talla,grasaP,aguaP,musculoP,masaOsea,IMC,kgGrasa,grasaVisceral,complexionFisica ,edadMetabolica ,cintura,
    cadera ,pesoIdeal ,pesoMeta ,estatusHistorial ,idPacienteHistorial)
    VALUES ('$pesohabitual','$pesoMinumo','$pesoMaximo','$pesoActual','$talla',
    '$grasaP','$aguaP','$musculoP','$masaOsea','$imc',
    '$kgGrasa','$nivelGrasa','$complexionF','$edadMetabolica','$cintura',
    '$cadera','$pesoIdeal','$pesoMeta',1,'$idPaciente')");

    //Ejecución de la sentencia SQL.
    $guardardatos->execute();

    $ultimoId=$this->pdo->lastInsertId();
    for ($x=0;  $x < sizeof($data) ; $x++) { 
     $categoria = $data[$x]['grupoAlimento'];
     $descripcion = $data[$x]['alimento'];
     $porcion = $data[$x]['porcion'];
     $frecuencia = $data[$x]['frecuencia'];
     $tipoPorcionA = $data[$x]['tipoPorcion'];

      $guardarAlimentos = $this->pdo->prepare("INSERT INTO alimentos (categoria,descripcion,porcion,frecuencia,
      tipoPorcionA)
      VALUES ('$categoria','$descripcion','$porcion','$frecuencia','$tipoPorcionA')");

       $guardarAlimentos->execute();
  
      $ultimoIdAlimento=$this->pdo->lastInsertId();

      $seguimientoAlimentos = $this->pdo->prepare("INSERT INTO seguimientoalimentos (idHistorialAlimentos,idAlimento)
      VALUES ('$ultimoId','$ultimoIdAlimento')");
       $seguimientoAlimentos->execute();
   }

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