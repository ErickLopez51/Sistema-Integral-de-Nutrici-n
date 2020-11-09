<!-- Espacio disponible para contenido -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading --> 
  <h1 class="h3 mb-2 text-gray-800"><i class="far fa-calendar-alt" style="font-size: 30px;"></i> Agendar cita</h1>
  <p class="mb-4">Formulario para agendar cita.</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Completa correctamente el formulario.</h6> 
      <br>

      <form method="post">
  <div class="form-row">
    <div class="form-group col-md-3 mb-3">
    <label for="inputState"><strong>*Fecha:</strong></label>
       <input type="text" class="form-control" name="calendarioCita" data-toggle="calendarioCita" placeholder="Fecha" required>
    </div>
    <div class="form-group col-md-3 mb-3">
    <label for="inputState"><strong>*Hora:</strong></label>
       <input type="text"  class="form-control" id="timeCita" name="timeCita" placeholder="Hora" required> 
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="inputPassword4">Nota:</label>
      <input type="text" class="form-control" id="notaCita" placeholder="Nota">
    </div>
  </div>

  <div class="col-6 col-sm-12">
  <div class="col text-center">
  <button  id="guardarCita" type="submit" class="btn btn-outline-success btn-rounded waves-effect"><i class="far fa-calendar-plus"></i> Agendar cita</button>
  </div>
</div>
</form>
</div>
</div>
</div>
<!-- /.container-fluid -->


<!--Fin espacio -->





