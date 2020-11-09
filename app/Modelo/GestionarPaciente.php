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
class GestionarPaciente
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

  //OBTENER PACIENTES REGISTRADOS
  public function obtenerPacientesGestor()
  {

    try
    {

      $idUsuarioNutriologo=$_SESSION["usuario"]["idUsuario"];
            //Sentencia SQL para selección de datos.
        $stm = $this->pdo->prepare("SELECT * FROM paciente where idUserNutriologo = '$idUsuarioNutriologo' and estatusPaciente=1 ");
            //Ejecución de la sentencia SQL.
        $stm->execute();
        $datos = array();
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
          $idUsuario = $row['idPaciente'];
          $idUsuarioURL = base64_encode($row['idPaciente']);
          $nombre = $row['nombrep']." ".$row['app']." ".$row['amp'] ;
          $correo = $row['correop'];
          $BotonVer="  <td><div class='col text-center'><button  id='".$idUsuario."' data-toggle='modal' data-target='#exampleModalCenter' title='Ver información' class='Verinfo btn btn-info btn-circle'><i class='fas fa-eye'></i></button></div></td>";

          $BotonEditar="<td><div class='col text-center'><a href='?c=GestionarPacientes&a=EditarDatosPaciente&g=".$idUsuarioURL."' title='Editar información' class='btn btn-warning btn-circle'><i class='editar fas fa-edit'></i></a></div></td>";

          $BotonEliminar="<td><div class='col text-center'><button onclick='alertaBajaUsuario(".$idUsuario.");' title='Dar de baja' class='bajaUsuario btn btn-danger btn-circle'><i class='fas fa-trash'></i></button></div></td>";

          $datos[] = array('idUsuario' => $idUsuario, 'nombre' => $nombre, 
            'correo' => $correo,'BotonVer' => $BotonVer,'BotonEditar' => $BotonEditar,'BotonEliminar' => $BotonEliminar);


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

  //OBTENER INFORMACIÓN DEL PACIENTE
  public function InfoPerfilUsuario($idBotonVer)
  {
    $idUser=$idBotonVer;

    $nutriologoSQL = $this->pdo->prepare("SELECT * FROM paciente WHERE idPaciente='$idUser'");
            //Ejecución de la sentencia SQL.
    $nutriologoSQL->execute();
    $resultadoPaciente=$nutriologoSQL->fetch(PDO::FETCH_ASSOC);
    $nombre = $resultadoPaciente['nombrep']." ".$resultadoPaciente['app']." ".$resultadoPaciente['amp'];
    $fechaNac = $resultadoPaciente['fechaNac'];
    $ocupacion = $resultadoPaciente['ocupacion'];
    $estatura = $resultadoPaciente['estatura'];
    $correo = $resultadoPaciente['correop'];
    $direccion=$resultadoPaciente['direccionp'];
    $ciudad = $resultadoPaciente['ciudad'];
    $telefono=$resultadoPaciente['telefonop'];

    $datosPerfil = array();

    $datosPerfil[] = array('correo' => $correo, 'nombre' => $nombre, 
      'direccion' => $direccion,'telefono' => $telefono, 'fechaNac' => $fechaNac, 'ocupacion' => $ocupacion, 'estatura' => $estatura, 'ciudad' => $ciudad,);

    echo json_encode($datosPerfil);
    
  }

  //FUNCION PARA DAR DE BAJA A PACIENTE
  public function DarDeBajaUsuario($idUsuario)
  {
    try
    {
            //Sentencia SQL para selección de datos.
      $bajaUsuario = $this->pdo->prepare("UPDATE paciente SET estatusPaciente=0 WHERE idPaciente = '$idUsuario'");
            //Ejecución de la sentencia SQL.
      $bajaUsuario->execute();
    }
    catch(Exception $e)
    {
            //Obtener mensaje de error.
      die($e->getMessage());
    }

  }

  //FUNCION PARA GUARDAR USUARIO EN LA BASE DE DATOS
  public function GuardarUsuarioAlta($nombrePaciente,$apPaciente,
  $amPaciente,$fechaNacPaciente,$estaturaPaciente,$ocupacionPaciente,$correoPaciente, 
  $direccionPaciente,$ciudadPaciente,$telefonoPaciente)
  {
    header('Content-type: application/json');
    $resultado = array();
    $mail = new PHPMailer(true);
    $idNutriologo=$_SESSION["usuario"]["idUsuario"];
   try
   {
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
      $titulo='Sistema Integral de Nutrición';
      $mail->setFrom('sistema.integral.nutricion@gmail.com', $titulo);
      $mail->addAddress($correoPaciente, $nombrePaciente);     // Add a recipient
      // Content
      $mail->isHTML(true);  
      $mail->Subject = 'UTF-8';     
      // Set email format to HTML
      $asunto='Registro en el Sistema Integral de Nutrición';
      $mail->Subject = $asunto;
      // $mail->Body    = $cuerpo;
      $cuerpo = "Hola $nombrePaciente, has sido registrado en el Sistema Integral de Nutrición tu <b>contraseña es: SIN2020</b><br><strong>Por seguridad, se recomienda cambiar contraseña al ingresar al sistema.</strong> Para cambiar contraseña ingresar al apartado de perfil.<br>Para iniciar sesión ingresa a la siguiente url: http://localhost/sin/app/";

      $mail->Body = $cuerpo;
      
      // $mail->send();

      if ($mail->send()) {

        $contra="SIN2020";
    $contraEncriptada=sha1($contra);
    $guardarUsuario = $this->pdo->prepare("INSERT INTO paciente (nombrep,app,amp,fechaNac,ocupacion,estatura,ciudad,correop,contrasenap,estatusPaciente,direccionp,telefonop,idUserNutriologo)
      VALUES ('$nombrePaciente','$apPaciente','$amPaciente','$fechaNacPaciente','$ocupacionPaciente','$estaturaPaciente','$ciudadPaciente','$correoPaciente','$contraEncriptada',1,'$direccionPaciente','$telefonoPaciente','$idNutriologo')");
    
    //Ejecución de la sentencia SQL.
    $guardarUsuario->execute();
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

//OBTENER DATOS DEL PACIENTE PARA EDITAR LA INFROMACIÓN
public function ObtenerDatosEditarPaciente($idUsuario)
{

  try
  {
    $stm = $this->pdo->prepare("SELECT * FROM paciente WHERE idPaciente = '$idUsuario'");
    $stm->execute(array($idUsuario));
    return $stm->fetch(PDO::FETCH_OBJ);
  }
  catch(Exception $e)
  {
            //Obtener mensaje de error.
    die($e->getMessage());
  }
}

//ACTUALIZAR INFROMACIÓN DE NUTRIOLOGOS
public function ActualizarInfoPacientes($idUsuario,$nombrePaciente,$apPaciente,
$amPaciente,$fechaNacPaciente,$estaturaPaciente,$ocupacionPaciente,$correoPaciente, 
$direccionPaciente,$ciudadPaciente,$telefonoPaciente)
{

 try
 {
   $actualizarNutriologo = $this->pdo->prepare("UPDATE paciente SET 
   nombrep='$nombrePaciente', app='$apPaciente',amp='$amPaciente',fechaNac='$fechaNacPaciente',
   estatura='$estaturaPaciente',ocupacion='$ocupacionPaciente', correop='$correoPaciente',
   direccionp='$direccionPaciente', ciudad='$ciudadPaciente',
   telefonop='$telefonoPaciente' WHERE idPaciente='$idUsuario'");
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

}