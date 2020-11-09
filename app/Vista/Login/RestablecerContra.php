<?php 
// $self = $_SERVER['PHP_SELF']; //Obtenemos la página en la que nos encontramos
// header("refresh:200; url=$self"); //Refrescamos cada 300 segundos
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>SIN</title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--NOTIFICACIONES JS -->
  <link rel="stylesheet" type="text/css" href="/sin/Public/css/overhang.min.css" />

  <!-- Custom fonts for this template-->
  <link href="/sin/Public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/sin/Public/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="/sin/Public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- favicon
          ============================================ -->
          <link rel="shortcut icon" type="image/x-icon" href="/sin/Public/img/favicon.ico">

          <link href="/sin/Public/css/Estilo/login.css" rel="stylesheet">



        </head>
        <body class="bg-gradient-light">

         <div class="wrapper">
          <div id="formContent" class="border border-danger">
            <!-- Tabs Titles -->

            <div>
              <h4>
                <b>Restablecer contraseña</b>
              </h4>
            </div>

            <!-- Icon -->
            <div>
              <img src="/sin/Public/img/email.png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form method="POST" id="frmcorreoRecuperar" action="?c=Usuarios&a=recuperarContrasena">
              <label for="exampleFormControlInput1">Escribe el correo del que quieres recuperar la contraseña.</label>
              <input type="email" id="correoRecuperar" name="correoRecuperar" placeholder="Correo Electrónico">

              <div class="loginButton">


                <input type="submit" value="Enviar">
              </div>
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
              <a class="underlineHover" href="?c=Usuarios&a=index">Volver a iniciar sesión</a>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
              <div class="container my-auto">
                <div class="copyright text-center my-auto">
                <span>Copyright &copy; 2020 <a>Erick Noé López Ocampo</a></span>
                </div>
              </div>
            </footer>
            <!-- End of Footer -->
          </div>
        </div>


        <!-- Bootstrap core JavaScript-->
        <script src="/sin/Public/vendor/jquery/jquery.min.js"></script>
        <script src="/sin/Public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/sin/Public/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="/sin/Public/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="/sin/Public/vendor/chart.js/Chart.min.js"></script>

        <!--NOTIFICACIONES JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/sin/Public/js/overhang.min.js"></script>
        <script src="/sin/Public/js/appJS/app.js"></script>


        <!-- Page level plugins -->
        <script src="/sin/Public/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/sin/Public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="/sin/Public/js/demo/datatables-demo.js"></script>

        <script src="/sin/Public/js/appJS/RecuperarContrasena.js"></script>

      </body>

      </html>
