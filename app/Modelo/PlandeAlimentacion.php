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
class PlandeAlimentacion
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
  public function guardarDatosPlan($nombrePlan,$kcaltotal,$hc,$hdesayuno,$hcolacion1,$hcomida,$hcolacion2,$hcena,$data)
{

  $idNutriologo=$_SESSION["usuario"]["idUsuario"];
  try
  {
    
    $guardardatos = $this->pdo->prepare("INSERT INTO planalimentacion (nombrePlan,kcalTotales,hidratosCarbono,hDesayuno,
    hColacion1,hComida,hColacion2,hCena,estatusPlan,idUsuarioPlan)
    VALUES ('$nombrePlan','$kcaltotal','$hc','$hdesayuno','$hcolacion1',
    '$hcomida','$hcolacion2','$hcena',1,'$idNutriologo')");

    //Ejecución de la sentencia SQL.
    $guardardatos->execute();
    $ultimoId=$this->pdo->lastInsertId();

    for ($x=0;  $x < sizeof($data) ; $x++) { 

     $diaPlan = $data[$x]['diaPlan'];
     $tipoComidaPlan = $data[$x]['tipoComidaPlan'];
     $grupoAlimentoPlan = $data[$x]['grupoAlimentoPlan'];
     $porcionPlan = $data[$x]['porcionPlan'];
     $tipoPorcionplan = $data[$x]['tipoPorcionplan'];
     $alimentoPlan = $data[$x]['alimentoPlan'];
     
      $guardarAlimentos = $this->pdo->prepare("INSERT INTO plancomida (planCategoria,planDescripcion,planPorcion,planTipoPorcion,
      diaComida,tipoComida)
      VALUES ('$grupoAlimentoPlan','$alimentoPlan','$porcionPlan','$tipoPorcionplan','$diaPlan','$tipoComidaPlan')");

       $guardarAlimentos->execute();
      $ultimoIdAlimento=$this->pdo->lastInsertId();

      $seguimientoAlimentos = $this->pdo->prepare("INSERT INTO seguimientocomida (idPlanComida,idPlanAlimentacion)
      VALUES ('$ultimoIdAlimento','$ultimoId')");
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

  //OBTENER PLANES DE NUTRICIÓN REGISTRADOS
  public function obtenerPlanesGestor()
  {

    try
    {

      $idNutriologo=$_SESSION["usuario"]["idUsuario"];
            //Sentencia SQL para selección de datos.
        $stm = $this->pdo->prepare("SELECT * FROM planalimentacion where idUsuarioPlan = '$idNutriologo' and estatusPlan = 1 ");
            //Ejecución de la sentencia SQL.
        $stm->execute();
        $datos = array();
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
          $idPlanAlimentacion = $row['idPlanAlimentacion'];
          $idPlanAlimentacionURL = base64_encode($row['idPlanAlimentacion']);
          $nombrePlan = $row['nombrePlan'];

          $BotonVer="  <td><div class='col text-center'><button  id='".$idPlanAlimentacion."' data-toggle='modal' data-target='#exampleModalCenter' title='Ver información' class='Verinfo btn btn-info btn-circle'><i class='fas fa-eye'></i></button></div></td>";

          $BotonEditar="<td><div class='col text-center'><a href='?c=PlanesdeAlimentacion&a=EditarDatosPlan&g=".$idPlanAlimentacionURL."' title='Editar información' class='btn btn-warning btn-circle'><i class='editar fas fa-edit'></i></a></div></td>";

          $BotonEliminar="<td><div class='col text-center'><button onclick='alertaBajaPlan(".$idPlanAlimentacion.");' title='Dar de baja' class='bajaUsuario btn btn-danger btn-circle'><i class='fas fa-trash'></i></button></div></td>";

          $datos[] = array('idPlanAlimentacion' => $idPlanAlimentacion, 'nombrePlan' => $nombrePlan,
          'BotonVer' => $BotonVer,'BotonEditar' => $BotonEditar,'BotonEliminar' => $BotonEliminar);


        }
        $tabla = array(
         "data"       =>  $datos

       );

        echo json_encode($tabla);
    }
    catch(Exception $e)
    {
            //Obtener mensaje de error.
      die($e->getMessage());
    }
  }

  
  //FUNCION PARA DAR DE BAJA PLAN DE NUTRICIÓN
  public function DarDeBajaPlan($idPlanAlimentacion)
  {
    try
    {
            //Sentencia SQL para selección de datos.
      $bajaPlan = $this->pdo->prepare("UPDATE planalimentacion SET estatusPlan = 0 WHERE idPlanAlimentacion = '$idPlanAlimentacion'");
            //Ejecución de la sentencia SQL.
      $bajaPlan->execute();
    }
    catch(Exception $e)
    {
            //Obtener mensaje de error.
      die($e->getMessage());
    }

  }

  //OBTENER DATOS DEL PLAN DE ALIMENTACIÓN PARA EDITAR LA INFROMACIÓN
public function ObtenerDatosEditarPlan($idPlanAlimentacion)
{

  try
  {
    $stm = $this->pdo->prepare("SELECT * FROM planalimentacion WHERE idPlanAlimentacion = '$idPlanAlimentacion'");
    $stm->execute(array($idPlanAlimentacion));
    return $stm->fetch(PDO::FETCH_OBJ);
  }
  catch(Exception $e)
  {
            //Obtener mensaje de error.
    die($e->getMessage());
  }
}

//ACTUALIZAR INFROMACIÓN DE NUTRIOLOGOS
public function ActualizarInfoNutriologos($idUsuario,$nombreNutriologo,$apNutriologo,$amNutriologo,$correoNutriologo,$direccionNutriologo,$telefonoNutriologo)
{

 try
 {
   $actualizarNutriologo = $this->pdo->prepare("UPDATE usuario SET nombre='$nombreNutriologo', ap='$apNutriologo',am='$amNutriologo',correo='$correoNutriologo',direccion='$direccionNutriologo',telefono='$telefonoNutriologo' WHERE idUsuario='$idUsuario'");
                        //Ejecución de la sentencia SQL.
   $actualizarNutriologo->execute();

   header('Content-type: application/json');
   $resultado = array();
   $resultado = array("estado" => "true");
   return print(json_encode($resultado));

 }
 catch(Exception $e)
 {
  $resultado = array("estado" => "false");
  return print(json_encode($resultado));
            //Obtener mensaje de error.
            // die($e->getMessage());
}

}

//$idPlanAlimentacion ES EL ID DEL PLAN DE ALIMENTACIÓN
public function editarAlimentosPlan($idPlanAlimentacion)
{

  try
  {
    $datos=array();
    $datosAlimentos=array();
      //OBTENER LOS ALIMENTOS QUE ESTAN REGISTRADOS EN EL PLAN DE ALIMETACIÓN
    $idNutriologo=$_SESSION["usuario"]["idUsuario"];
            //Sentencia SQL para selección de datos.
    $stm = $this->pdo->prepare("SELECT idPlanComida FROM seguimientocomida WHERE idPlanAlimentacion='$idPlanAlimentacion';");
            //Ejecución de la sentencia SQL.
    $stm->execute();

    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
     $idPlanComida = $row['idPlanComida'];

     $datos[] = array('idPlanComida' => $idPlanComida);
   }


   for ($i=0;  $i < sizeof($datos) ; $i++) { 

    $idPlanComida=$datos[$i]['idPlanComida'];
    $Alimentos = $this->pdo->prepare("SELECT * FROM plancomida WHERE idPlanComida='$idPlanComida'");
            //Ejecución de la sentencia SQL.
    $Alimentos->execute();

    while ($row = $Alimentos->fetch(PDO::FETCH_ASSOC)) {


     $datosAlimentos[] = $row;
   }  

 }


 return $datosAlimentos;

}
catch(Exception $e)
{
            //Obtener mensaje de error.
  die($e->getMessage());
}
}




  
}