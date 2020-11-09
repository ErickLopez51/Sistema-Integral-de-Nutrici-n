<!DOCTYPE html>
<html lang="en">

<head> 
  <title>SIN</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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


  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
  
<!--   <link rel="stylesheet" href="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.css"> -->

 <!-- <link href="/sin/Public/datepicker/jquery-ui.css" rel="stylesheet"> -->

<!--   <link href="/sin/Public/datepicker/jquery.timepicker.js" rel="stylesheet"> -->
  <link href="/sin/Public/datepicker/jquery.timepicker.css" rel="stylesheet"> 

   <!-- SELECT2-->
  <link href="/sin/Public/vendor/select2/css/select2.min.css" rel="stylesheet" />
 <link href="/sin/Public/vendor/select2/css/select2.css" rel="stylesheet" />

    <!-- sweetalert2-->
  <link href="/sin/Public/css/sweetalert2.min.css" rel="stylesheet">

      <!-- DATATABLE EXPORT STYLE-->
  <link href="/sin/Public/DataTableExport/css/buttons.dataTables.min.css" rel="stylesheet">

      <!-- DATATABLE checkbox-->
  <link href="/sin/Public/DataTableExport/css/dataTables.checkboxes.css" rel="stylesheet">

    <!-- summernote -->
  <link rel="stylesheet" href="/sin/Public/summernote/summernote-bs4.css">

  <!-- Custom styles for this page -->
  <link href="/sin/Public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

      <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="/sin/Public/img/favicon.ico">


</head>

<body id="page-top">
  


  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?c=Usuarios&a=ingresar">
        <div class="sidebar-brand-icon">

             <!--  <img style="width: 40px" class="img-profile rounded-circle" src="/sin/Public/img/correo.png"> -->
              <img style="width: 90px"  src="/sin/Public/img/LogoMenu.png" alt="">
          <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text">SIN</div>
      </a>

      <?php
      if (($_SESSION["usuario"]["tipoUsuario"] == 1)) 
      {
        ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Menú Admin
        </div>

          <li class="nav-item">
        <a class="nav-link" href="?c=GestionarNutriologos&a=MainGestorNutriologos">
          <i class="fas fa-user-friends" style="font-size: 20px;"></i>
          <span>Gestión de nutriologos</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?c=RespaldoDB&a=MainRespaldoBD">
          <i class="fas fa-database" style="font-size: 20px;"></i>
          <span>Respaldo Base de Datos</span></a>
      </li>
      
        <!-- Divider -->
        <hr class="sidebar-divider">

        <?php
      }
      ?>

<?php
      if (($_SESSION["usuario"]["tipoUsuario"] == 2)) 
      {
        ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
         Menú
      </div>

      <!-- Nav Item - Charts -->
      <!-- <li class="nav-item active"> -->
        <li class="nav-item">
        <a class="nav-link" href="?c=GestionarPacientes&a=MainGestorPacientes">
        <i class="fas fa-user-friends" style="font-size: 20px;"></i>
          <span>Gestión de pacientes</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="?c=Envios&a=MainEnviados">
        <i class="fas fa-universal-access" style="font-size: 20px;"></i>
          <span>Seguimiento del paciente</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="?c=PlanesdeAlimentacion&a=MainPlanAlimentacion">
        <i class="fas fa-utensils" style="font-size: 20px;"></i>
          <span>Planes de alimentación</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="?c=Recomendaciones&a=vistaRecomendacion">
        <i class="fas fa-heartbeat" style="font-size: 20px;"></i>
          <span>Recomendaciones</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="?c=AgendarCitas&a=vistaHistorialCitas">
        <i class="far fa-calendar-alt" style="font-size: 20px;"></i>
          <span>Citas</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="?c=Grupos&a=MainGrupo">
        <i class="fas fa-file-pdf" style="font-size: 20px;"></i>
          <span>Reportes</span></a>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

        <?php
      }
      ?>

<?php
      if (($_SESSION["usuario"]["tipoUsuario"] == 1) OR ($_SESSION["usuario"]["tipoUsuario"] == 3)) 
      {
        ?>
      <!-- Heading -->
      <div class="sidebar-heading">
         Menú
      </div>

      <!-- Nav Item - Charts -->
      <!-- <li class="nav-item active"> -->
        <li class="nav-item">
        <a class="nav-link" href="?c=HistorialNutricionales&a=RegistroHistorialNutricional">
        <i class="fas fa-heartbeat" style="font-size: 20px;"></i>
          <span>Historial nutricional</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="?c=HabitosAlimenticios&a=RegistroHabitos">
        <i class="fas fa-child" style="font-size: 20px;"></i>
          <span>Hábitos alimenticios</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="?c=DietaHabituales&a=vistaRegistroDietaHabitual">
        <i class="fas fa-coffee" style="font-size: 20px;"></i>
          <span>Dieta hábitual</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="?c=CorreosProgramados&a=MainProgramados">
        <i class="fas fa-universal-access" style="font-size: 20px;"></i>
          <span>Seguimiento</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="?c=Carpetas&a=MainCarpetas">
        <i class="fas fa-utensils" style="font-size: 20px;"></i>
          <span>Planes de alimentación</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="?c=AgendarCitas&a=mainCitas">
        <i class="far fa-calendar-alt" style="font-size: 20px;"></i>
          <span>Agendar cita</span></a>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <?php
      }
      ?>

    </ul>
    <!-- Fin del menu-->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar mb-3 static-top shadow text-light

" style="background-color: #22bb33;">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-light d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
            <div class="input-group">
              <h2 class="font-weight-bold text-white">Sistema Integral de Nutrición</h2>
              <!-- <img class="img-profile rounded-circle" src="/sin/Public/img/logo_logo_imta2019.png"> -->
          <!--     <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt=""> -->
         <!--      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div> -->
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <!-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a> -->
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
        <!--     <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i> -->
                <!-- Counter - Alerts -->
               <!--  <span class="badge badge-danger badge-counter">3+</span>
              </a> -->
              <!-- Dropdown - Alerts -->
      <!--         <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li> -->

            <!-- Nav Item - Messages -->

            <li class="nav-item dropdown no-arrow mx-1">

               <!-- <li class="nav-item dropdown no-arrow mx-1">
              <a href="?c=ChatController&a=MainChat" title="Chat" class="nav-link dropdown-toggle"><i class="fas fa-comments"></i></a>
            </li> -->

             <!--  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-comments"></i> -->
                <!-- Counter - Messages -->
             <!--    <span class="badge badge-danger badge-counter">7</span>
              </a> -->
              <!-- Dropdown - Messages -->

          
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline  text-white"><?php echo utf8_encode($_SESSION["usuario"]["nombre"]); ?></span>
                <img class="img-profile rounded-circle" src="/sin/Public/img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="?c=Usuarios&a=InformacionPerfil">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesión
                </a>
              </div>
            </li>

          </ul>
        </nav>
        <!-- End of Topbar -->

