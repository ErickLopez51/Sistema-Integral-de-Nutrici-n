<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/sin/app/Librerias/EntidadesUsuario.php");
require_once ("$root/sin/app/Librerias/Conexion.php");

require_once ("$root/sin/Public/PHPMailer/src/Exception.php");
require_once ("$root/sin/Public/PHPMailer/src/PHPMailer.php");
require_once ("$root/sin/Public/PHPMailer/src/SMTP.php");

/**
 * 
 */
class Usuario 
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

    /**
     * Metodo que sirve para validar el login
     *
     * @param      object         $usuario
     * @return     boolean
     */
    public static function login($usuario)
    {

     $query = "SELECT correo,contrasena,estatusUser FROM usuario WHERE correo = :correo AND contrasena = :contrasena and estatusUser=1";

     self::getConexion();

     $resultado = self::$cnx->prepare($query);

     $resultado->bindValue(":correo", $usuario->getCorreo());
     $resultado->bindValue(":contrasena", $usuario->getContrasena());
     $resultado->execute();

     if ($resultado->rowCount() > 0) 
     {
      $filas = $resultado->fetch();

      if ($filas["correo"] == $usuario->getCorreo()  && $filas["contrasena"] == $usuario->getContrasena() && $filas["estatusUser"] == 1)
      {  
        return true;
      }
    }
    else
    {
      $queryPaciente = "SELECT correop,contrasenap,estatusPaciente FROM paciente WHERE correop = :correo AND contrasenap = :contrasena and estatusPaciente=1";

      self::getConexion();
 
      $resultadop = self::$cnx->prepare($queryPaciente);
 
      $resultadop->bindValue(":correo", $usuario->getCorreo());
      $resultadop->bindValue(":contrasena", $usuario->getContrasena());
      $resultadop->execute();

      if ($resultadop->rowCount() > 0) 
      {
       $filasp = $resultadop->fetch();
 
       if ($filasp["correop"] == $usuario->getCorreo()  && $filasp["contrasenap"] == $usuario->getContrasena() && $filasp["estatusPaciente"] == 1)
       {  
         return true;
       }
     }
    }

    return false;
  }

    /**
     * Metodo que sirve obtener un usuario
     *
     * @param      object         $usuario
     * @return     object
     */
    public static function getUsuario($usuario)
    {

      $query = "SELECT * FROM usuario WHERE correo = :correo AND contrasena = :contrasena and estatusUser=1";

      self::getConexion();
 
      $resultado = self::$cnx->prepare($query);
 
      $resultado->bindValue(":correo", $usuario->getCorreo());
      $resultado->bindValue(":contrasena", $usuario->getContrasena());
      $resultado->execute();
 
      if ($resultado->rowCount() > 0) 
      {
       $filas = $resultado->fetch();
        
       $idUsuario=$filas["idUsuario"];
       $tipoUsuario=$filas["tipoUsuario"];
       
       if ($tipoUsuario==1) {
        $nombre = "Eres administrador: ".$filas['nombre']." ".$filas['ap']." ".$filas['am'];
 
      }
      else if($tipoUsuario==2)
      {
        $nombre = "Nutriologo: ".$filas['nombre']." ".$filas['ap']." ".$filas['am'];
      }

      $usuario = new EntidadesUsuario();
      //TABLA USUARIO
      $usuario->setIdUsuario($filas["idUsuario"]);
      $usuario->setCorreo($filas["correo"]);
      $usuario->setContrasena($filas["contrasena"]);
      $usuario->Setnombre($nombre);
      $usuario->SetTipoUsuario($filas["tipoUsuario"]);

     return $usuario;

     }
     else
     {
       $queryPaciente = "SELECT * FROM paciente WHERE correop = :correo AND contrasenap = :contrasena and estatusPaciente=1";
 
       self::getConexion();
  
       $resultadop = self::$cnx->prepare($queryPaciente);
  
       $resultadop->bindValue(":correo", $usuario->getCorreo());
       $resultadop->bindValue(":contrasena", $usuario->getContrasena());
       $resultadop->execute();
 
       if ($resultadop->rowCount() > 0) 
       {
        $filasp = $resultadop->fetch();

        $idPaciente=$filasp["idPaciente"];
        $nombrep = "Paciente: ".$filasp['nombrep']." ".$filasp['app']." ".$filasp['amp'];
        $tipoUsuario=3;

        $usuario = new EntidadesUsuario();
        //TABLA PACIENTE
        $usuario->setIdUsuario($filasp["idPaciente"]);
        $usuario->setCorreo($filasp["correop"]);
        $usuario->setContrasena($filasp["contrasenap"]);
        $usuario->Setnombre($nombrep);
        $usuario->SetTipoUsuario($tipoUsuario);
  
       return $usuario;


      }
     }

   }


  //  public function seguimientoSesion($ipCliente)
  //  {

  //    try{
  //                //INSERTAR SEGUIMIENTO DE ACCESO AL USUARIO
  //     // var_dump($correo);
  //     // var_dump($ipCliente);
      
  //     date_default_timezone_set('America/Mexico_City');
  //     $fecha_actual = date('Y-m-d H:i:s');
  //     $idUser=$_SESSION["usuario"]["idUsuario"];

  //     $stm = $this->pdo->prepare("INSERT INTO seguimientoacceso(fechaSeg, ip, idUsuario) VALUES ('$fecha_actual','$ipCliente','$idUser')");
  //           //Ejecución de la sentencia SQL.
  //     $stm->execute();

  //   } 
  //   catch(Exception $e)
  //   {
  //           //Obtener mensaje de error.
  //     die($e->getMessage());
  //     return 0;
  //   }


  // }

//FUNCION PARA ACTUALIZAR CONTRASEÑA AL INICIAR SESIÓN POR PRIMERA VEZ
  public function actualizarContra($datos)
  {
    try{
      $idUser=$_SESSION["usuario"]["idUsuario"];
      $txtPasswordN =sha1($datos['txtPasswordN']);


             //Sentencia SQL para selección de datos.
      $stm = $this->pdo->prepare("UPDATE usuario SET password='$txtPasswordN' WHERE idUsuario='$idUser' ");
            //Ejecución de la sentencia SQL.
      $stm->execute();
            //fetchAll — Devuelve un array que contiene todas las filas del conjunto
            //de resultados

    } 
    catch(Exception $e)
    {
            //Obtener mensaje de error.
      die($e->getMessage());
      return 0;
    }

  }

  //FUNCION PARA RESTABLECER LA CONTRASEÑA
  public function actualizarContraRecuperar($datos,$correo)
  {
    try{

      // $txtPasswordN = $datos['txtPasswordN'];
       $txtPasswordN =sha1($datos['txtPasswordN']);


             //Sentencia SQL para selección de datos.
      $stm = $this->pdo->prepare("UPDATE usuario SET password='$txtPasswordN' WHERE correo='$correo' ");
            //Ejecución de la sentencia SQL.
      $stm->execute();
            //fetchAll — Devuelve un array que contiene todas las filas del conjunto
            //de resultados

    } 
    catch(Exception $e)
    {
            //Obtener mensaje de error.
      die($e->getMessage());
      return 0;
    }

  }

  //CAMBIAR CONTRASEÑA DEL PERFIL (SIN)
  public function cambioDeContrasena($contraActual,$contraNueva,$confirmarContra)
  {
    try{
      $idUsuario=$_SESSION["usuario"]["idUsuario"];
      $tipoUsuario=$_SESSION["usuario"]["tipoUsuario"];
      $contraActual1=sha1($contraActual);

      if($tipoUsuario == 1 OR $tipoUsuario == 2)
      {
            
        //Sentencia SQL para selección de datos.
        $contraActualSQL = $this->pdo->prepare("SELECT contrasena FROM usuario WHERE idUsuario='$idUsuario'");
        //Ejecución de la sentencia SQL.
        $contraActualSQL->execute();
        $resultadoContraActual=$contraActualSQL->fetch(PDO::FETCH_ASSOC);
        $contraActualBase = $resultadoContraActual['contrasena'];
        header('Content-type: application/json');
        $resultado = array();
        if (strcmp($contraActualBase,$contraActual1) == 0 and strcmp($contraNueva,$confirmarContra) == 0)
        {
          $contra=sha1($contraNueva);

        $cambiarContra = $this->pdo->prepare("UPDATE usuario SET contrasena='$contra' WHERE idUsuario='$idUsuario'");
                  //Ejecución de la sentencia SQL.
        $cambiarContra->execute();
        $resultado = array("estadoContra" => "true");
        return print(json_encode($resultado));
        }
        elseif (strcmp($contraActualBase,$contraActual1) != 0 || strcmp($contraNueva,$confirmarContra) != 0)
        {
        $resultado = array("estadoContra" => "false");
        return print(json_encode($resultado));
        }   
      }
      else if($tipoUsuario == 3)
      {
                 
        //Sentencia SQL para selección de datos.
        $contraActualSQL = $this->pdo->prepare("SELECT contrasenap FROM paciente WHERE idPaciente='$idUsuario'");
        //Ejecución de la sentencia SQL.
        $contraActualSQL->execute();
        $resultadoContraActual=$contraActualSQL->fetch(PDO::FETCH_ASSOC);
        $contraActualBase = $resultadoContraActual['contrasenap'];
        header('Content-type: application/json');
        $resultado = array();
        if (strcmp($contraActualBase,$contraActual1) == 0 and strcmp($contraNueva,$confirmarContra) == 0)
        {
          $contra=sha1($contraNueva);

        $cambiarContra = $this->pdo->prepare("UPDATE paciente SET contrasenap='$contra' WHERE idPaciente='$idUsuario'");
                  //Ejecución de la sentencia SQL.
        $cambiarContra->execute();
        $resultado = array("estadoContra" => "true");
        return print(json_encode($resultado));
        }
        elseif (strcmp($contraActualBase,$contraActual1) != 0 || strcmp($contraNueva,$confirmarContra) != 0)
        {
        $resultado = array("estadoContra" => "false");
        return print(json_encode($resultado));
        }  
      }
   } 
   catch(Exception $e)
   {
            //Obtener mensaje de error.
    die($e->getMessage());
    return 0;
  }


}

//FUNCION PARA CONSULTAR LA INFORMACION DEL USUARIO EN LA BASE DE DATOS
public function InfoPerfil()
{
  $idUsuario=$_SESSION["usuario"]["idUsuario"];
  $tipoUsuario=$_SESSION["usuario"]["tipoUsuario"];

  if($tipoUsuario == 1 OR $tipoUsuario == 2)
  {
        $usuarioSQL = $this->pdo->prepare("SELECT * FROM usuario WHERE idUsuario='$idUsuario'");
        //Ejecución de la sentencia SQL.
    $usuarioSQL->execute();
    $resultadoUsuario=$usuarioSQL->fetch(PDO::FETCH_ASSOC);
    $nombre = $resultadoUsuario['nombre']." ".$resultadoUsuario['ap']." ".$resultadoUsuario['am'] ;
    $correo=$resultadoUsuario['correo'];
    $direccion=$resultadoUsuario['direccion'];
    $telefono=$resultadoUsuario['telefono'];

    $datosPerfil = array();

    $datosPerfil[] = array('correo' => $correo, 'nombre' => $nombre, 
    'direccion' => $direccion,'telefono' => $telefono);

    echo json_encode($datosPerfil); 
  }
  else if ($tipoUsuario == 3)
  {

     $usuarioSQL = $this->pdo->prepare("SELECT * FROM paciente WHERE idPaciente='$idUsuario'");
    //Ejecución de la sentencia SQL.
    $usuarioSQL->execute();
    $resultadoUsuario=$usuarioSQL->fetch(PDO::FETCH_ASSOC);
    $nombre = $resultadoUsuario['nombrep']." ".$resultadoUsuario['app']." ".$resultadoUsuario['amp'] ;
    $correo=$resultadoUsuario['correop'];
    $direccion=$resultadoUsuario['direccionp'];
    $telefono=$resultadoUsuario['telefonop'];

    $datosPerfil = array();

    $datosPerfil[] = array('correo' => $correo, 'nombre' => $nombre, 
    'direccion' => $direccion,'telefono' => $telefono);

    echo json_encode($datosPerfil); 

      }
}

    //FUNCION PARA VERIFICAR SI EL CORREO ESTA DADO DE ALTA EN EL SISTEMA
public function buscarCorreo($correoRecuperar)
{
  try{

    header('Content-type: application/json');
    $resultado = array(); 

             //Sentencia SQL para selección de datos.
    $conCorreo = $this->pdo->prepare(" SELECT * FROM usuario WHERE correo='$correoRecuperar' ");
            //Ejecución de la sentencia SQL.
    $conCorreo->execute();
    $resultado=$conCorreo->fetch(PDO::FETCH_ASSOC);

    return $resultado;
  } 
  catch(Exception $e)
  {
            //Obtener mensaje de error.
    die($e->getMessage());
    return 0;
  }
}

   //FUNCION PARA ENVIAR CORREO DE RECUPERACION
public function enviarCorreoRecuperacion($codigo,$datosUsuario)
{
  
  try{

    date_default_timezone_set('America/Mexico_City');
    $fecha_actual = date('Y-m-d H:i:s');

      //CONSULTA PARA OBTENER DATOS DEL EMPLEADO
    header('Content-type: application/json');
    $resultado = array(); 

    $idEmpleado=$datosUsuario['Empleado_idRfc'];
    $correo=$datosUsuario['correo'];
    $idUser=$datosUsuario['idUsuario'];

             //Sentencia SQL para selección de datos.
    $empeladoInfo = $this->pdo->prepare("SELECT * FROM empleado WHERE idRfc='$idEmpleado'");
            //Ejecución de la sentencia SQL.
    $empeladoInfo->execute();
    $resultado=$empeladoInfo->fetch(PDO::FETCH_ASSOC);

    $nombre = $resultado['nombre']." ".$resultado['ap']." ".$resultado['am'] ;

    
                  // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
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
      $mail->addAddress($correo, $nombre);     // Add a recipient

      // Content
      $mail->isHTML(true);  
      $mail->Subject = 'UTF-8';     
      // Set email format to HTML
      $asunto='Recuperación de contraseña,Sistema Integral de Nutrición';
      $mail->Subject = $asunto;
      // $mail->Body    = $cuerpo;
      $cuerpo = "Hola $nombre, has solicitado restablecer tu <b>contraseña.</b><br>Codigo de verificación: $codigo";

      $mail->Body = $cuerpo;
      
      // $mail->send();

      if ($mail->send()) {
     //GUARDAR INFORMACIÓN DE RESTABLECER 
        $guardarRestablecimiento = $this->pdo->prepare("INSERT INTO restablecercontra (correoRestablecer,codigo,estatusRestablecer,fechaRestablecer,idUsuarioContra)
          VALUES ('$correo','$codigo',1,'$fecha_actual','$idUser')");
                        //Ejecución de la sentencia SQL.
       $guardarRestablecimiento->execute();
        return true; 
      }
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                  //Obtener mensaje de error.
      die($e->getMessage());
      die($mail->ErrorInfo);

      return 0;
      return false;
    }


  } 
  catch(Exception $e)
  {
            //Obtener mensaje de error.
    die($e->getMessage());
    return 0;
  }
}

//FUNCION PARA DAR DE BAJA EL CODIGO DE RECUPERACION CUANDO SE TERMINE EL TIEMPO
public function CodigoExpiro($code)
{
  try{

             //Sentencia SQL para selección de datos.

    $codigo = $this->pdo->prepare(" UPDATE restablecercontra SET estatusRestablecer=0 WHERE codigo='$code'");
            //Ejecución de la sentencia SQL.
    $codigo->execute();
  } 
  catch(Exception $e)
  {
            //Obtener mensaje de error.
    die($e->getMessage());
    return 0;
  }
}

//FUNCION PARA BUSCAR CODIGO DE RECUPERACION EN LA BASE DE DATOS

public function buscarCodigo($codigoRecuperar)
{
  try{

    header('Content-type: application/json');
    $resultado = array(); 

             //Sentencia SQL para selección de datos.
    $codigo = $this->pdo->prepare(" SELECT * FROM restablecercontra WHERE codigo='$codigoRecuperar' and estatusRestablecer=1 ");
            //Ejecución de la sentencia SQL.
    $codigo->execute();
    $resultado=$codigo->fetch(PDO::FETCH_ASSOC);

    return $resultado;
  } 
  catch(Exception $e)
  {
            //Obtener mensaje de error.
    die($e->getMessage());
    return 0;
  }
}

//FUNCION PARA DAR DE BAJA CODIGO 

public function codigoBaja($codigoRecuperar)
{
  try{

    header('Content-type: application/json');
    $resultado = array(); 

             //Sentencia SQL para selección de datos.

    $codigo = $this->pdo->prepare(" UPDATE restablecercontra SET estatusRestablecer=0 WHERE codigo='$codigoRecuperar'");
            //Ejecución de la sentencia SQL.
    $codigo->execute();
  } 
  catch(Exception $e)
  {
            //Obtener mensaje de error.
    die($e->getMessage());
    return 0;
  }
}

//LLAVE FINAL
}



