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
class Recomendacion
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


  //FUNCION PARA GUARDAR RECOMENDACIÓN 
  public function guardarRecomendacion($cuerpo)
{

  $idNutriologo=$_SESSION["usuario"]["idUsuario"];
  $nombreNutriologo=$_SESSION["usuario"]["nombre"];
  $correoNutriologo=$_SESSION["usuario"]["correo"];
   //OBTENER FECHA ACTUAL
   date_default_timezone_set('America/Mexico_City');
   $fecha_actual = date('Y-m-d H:i:s');
  header('Content-type: application/json');
  $resultado = array();
  $mail = new PHPMailer(true);
  try
  {
        $stm = $this->pdo->prepare("SELECT * FROM paciente where idUserNutriologo = '$idNutriologo' and estatusPaciente = 1 ");
        //Ejecución de la sentencia SQL.
    $stm->execute();
    $datos = array();
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
      $correo = $row['correop'];
      $nombre = $row['nombrep']." ".$row['app']." ".$row['amp'];
      $datos[] = array('correo' => $correo, 'nombre' => $nombre);
    }

        //Server settings
        $mail->SMTPDebug = 2;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'sistema.integral.nutricion@gmail.com';                     // SMTP username
        $mail->Password   = 'Calamar12345';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                // TCP port to connect to 587
        $mail->CharSet = 'UTF-8';        
        $mail->SMTPDebug = 0;                          
      
      
        //Recipients
        $titulo="Recomendaciones del ".$nombreNutriologo." del Sistema Integral de Nutrición";
        $mail->setFrom('sistema.integral.nutricion@gmail.com', $titulo);
        // Content 
        $mail->isHTML(true);  
        $mail->Subject = 'UTF-8';     
        // Set email format to HTML
        $asunto="Recomendaciones del ".$nombreNutriologo." del Sistema Integral de Nutrición";
        $mail->Subject = $asunto;
        // $mail->Body    = $cuerpo;
        $cuerposend = $cuerpo."<br> $nombreNutriologo Si tienes alguna duda puedes enviarme un mensaje al siguiente correo: $correoNutriologo. Para iniciar sesión en el Sistema Integral de Nutrición ingresa a la siguiente url: http://localhost/sin/app/";
        $mail->Body = $cuerposend;
    
        foreach ($datos as $email) {
      
         $mail->addAddress($email['correo'], $email['nombre']);   
        $mail->Send(); 
        $mail->ClearAddresses(); 
        }
     
          $guardardatos = $this->pdo->prepare("INSERT INTO recomendaciones (recomendacion,fechaReco,idRecoUser)
          VALUES ('$cuerpo','$fecha_actual','$idNutriologo')");
      
          //Ejecución de la sentencia SQL.
          $guardardatos->execute();
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



  


  
  
  

  


  
 