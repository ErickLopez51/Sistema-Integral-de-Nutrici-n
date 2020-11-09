<!-- Espacio disponible para contenido -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading --> 
  <h1 class="h3 mb-2 text-gray-800"><i class="far fa-calendar-alt" style="font-size: 30px;"></i> Historial de citas</h1>
  <p class="mb-4">Agendar citas.</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Citas agendadas.</h6> 
      <br>
      <form method="post">
  <div class="form-row">
    <div class="form-group col-md-4 mb-3">
    <label for="inputEmail4">Estado de citas:</label>
        <select name="Estado" id="estadoCitasPaciente" class="form-control" >
            <option value="0" name="todos">Selecciona...</option>
           <option selected="selected" value="1" name="Confirmadas">Confirmadas </option>
           <option value="2" name="Pendientes">Pendientes </option>
           <option value="3" name="Canceladas">Canceladas </option>
           <option value="4" name="Finalizadas">Finalizadas </option>
      </select>
    </div>
    <div class="form-group col-md-4 mb-3">
    <br>
    <button  id="filtroCitasPaciente" type="button" class="btn btn-primary"><i class="fas fa-filter"></i> Filtro</button>
    </div>
  </div>
  </form>
            <span class="float-right">
       <a href="?c=AgendarCitas&a=vistaAgendarCita" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
         <i class="far fa-calendar-plus"></i>
       </span>
       <span class="text">Agendar cita</span>
     </a></span> 
      <br>
      <br>
  <div class="card shadow mb-3">
    <div class="card-body">
      <div class="table-responsive"> 
        <table class="table table-bordered" id="tablaCitas" width="100%" cellspacing="0">
          <thead>
            <tr>
           <th>Fecha de la cita</th>
           <th>Nota</th>
           <th>Estado de la cita</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>Fecha de la cita</th>
           <th>Nota</th>
           <th>Estado de la cita</th>
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
</div>
<!-- /.container-fluid -->


<!---Fin espacio-->


<!--Fin espacio -->



