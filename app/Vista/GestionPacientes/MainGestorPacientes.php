<!-- Espacio disponible para contenido -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading --> 
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-user-friends" style="font-size: 30px;"></i> Gestión de pacientes</h1>
  <p class="mb-4">Gestionar pacientes.</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Pacientes registrados.</h6> 
            <span class="float-right">
       <a href="?c=GestionarPacientes&a=VistaAltaPaciente" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
         <i class="fas fa-plus"></i>
       </span>
       <span class="text">Dar de alta paciente</span>
     </a></span> 
      <br>
      <br>
  <div class="card shadow mb-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="GestorPacientes" width="100%" cellspacing="0">
          <thead>
            <tr>
           <th>Nombre</th>
           <th>Correo</th>
           <th>Información</th>
           <th>Editar</th>
           <th>Dar de baja</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
           <th>Nombre</th>
           <th>Correo</th>
           <th>Información</th>
           <th>Editar</th>
           <th>Dar de baja</th>
            </tr>
          </tfoot>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Información del paciente</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br>
       <div  class="form-group col-8">
            <h6 class="m-0 font-weight-bold text-primary">Datos:</h6> 
            <br>
        </div>
        <div class="form-row  col-12">
    <div class="form-group col">
      <label for="exampleFormControlSelect1">Nombre:</label>
      <input disabled type="text" class="form-control" id="nombrePacienteGestor" >
    </div>
    <div class="form-group col">
      <label for="exampleFormControlSelect1">Fecha de nacimiento:</label>
      <input disabled type="text" class="form-control" id="fechaNacPacienteGestor" d>
    </div>
  </div>

  <div class="form-row  col-12">
    <div class="form-group col">
      <label for="exampleFormControlSelect1">Ocupación:</label>
      <input disabled type="text" class="form-control" id="ocupacionPacienteGestor" >
    </div>
    <div class="form-group col">
      <label for="exampleFormControlSelect1">Estatura:</label>
      <input disabled type="text" class="form-control" id="estaturaPacienteGestor" >
    </div>
  </div>
          <div class="form-group col-12">
                     <label for="exampleFormControlSelect1">Correo:</label>
         <input disabled type="text" class="form-control" title="Correo" id="correoPacienteGestor"> 

        </div>
          <div class="form-group col-12">
         <label for="exampleFormControlSelect1">Dirección:</label>
         <input disabled type="text" class="form-control" title="Dirección" id="direccionPacienteGestor"> 
        </div>

        <div class="form-row  col-12">
    <div class="form-group col">
      <label for="exampleFormControlSelect1">Ciudad:</label>
      <input disabled type="text" class="form-control" id="ciudadPacienteGestor" >
    </div>
    <div class="form-group col">
      <label for="exampleFormControlSelect1">Teléfono:</label>
      <input disabled type="text" class="form-control" id="telefonoPacienteGestor" d>
    </div>
  </div>

      <div class="modal-footer">
        <button type="button" id="salirModalPerfil" class="btn btn-danger" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->


<!---Fin espacio-->


<!--Fin espacio -->



