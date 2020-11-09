<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/sin/app/Librerias/Conexion.php"); //OBTENER CONEXION DE LA BASE DE DATOS
/**
 * 
 */
class HabitoAlimenticio //DEFINIR CLASE DEL MODEL
{
	protected static $cnx; 
    //Atributo para conexión a Base de Datos
  private $pdo;

    //METODO DE CONEXION A LA BASE DE DATOS
  public function __CONSTRUCT()
  {
    try
    {
      $this->pdo = Base::Conectar(); //CONECTAR A LA BASE DE DATOS
    }
    catch(Exception $e)
    {
      die($e->getMessage()); //MENSAJE DE ERROR
    }
  }

  //FUNCION PARA GUARDAR LA INFORMACIÒN EN LA BASE DE DATOS
  public function guardarHabitosBase($hLevantarse, $hDormir, $comidasDia,
  $hDiariamente, $saltarComida, $comerEntreComidas, $tipoAlimentos, $alimentosMalestar)
  {
    //OBTENER ID DE LA SESION DEL PACIENTE
  $idPaciente=$_SESSION["usuario"]["idUsuario"];
  try
  {
    //REALIZAR SENTENCIA DE INSERT EN LA BASE DE DATOS
    $guardardatos = $this->pdo->prepare("INSERT INTO habitosalimenticios (hLevantarse,hDormir,comidasDia,hDiariamente,
    saltarComida,comerEntreComidas,tipoAlimentos,alimentosMalestar,idHabitosPaciente)
    VALUES ('$hLevantarse','$hDormir','$comidasDia','$hDiariamente','$saltarComida',
    '$comerEntreComidas','$tipoAlimentos','$alimentosMalestar','$idPaciente')");

    //Ejecución de la sentencia SQL.
    $guardardatos->execute();


    //ENVIAR MENSAJE DE TRUE SI SE REALIZO CORRECTAMENTE LA SENTENCIA
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