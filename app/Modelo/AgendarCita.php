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
class AgendarCita
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

    //OBTENER INFORMACIÓN DE LAS CITAS AGENDADAS
    public function obtenerCitas()
    {
  
      try
      {
  
        $idPaciente=$_SESSION["usuario"]["idUsuario"];
              //Sentencia SQL para selección de datos.
          $stm = $this->pdo->prepare("SELECT * FROM cita where idPacienteCita = '$idPaciente' and estadoCita = 1");
              //Ejecución de la sentencia SQL.
          $stm->execute();
          $datos = array();
          while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

            $idCita = $row['idCita'];
            setlocale(LC_TIME, "spanish");
            $fecha1 = $row['fechaCita'];
            $fecha1 = str_replace("/", "-", $fecha1);			
            $newDate = date("d-m-Y", strtotime($fecha1));				
            $mesDesc = utf8_encode(strftime("%A, %d de %B de %Y", strtotime($newDate)));
            $hora = date("g:i a", strtotime($row['horaCita']));				

            $fecha = $mesDesc." a las ".$hora;
            $notaCita = $row['notaCita'];
            
             //OBTENER FECHA ACTUAL
             date_default_timezone_set('America/Mexico_City');
             $fecha_actual = date('Y-m-d');
          
               if($row['fechaCita'] < $fecha_actual)
               {
                 $updateCita = $this->pdo->prepare("UPDATE cita SET estadoCita = 4 where idCita = '$idCita'");
                 $updateCita->execute();
               }

            if ($row['estadoCita'] == 1)
            {
              $estado = "Aprobada";
            }
            else if($row['estadoCita'] == 2)
            {
              $estado = "Pendiente";
            }
            else if($row['estadoCita'] == 3)
            {
              $estado = "Cancelada";
            }
            else if($row['estadoCita'] == 4)
            {
              $estado = "Finalizada";
            }

            $datos[] = array('fecha' => $fecha,
            'notaCita' => $notaCita,'estado' => $estado);
  
  
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
  


  //FUNCION PARA GUARDAR LA INFORMACIÒN 
  public function guardarCitaBase($fechaCita, $horaCita, $notaCita)
{

  $idPaciente=$_SESSION["usuario"]["idUsuario"];
  $nombrePaciente=$_SESSION["usuario"]["nombre"];
  $correoPaciente=$_SESSION["usuario"]["correo"];
  header('Content-type: application/json');
  $resultado = array();
  $mail = new PHPMailer(true);
  try
  {

    $fecha1 = $fechaCita;
    $hora1 = $horaCita;
    setlocale(LC_TIME, "spanish");
    $fecha1 = str_replace("/", "-", $fecha1);			
    $newDate = date("d-m-Y", strtotime($fecha1));				
    $mesDesc = utf8_encode(strftime("%A, %d de %B de %Y", strtotime($newDate)));
    $hora = date("g:i a", strtotime($horaCita));				

    $fecha = $mesDesc." a las ".$hora;
  
    $stm = $this->pdo->prepare("SELECT * FROM paciente where idPaciente = '$idPaciente'");
      $stm->execute();
      $resultado=$stm->fetch(PDO::FETCH_ASSOC);
      $idNutriologo=$resultado['idUserNutriologo'];
  
      $stm = $this->pdo->prepare("SELECT * FROM usuario where idUsuario = '$idNutriologo'");
      $stm->execute();
      $resultado1=$stm->fetch(PDO::FETCH_ASSOC);
      $correoNutriologo=$resultado1['correo'];
      $nombreNutriologo=$resultado1['nombre']." ".$resultado1['ap']." ".$resultado1['am'];
      
  
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
    $titulo='Cita agendada del Sistema Integral de Nutrición';
    $mail->setFrom($correoPaciente, $titulo);
    $mail->addAddress($correoNutriologo, $nombreNutriologo);     // Add a recipient
    // Content
    $mail->isHTML(true);  
    $mail->Subject = 'UTF-8';     
    // Set email format to HTML
    $asunto='Cita agendada del Sistema Integral de Nutrición';
    $mail->Subject = $asunto;
    // $mail->Body    = $cuerpo;
    $cuerpo = "Hola $nombreNutriologo, tú paciente $nombrePaciente agendo una cita para el $fecha.</strong> Para confirmar la cita al paciente ingresa al apartado historial citas. Para iniciar sesión ingresa a la siguiente url: http://localhost/sin/app/";
  
    $mail->Body = $cuerpo;
    
    // $mail->send();
  
    if ($mail->send()) {
  
      $guardardatos = $this->pdo->prepare("INSERT INTO cita (fechaCita,horaCita,notaCita,estadoCita,
      idPacienteCita)
      VALUES ('$fechaCita','$horaCita','$notaCita',2,'$idPaciente')");
  
      //Ejecución de la sentencia SQL.
      $guardardatos->execute();
  
      $resultado = array("estado" => "true");
      return print(json_encode($resultado));
    }
  
  
  }
  catch(Exception $e)
  {
  $resultado = array("estado" => "false");
  return print(json_encode($resultado));
          //Obtener mensaje de error.
          // die($e->getMessage());
  }
 
}

 //OBTENER INFORMACIÓN DE LAS CITAS AGENDADAS PARA EL NUTRIOLOGO
 public function obtenerCitasNutriologo()
 {

   try
   {

     $idNutriologo=$_SESSION["usuario"]["idUsuario"];
           //Sentencia SQL para selección de datos.
       $stm = $this->pdo->prepare("SELECT * FROM paciente where idUserNutriologo = '$idNutriologo'");
           //Ejecución de la sentencia SQL.
       $stm->execute();
       $datosCita = array();
       $datos = array();
       while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

         $idPaciente = $row['idPaciente'];
         $nombrePaciente = $row['nombrep']." ".$row['app']." ".$row['amp'];     
         $datos[] = array('idPaciente' => $idPaciente, 'nombrePaciente' => $nombrePaciente);

       }

       for ($i=0;  $i < sizeof($datos) ; $i++) { 

        $idPaciente=$datos[$i]['idPaciente'];
        $nombrePaciente=$datos[$i]['nombrePaciente'];
        $cita = $this->pdo->prepare("SELECT * FROM cita where idPacienteCita = '$idPaciente' and estadoCita = 2");
              //Ejecución de la sentencia SQL.
          $cita->execute();
          while ($row = $cita->fetch(PDO::FETCH_ASSOC)) {

            $idCita = $row['idCita'];
            setlocale(LC_TIME, "spanish");
            $fecha1 = $row['fechaCita'];
            $fecha1 = str_replace("/", "-", $fecha1);			
            $newDate = date("d-m-Y", strtotime($fecha1));				
            $mesDesc = utf8_encode(strftime("%A, %d de %B de %Y", strtotime($newDate)));
            $hora = date("g:i a", strtotime($row['horaCita']));			
            $fecha = $mesDesc." a las ".$hora;
            $notaCita = $row['notaCita'];
            

            if ($row['estadoCita'] == 1)
            {
              $estado = "Aprobada";
            }
            else if($row['estadoCita'] == 2)
            {
              $estado = "Pendiente";
            }
            else if($row['estadoCita'] == 3)
            {
              $estado = "Cancelada";
            }
            else if($row['estadoCita'] == 4)
            {
              $estado = "Finalizada";
            }

            $confirmar="<td><div class='col text-center'><button onclick='alertaConfirmarCita(".$idCita.");' title='Confirmar cita' class='btn btn-success btn-circle'><i class='fas fa-check-circle'></i></button></div></td>";
            $cancelar="<td><div class='col text-center'><button onclick='alertaCancelarCita(".$idCita.");' title='Cancelar cita' class='btn btn-danger btn-circle'><i class='fas fa-times-circle'></i></button></div></td>";

            $datosCita[] = array('fecha' => $fecha,
             'notaCita' => $notaCita,'estado' => $estado,
             'nombrePaciente' => $nombrePaciente, 'confirmar' => $confirmar, 
            'cancelar' => $cancelar );
          }
        }

        $tabla = array(
          "data"       =>  $datosCita
 
        );
 
         echo json_encode($tabla);

   }
   catch(Exception $e)
   {
           //Obtener mensaje de error.
     die($e->getMessage());
   }
 }

 //OBTENER INFORMACIÓN DE LAS CITAS AGENDADAS PARA EL NUTRIOLOGO FILTRO
 public function obtenerCitasNutriologoFiltro($estadoCitas)
 {

   try
   {

     $idNutriologo=$_SESSION["usuario"]["idUsuario"];
           //Sentencia SQL para selección de datos.
       $stm = $this->pdo->prepare("SELECT * FROM paciente where idUserNutriologo = '$idNutriologo'");
           //Ejecución de la sentencia SQL.
       $stm->execute();
       $datosCita = array();
       $datos = array();
       while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

         $idPaciente = $row['idPaciente'];
         $nombrePaciente = $row['nombrep']." ".$row['app']." ".$row['amp'];     
         $datos[] = array('idPaciente' => $idPaciente, 'nombrePaciente' => $nombrePaciente);

       }

       for ($i=0;  $i < sizeof($datos) ; $i++) { 

        $idPaciente=$datos[$i]['idPaciente'];
        $nombrePaciente=$datos[$i]['nombrePaciente'];
        $cita = $this->pdo->prepare("SELECT * FROM cita where idPacienteCita = '$idPaciente' and estadoCita = '$estadoCitas' ");
              //Ejecución de la sentencia SQL.
          $cita->execute();
          while ($row = $cita->fetch(PDO::FETCH_ASSOC)) {

            $idCita = $row['idCita'];
            setlocale(LC_TIME, "spanish");
            $fecha1 = $row['fechaCita'];
            $fecha1 = str_replace("/", "-", $fecha1);			
            $newDate = date("d-m-Y", strtotime($fecha1));				
            $mesDesc = utf8_encode(strftime("%A, %d de %B de %Y", strtotime($newDate)));
            $hora = date("g:i a", strtotime($row['horaCita']));			
            $fecha = $mesDesc." a las ".$hora;
            $notaCita = $row['notaCita'];
            

            if ($row['estadoCita'] == 1)
            {
              $estado = "Aprobada";
            }
            else if($row['estadoCita'] == 2)
            {
              $estado = "Pendiente";
            }
            else if($row['estadoCita'] == 3)
            {
              $estado = "Cancelada";
            }
            else if($row['estadoCita'] == 4)
            {
              $estado = "Finalizada";
            }

            $confirmar="<td><div class='col text-center'><button onclick='alertaConfirmarCita(".$idCita.");' title='Confirmar cita' class='btn btn-success btn-circle'><i class='fas fa-check-circle'></i></button></div></td>";
            $cancelar="<td><div class='col text-center'><button onclick='alertaCancelarCita(".$idCita.");' title='Cancelar cita' class='btn btn-danger btn-circle'><i class='fas fa-times-circle'></i></button></div></td>";

            $datosCita[] = array('fecha' => $fecha,
            'notaCita' => $notaCita,'estado' => $estado,'nombrePaciente' => $nombrePaciente, 'confirmar' => $confirmar, 
            'cancelar' => $cancelar );
          }
        }

        $tabla = array(
          "data"       =>  $datosCita
 
        );
 
         echo json_encode($tabla);

   }
   catch(Exception $e)
   {
           //Obtener mensaje de error.
     die($e->getMessage());
   }
 }

 //FUNCION PARA CONFIRMAR CITAS
 public function updateConfirmar($idCita)
 {
  $nombreNutriologo=$_SESSION["usuario"]["nombre"];
  $correoNutriologo=$_SESSION["usuario"]["correo"];
  header('Content-type: application/json');
  $resultado = array();
  $mail = new PHPMailer(true);
  try
  {
  
    $stm = $this->pdo->prepare("SELECT * FROM cita where idCita = '$idCita'");
      $stm->execute();
      $resultado = $stm->fetch(PDO::FETCH_ASSOC);
      $idPaciente = $resultado['idPacienteCita'];
      $fecha1 = $resultado['fechaCita'];
      $horaCita = $resultado['horaCita'];
 
      setlocale(LC_TIME, "spanish");
    $fecha1 = str_replace("/", "-", $fecha1);			
    $newDate = date("d-m-Y", strtotime($fecha1));				
    $mesDesc = utf8_encode(strftime("%A, %d de %B de %Y", strtotime($newDate)));
    $hora = date("g:i a", strtotime($horaCita));				
 
    $fecha = $mesDesc." a las ".$hora;
 
      $stm = $this->pdo->prepare("SELECT * FROM paciente where idPaciente = '$idPaciente'");
      $stm->execute();
      $resultado1=$stm->fetch(PDO::FETCH_ASSOC);
      $correoPaciente=$resultado1['correop'];
      $nombrePaciente=$resultado1['nombrep']." ".$resultado1['app']." ".$resultado1['amp'];
      
  
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
    $titulo='Confirmación de cita agendada del Sistema Integral de Nutrición';
    $mail->setFrom($correoNutriologo, $titulo);
    $mail->addAddress($correoPaciente, $nombrePaciente);     // Add a recipient
    // Content 
    $mail->isHTML(true);  
    $mail->Subject = 'UTF-8';     
    // Set email format to HTML
    $asunto='Confirmación de cita agendada del Sistema Integral de Nutrición';
    $mail->Subject = $asunto;
    // $mail->Body    = $cuerpo;
    $cuerpo = "Hola $nombrePaciente, la cita que solicitaste con el $nombreNutriologo, fue CONFIRMADA para el día $fecha. Si tienes alguna duda puedes enviarme un mensaje al siguiente correo: $correoNutriologo. IMPORTANTE: Favor de llegar 10 minutos antes. Para iniciar sesión en el Sistema Integral de Nutrición ingresa a la siguiente url: http://localhost/sin/app/";
    $mail->Body = $cuerpo;
    
    // $mail->send();
  
    if ($mail->send()) {
 
       //Sentencia SQL para selección de datos.
       $confirmarCita = $this->pdo->prepare("UPDATE cita SET estadoCita = 1 WHERE idCita = '$idCita'");
       //Ejecución de la sentencia SQL.
       $confirmarCita->execute();
  
      $resultado = array("estado" => "true");
      return print(json_encode($resultado));
    }
  
  
  }
  catch(Exception $e)
  {
  $resultado = array("estado" => "false");
  return print(json_encode($resultado));
          //Obtener mensaje de error.
          // die($e->getMessage());
  }

 }

 //FUNCION PARA CANCELAR CITAS
 public function updateCancelar($idCita)
 {
  $nombreNutriologo=$_SESSION["usuario"]["nombre"];
  $correoNutriologo=$_SESSION["usuario"]["correo"];
  header('Content-type: application/json');
  $resultado = array();
  $mail = new PHPMailer(true);
  try
  {
  
    $stm = $this->pdo->prepare("SELECT * FROM cita where idCita = '$idCita'");
      $stm->execute();
      $resultado = $stm->fetch(PDO::FETCH_ASSOC);
      $idPaciente = $resultado['idPacienteCita'];
      $fecha1 = $resultado['fechaCita'];
      $horaCita = $resultado['horaCita'];
 
      setlocale(LC_TIME, "spanish");
    $fecha1 = str_replace("/", "-", $fecha1);			
    $newDate = date("d-m-Y", strtotime($fecha1));				
    $mesDesc = utf8_encode(strftime("%A, %d de %B de %Y", strtotime($newDate)));
    $hora = date("g:i a", strtotime($horaCita));				
 
    $fecha = $mesDesc." a las ".$hora;
 
      $stm = $this->pdo->prepare("SELECT * FROM paciente where idPaciente = '$idPaciente'");
      $stm->execute();
      $resultado1=$stm->fetch(PDO::FETCH_ASSOC);
      $correoPaciente=$resultado1['correop'];
      $nombrePaciente=$resultado1['nombrep']." ".$resultado1['app']." ".$resultado1['amp'];
      
  
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
    $titulo='Cancelación de cita agendada del Sistema Integral de Nutrición';
    $mail->setFrom($correoNutriologo, $titulo);
    $mail->addAddress($correoPaciente, $nombrePaciente);     // Add a recipient
    // Content 
    $mail->isHTML(true);  
    $mail->Subject = 'UTF-8';     
    // Set email format to HTML
    $asunto='Cancelación de cita agendada del Sistema Integral de Nutrición';
    $mail->Subject = $asunto;
    // $mail->Body    = $cuerpo;
    $cuerpo = "Hola $nombrePaciente, la cita que solicitaste con el $nombreNutriologo el día $fecha fue CANCELADA. Si tienes alguna duda puedes enviarme un mensaje al siguiente correo: $correoNutriologo. Para iniciar sesión en el Sistema Integral de Nutrición ingresa a la siguiente url: http://localhost/sin/app/";
    $mail->Body = $cuerpo;
    
    // $mail->send();
  
    if ($mail->send()) {
 
       //Sentencia SQL para selección de datos.
       $confirmarCita = $this->pdo->prepare("UPDATE cita SET estadoCita = 3 WHERE idCita = '$idCita'");
       //Ejecución de la sentencia SQL.
       $confirmarCita->execute();
  
      $resultado = array("estado" => "true");
      return print(json_encode($resultado));
    }
  
  
  }
  catch(Exception $e)
  {
  $resultado = array("estado" => "false");
  return print(json_encode($resultado));
          //Obtener mensaje de error.
          // die($e->getMessage());
  }
 

 }

 
    //OBTENER INFORMACIÓN DE LAS CITAS AGENDADAS PACIENTES
    public function obtenerCitasPacienteFiltro($estadoCitasPaciente)
    {
  
      try
      {
  
        $idPaciente=$_SESSION["usuario"]["idUsuario"];
              //Sentencia SQL para selección de datos.
          $stm = $this->pdo->prepare("SELECT * FROM cita where idPacienteCita = '$idPaciente' and estadoCita = '$estadoCitasPaciente'");
              //Ejecución de la sentencia SQL.
          $stm->execute();
          $datos = array();
          while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

            $idCita = $row['idCita'];
            setlocale(LC_TIME, "spanish");
            $fecha1 = $row['fechaCita'];
            $fecha1 = str_replace("/", "-", $fecha1);			
            $newDate = date("d-m-Y", strtotime($fecha1));				
            $mesDesc = utf8_encode(strftime("%A, %d de %B de %Y", strtotime($newDate)));
            $hora = date("g:i a", strtotime($row['horaCita']));				

            $fecha = $mesDesc." a las ".$hora;
            $notaCita = $row['notaCita'];

             //OBTENER FECHA ACTUAL
             date_default_timezone_set('America/Mexico_City');
             $fecha_actual = date('Y-m-d');
          
               if($row['fechaCita'] < $fecha_actual)
               {
                 $updateCita = $this->pdo->prepare("UPDATE cita SET estadoCita = 4 where idCita = '$idCita'");
                 $updateCita->execute();
               }

            if ($row['estadoCita'] == 1)
            {
              $estado = "Aprobada";
            }
            else if($row['estadoCita'] == 2)
            {
              $estado = "Pendiente";
            }
            else if($row['estadoCita'] == 3)
            {
              $estado = "Cancelada";
            }
            else if($row['estadoCita'] == 4)
            {
              $estado = "Finalizada";
            }

            $datos[] = array('fecha' => $fecha,
            'notaCita' => $notaCita,'estado' => $estado);
  
  
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




  
}

