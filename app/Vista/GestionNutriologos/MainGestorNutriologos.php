<!-- Espacio disponible para contenido -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading --> 
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-user-friends" style="font-size: 30px;"></i> Gestión de nutriologos</h1>
  <p class="mb-4">Gestionar nutriologos.</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Nutriologos registrados.</h6> 
            <span class="float-right">
       <a href="?c=GestionarNutriologos&a=VistaAltaNutriologo" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
         <i class="fas fa-plus"></i>
       </span>
       <span class="text">Dar de alta nutriólogo</span>
     </a></span> 
      <br>
      <br>
  <div class="card shadow mb-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="GestorNutriologos" width="100%" cellspacing="0">
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
        <h5 class="modal-title" id="exampleModalLongTitle">Información del nutriólogo</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br>
       <div  class="form-group col-8">
            <h6 class="m-0 font-weight-bold text-primary">Datos:</h6> 
            <br>
                <label for="exampleFormControlInput1"> Nombre:</label>
          <input disabled type="text" class="form-control" title="Nombre" id="nombreNutriologoGestor">

        </div>
          <div class="form-group col-8">
                     <label for="exampleFormControlSelect1">Correo:</label>
         <input disabled type="text" class="form-control" title="Correo" id="correoNutriologoGestor"> 

        </div>
          <div class="form-group col-8">
         <label for="exampleFormControlSelect1">Dirección:</label>
         <input disabled type="text" class="form-control" title="Dirección" id="direccionNutriologoGestor"> 
        </div>
                 <div class="form-group col-8">
         <label for="exampleFormControlSelect1">Teléfono:</label>
         <input disabled type="text" class="form-control" title="Teléfono" id="telefonoNutriologoGestor"> 
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



